<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace Sioweb\Oxid\MetadataMultiSelect\Controller\Admin;

use OxidCommunity\DevutilsCore\Core\DevUtils;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Module\Module;
use OxidEsales\Eshop\Core\Exception\StandardException;

class ModuleConfiguration extends ModuleConfiguration_parent
{
    
    public function render()
    {
        $sModuleId = $this->_sModuleId = $this->getEditObjectId();

        $Template = parent::render();
        $oModule = oxNew(Module::class);
        
        if ($sModuleId && $oModule->load($sModuleId)) {
            try {
                $aDbVariables = $this->_loadMetadataConfVars($oModule->getInfo("settings"));
                $this->_aViewData["var_settings"] = $aDbVariables['settings'];
            } catch (StandardException $oEx) {
                Registry::getUtilsView()->addErrorToDisplay($oEx);
                $oEx->debugOut();
            }
        }
        return $Template;
    }

    public function _loadMetadataConfVars($aModuleSettings)
    {
        $Metadata = parent::_loadMetadataConfVars($aModuleSettings);
        $oConfig = $this->getConfig();

        $aSettings = [];

        if (is_array($aModuleSettings)) {
            foreach ($aModuleSettings as $aValue) {
                $sName = $aValue["name"];
                $sType = $aValue["type"];
                $aSettings['settings'][$sName] = $aValue;
                if($sType === 'select' && !empty($aValue['multiple'])) {
                    $Metadata['vars']['select'][$sName] = array_fill_keys(unserialize(html_entity_decode($Metadata['vars']['select'][$sName])), 1);
                }
            }
        }

        return array_merge($Metadata, $aSettings);
    }

    /**
     * Saves shop configuration variables
     */
    public function saveConfVars()
    {
        $oConfig = $this->getConfig();

        $this->resetContentCache();

        $this->_sModuleId = $this->getEditObjectId();
        foreach ($this->_aConfParams as $sType => $sParam) {
            $aConfVars = $oConfig->getRequestParameter($sParam);
            if ($sType === 'select') {
                foreach($aConfVars as $confVarName => $confVarValue) {
                    if(is_array($confVarValue)) {
                        $_POST['confselects'][$confVarName] = serialize(array_values($confVarValue));
                    }
                }
            }
        }
        
        return parent::saveConfVars();
    }
}
