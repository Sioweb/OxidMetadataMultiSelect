# Metadata Multi-Select

Moduloptionen unterstützen unter Anderem Select-Boxen, welche allerdings nur einen Wert auswählbar zulassen. Mit diesem Modul, können die Select um die Attribute `multiple`, `size` und `style` erweitert werden.

## Optionen

- (bool) `multiple` Markiert das Select als `multiple=>"true"`
- (int) `size` Wird per default auf 8 gestellt.
- (string) `style` wird als Inline-CSS-Attribute eingefügt

## Beispiel

```php

$aModule = [
    'settings' => [
        ['group' => 'some_group_name', 'name' => 'aFieldName', 'type' => 'select', 'multiple' => true, 'style' => 'width:400px;', 'constraints' => '1|2|3', 'value' => '']
    ]
];
```

## Beispiel - Alle Controller auswählen

Ein Modul könnte z.B. nur auf bestimmte Controller beschränkt werden. Diese können wie folgt ausgelesen und als Parameter hinzugefügt werden:

`metadata.php`

```php

use OxidEsales\Eshop\Core\Model\ListModel;

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

$sQ = "SELECT oxstdurl, oxobjectid, oxseourl FROM oxseo WHERE oxtype='static' && oxlang = ? && oxshopid = ? GROUP BY oxobjectid ORDER BY oxstdurl";

$oStaticUrlList = oxNew(ListModel::class);
$oStaticUrlList->init('oxbase', 'oxseo');
$oStaticUrlList->selectString($sQ, [0, 1]);

$aModule = [
    // ...
    'settings' => [
        ['group' => 'some_group_name', 'name' => 'aFieldName', 'type' => 'select', 'multiple' => true, 'value' => '', 'style' => 'width:400px;', 'constraints' => implode('|', array_keys($oStaticUrlList->aList))]
    ]
];
```

`admin/de/module_options.php`

```php

use OxidEsales\Eshop\Core\Model\ListModel;

$sLangName = "Deutsch";

$aLang = array(
    'charset' => 'UTF-8',
    'SHOP_MODULE_aFieldName' => 'Multi-Select-Feld',
);


$sQ = "SELECT oxstdurl, oxobjectid, oxseourl FROM oxseo WHERE oxtype='static' && oxlang = ? && oxshopid = ? GROUP BY oxobjectid ORDER BY oxstdurl";

$oStaticUrlList = oxNew(ListModel::class);
$oStaticUrlList->init('oxbase', 'oxseo');
$oStaticUrlList->selectString($sQ, [0, 1]);
foreach($oStaticUrlList as $key => $oItem) {
    $aLang['SHOP_MODULE_aFieldName_' . $key] = $oItem->oxseo__oxstdurl->getRawValue() . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $oItem->oxseo__oxseourl->getRawValue();
}
```
