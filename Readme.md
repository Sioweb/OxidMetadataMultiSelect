# Metadata Multi-Select

Moduloptionen unterstützen unter Anderem Select-Boxen, welche allerdings nur einen Wert auswählbar zulassen. Mit diesem Modul, können die Select um die Attribute `multiple`, `size` und `style` erweitert werden.

## Beispiel

```php

$aModule = [
    'settings' => [
        ['group' => 'some_group_name', 'name' => 'aFieldName', 'type' => 'select', 'multiple' => true, 'style' => 'width:400px;', 'constraints' => '1|2|3', 'value' => '']
    ]
];
```