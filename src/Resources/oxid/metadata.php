<?php

// admin_module_config_var_type_select
/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = [
    'id'          => 'SiowebMetadataMultiSelect',
    'title'       => '<i></i><b style="color: #005ba9">Sioweb</b> | Multiselect für Moduleinstellungen',
    'description' =>  'Selectboxen, bekommen das Attribut "multiple".',
    'version'     => '1.0',
    'url'         => 'https://www.sioweb.de',
    'email'       => 'support@sioweb.de',
    'author'      => 'Sascha Weidner',
    'extend'      => [
        \OxidEsales\Eshop\Application\Controller\Admin\ModuleConfiguration::class =>
            Sioweb\Oxid\MetadataMultiSelect\Controller\Admin\ModuleConfiguration::class
    ],
    'blocks' => [
        [
            'template' => 'module_config.tpl',
            'block' => 'admin_module_config_var_type_select',
            'file' => 'views/admin/blocks/admin_module_config_var_type_select.tpl',
        ],
    ],
];
