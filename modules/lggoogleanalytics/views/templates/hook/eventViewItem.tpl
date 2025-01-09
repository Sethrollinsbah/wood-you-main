{**
 * Copyright 2022 LÍNEA GRÁFICA E.C.E S.L.
 *
 * @author    Línea Gráfica E.C.E. S.L.
 * @copyright Lineagrafica.es - Línea Gráfica E.C.E. S.L. all rights reserved.
 * @license   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *}

<script type="text/javascript">
  gtag('event', 'view_item', {ldelim}
    currency: '{$event.currency|escape:'javascript':'UTF-8'}',
    items: [
    {foreach $event.items as $k => $item name=items}
    {ldelim}
      item_id: '{$item.item_id|intval}',
      item_name: '{$item.item_name|escape:'javascript':'UTF-8'}',
      discount: {$item.discount|escape:'javascript':'UTF-8'},
      affiliation: '{$item.affiliation|escape:'javascript':'UTF-8'}',
      item_brand: '{$item.item_brand|escape:'javascript':'UTF-8'}',
      item_category: '{$item.item_category|escape:'javascript':'UTF-8'}',
      item_variant: '{$item.item_variant|escape:'javascript':'UTF-8'}',
      price: {$item.price|escape:'javascript':'UTF-8'},
      currency: '{$item.currency|escape:'javascript':'UTF-8'}',
      quantity: {$item.quantity|escape:'javascript':'UTF-8'}
    {rdelim}{if not $smarty.foreach.items.last},{/if}
    {/foreach}
    ],
    value: {$event.value|escape:'javascript':'UTF-8'}
  });
</script>
