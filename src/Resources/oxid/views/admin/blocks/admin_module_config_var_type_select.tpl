[{ assign var=field_settings value=$var_settings[$module_var]}]
<select class="select"[{if $field_settings.style}]style="[{$field_settings.style}]"[{/if}] [{if $field_settings.multiple }]multiple="true" size="[{if isset($field_settings.size) }][{$field_settings.size}][{else}]8[{/if}]"[{/if}]name="confselects[[{$module_var}]][{if $field_settings.multiple }][][{/if}]" [{$readonly}]>
    [{foreach from=$var_constraints.$module_var item='_field'}]
    <option value="[{$_field|escape}]" [{if $confselects.$module_var == $_field || isset($confselects.$module_var[$_field])}]selected[{/if}]>[{oxmultilang ident="SHOP_MODULE_`$module_var`_`$_field`"}]</option>
    [{/foreach}]
</select>
