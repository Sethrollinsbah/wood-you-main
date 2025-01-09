{*
* 2017-2027 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2017-2027 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<script type="text/x-template" id="cline">
<div class="line">
  <i class="icon-move btn btn-default"></i>
  <template v-if="line.type == 'font'">
    <input :value="line.type" disabled />
    <input placeholder="title" :class="validate('title', line.title)" v-model="line.title" />
    <input placeholder="class" :class="validate('class', line.class)" v-model="line.class" />
    <cselect :value="line.fontfamily" @change="changeFont" class="font-family-select" title="font family" ></cselect>
    <input v-model="line.fontsize" placeholder="font size" title="font size" class="fontsize-input" />
    <input placeholder="description" v-model="line.description" />
  </template>
  <template v-if="line.type == 'width'">
    <input :value="line.type" disabled />
    <input placeholder="title" :class="validate('title', line.title)" v-model="line.title" />
    <input placeholder="class" :class="validate('class', line.class)" v-model="line.class" />
    <select class="line-width" v-model="line.width">
      <option value="container">container</option>
      <option value="wide">wide</option>
    </select>
    <input placeholder="description" v-model="line.description" />
  </template>
  <template v-if="colorTypes.indexOf(line.type) != -1">
    <select name="type" v-model="line.type" @change="changedValue"> <!-- edit Alex -->
      <option v-for="type in colorTypes" :value="type">##labels[type]##</option>
    </select>
    <input placeholder="title" :class="validate('title', line.title)" v-model="line.title" />
    <input placeholder="class" :class="validate('class', line.class)" v-model="line.class" />
    <span class="colorpicker-wrap" ref="colorpicker">
      <div class="colorpicker" v-show="showColorPicker">
        <colorpicker :value="line.color" @input="onUpdateColor" />
      </div>
    </span>
    <input placeholder="default color" :style="colorStyle"  :class="validate('color', line.color)" v-model="line.color" />
<span class="color-picker-icon"><img @click="showColorPicker = true" ref="colorinput" src="{$smarty.const._PS_ADMIN_IMG_|escape:'html':'UTF-8'}color.png" /></span>
    <input placeholder="default property" :style="propStyle" v-model="line.prop" />
    <!-- add Alex -->
    <input placeholder="h-shadow" v-if="show_text_shadow_field || line.type == 'textshadow'" v-bind:class="validate('h_shadow', line.h_shadow)" v-model="line.h_shadow"/>
    <input placeholder="v-shadow" v-if="show_text_shadow_field || line.type == 'textshadow'" v-bind:class="validate('v_shadow', line.v_shadow)" v-model="line.v_shadow"/>
    <input placeholder="blur-radius" v-if="show_text_shadow_field || line.type == 'textshadow'" v-bind:class="validate('blur-radius', line.blur_radius)" v-model="line.blur_radius"/>
    <!-- ! add Alex -->
    <input placeholder="description" v-model="line.description" />
  </template>
    <div class="btn btn-default remove" @click.stop="removeLine"><i class="icon-trash"></i>Delete</div>
</div>
</script>

<script type="text/x-template" id="cselect">
<div class="custom-select">
  <template v-if="gfonts.length > 0">
    <input :value="selected" @click="onClick" placeholder="font family" @input="onInput" type="text" ref="input"/>
    <div class="opts-wrap" v-show="showOpts" ref="opts">
      <div class="opt" v-for="opt in fonts" @click="onOptClick" @mouseover="onMouseOver(opt)"> ## opt ## </div>
    </div>
  </template>
  <template v-else>
    <span class="miss-fonts-message">{l s='Fill fonts api key' mod='colorconfigurator'}</span>
  </template>
</div>
</script>

<script type="text/x-template" id="groups">
<div class="panel colorconfigurator">
  <div class="panel-heading">
    <div class="panel-heading-action">
      <a class="list-toolbar-btn">
        <i class="process-icon-new add-main-group" @click="addGroup" title="Add new group"></i>
      </a>
      <a class="list-toolbar-btn">
        <i class="process-icon-eraser clear-colors" @click="globals.clearcolors = !globals.clearcolors" title="Clear colors"></i>
      </a>
      <a class="list-toolbar-btn">
        <i class="icon-trash remove-sub" @click="sub = []" title="Remove all sub"></i>
      </a>
    </div>
    <div class="btn btn-default collapse-all" @click="globals.showall = false"><i class="icon-collapse-alt"></i>Collapse All</div>
    <div href="#" class="btn btn-default expand-all" @click="globals.showall = true"><i class="icon-expand-alt"></i>Expand All</div>
  </div>
{literal}
  <draggable :element="'div'" :list="sub" class="drag-sub" :options="{group:{ name:'g2'}, handle: '.icon-move'}">
{/literal}
    <group v-for="group in sub" :group="group" @addLines="addChildLines(group)" @addGroups="addChildGroups(group)" @removeGroup="removeChildGroup"></group>
  </draggable>
</div>
</script>


<script type="text/x-template" id="group">
<div class="group" >
  <i class="icon-move btn btn-default"></i>
{literal}
  <input :class="{'not-valid': group.name == ''}" name="group-name" placeholder="group name" v-model="group.name">
  <div class="btn btn-default group-toggle" @click="showToggle"><i :class="{'icon-plus': !showLines, 'icon-minus': showLines}"></i></div>
{/literal}
  <div class="group-head">
    <div class="btn btn-default add-group" title="Add group" @click="addGroup"><i class="icon-sitemap"></i></div>
    <div class="btn btn-default add-color" title="Add color" @click="addColor">color</div>
    <div class="btn btn-default" title="Add font" @click="addFont">font</div>
    <div class="btn btn-default" title="Add width" @click="addWidth">width</div>
    <div class="btn btn-default remove-group" title="Remove group" @click="removeGroup"><i class="icon-trash"></i></div>
  <select v-model="group.visibility" title="visibility">
    <option v-for="name in frontControllers" :value="name">##name##</option>
  </select>
  </div>

  <div class="lines" v-show="showLines">
{literal}
    <draggable :element="'div'" :list="group.lines" class="drag-lines" :options="{group:{ name:'g1'}, handle: '.icon-move'}">
      <cline v-for="line in group.lines" :line="line" @removeLine="removeLine"></cline>
    </draggable>
    <draggable :element="'div'" :list="group.sub" class="drag-sub" :options="{group:{ name:'g2'}, handle: '.icon-move'}">
    <group v-for="group in group.sub" :group="group" @addLines="addChildLines(group)" @addGroups="addChildGroups(group)" @removeGroup="removeChildGroup"></group>
    </draggable>
{/literal}
  </div>
</div>
</script>

<script type="text/x-template" id="switch">
<span class="switch prestashop-switch">
  {literal}
  <label @click="$emit('change', 1)" :class="{'checked': value == 1}">Yes</label>
  <label @click="$emit('change', 0)" :class="{'checked': value == 0}">No</label>
  <a class="slide-button btn" :class="{'no': value == 0}"></a>
  {/literal}
</span>
</script>
