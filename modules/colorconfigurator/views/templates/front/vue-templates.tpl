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

<script type="text/x-template" id="language">
<li>
  <template v-if="s == 'wide'">{l s='wide' mod='colorconfigurator'}</template>
  <template v-if="s == 'box'">{l s='box' mod='colorconfigurator'}</template>
  <template v-if="s == 'yes'">{l s='yes' mod='colorconfigurator'}</template>
  <template v-if="s == 'no'">{l s='no' mod='colorconfigurator'}</template>
  <template v-if="s == 'Fill content'">{l s='Fill content' mod='colorconfigurator'}</template>
  <template v-if="s == 'Fixed menu'">{l s='Fixed menu' mod='colorconfigurator'}</template>
  <template v-if="s == 'Border radius'">{l s='Border radius' mod='colorconfigurator'}</template>
  <template v-if="s == 'Box shadow'">{l s='Box shadow' mod='colorconfigurator'}</template>
</li>
</script>

<script type="text/x-template" id="switch">
<ol :class="cls">
  <li v-if="label"><lang :s="label" /></li>
  <li class="btn btn-default" @click="$emit('change', opt)" :class="getActiveClass(opt)" v-for="(opt, name) in options">
    <!-- <lang :s="name" /> -->
    <input class="form-check-input" type="checkbox" :id="name" :value="name">
    <label :for="name"> <lang :s="name" /> </label>
  </li>
</ol>
</script>


<script type="text/x-template" id="group">
<ol class="group" v-show="!hidden && (group.visibility == 'everywhere' || group.visibility == colorConfigData.settings.php_self)">
  <li class="group-name">## group.name ##</li>
  <li @click="showLines = !showLines"><span :class="groupToggle"></span></li>
  <li v-show="showLines">

    <cline v-for="line in group.lines" :line="line" ref="cline" @changeline="changeLine(line)"></cline>
    <group v-for="group in group.sub" :group="group" @onhide="onChildHide" @changeline="changeLine(arguments[0])" ref="group"></group>
  </li>
</ol>
</script>


<script type="text/x-template" id="cselect">
<ol class="c-select">
  <input :value="selected" @click="onClick" @input="onInput" type="text" ref="input"/>
  <ul class="opts-wrap" v-if="showOpts === true" ref="opts">
    <ol class="opt" v-for="opt in fonts" :key="opt.family" @click="onOptClick" @mouseover="onMouseOver(opt.family)"> ## opt.family ## </ol>
  </ul>
</ol>
</script>

<script type="text/x-template" id="cline">
<ol class="line" v-show="!hidden">
  <template v-if="line.type == 'width'">
    <li class="class-title" :title="line.description">##line.title##</li>
    <select class="width-select" v-model="line.width" @change="changeWidth">
      <option value="container">container</option>
      <option value="wide">wide</option>
    </select>
  </template>
  <template v-if="line.type == 'font'">
    <li class="class-title" :title="line.description">##line.title##</li>
    <li class="font-size-wrap">
      <cselect :value="line.fontfamily" @change="changeFont" title="font family" ></cselect>
      <input :value="line.fontsize" @keydown="onKeyDownFontSize" title="font size" class="fontsize-input" @input="onInputFontSize" type="text" />
    </li>
  </template>
  <template v-if="colorTypes.indexOf(line.type) != -1">
    <li class="class-title" :title="line.description">##line.title##</li>
    <ul class="color-wrap">
      {literal}
      <!-- <li class="color" @click="$emit('changeline', line)" ref="color" :style="{'background-color': line.color}"></li> -->
      <li class="color"  ref="color" :style="{'background-color': line.color}"><input class="color"  ref="color" type="checkbox" @click="$emit('changeline', line)" /></li>
      {/literal}
    </ul>
  </template>
</ol>
</script>
