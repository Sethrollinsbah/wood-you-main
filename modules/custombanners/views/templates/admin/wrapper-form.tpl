{*
* 2007-2018 Amazzing
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
*
*  @author    Amazzing <mail@amazzing.ru>
*  @copyright 2007-2018 Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*
*}

{$settings = $cb->getWrapperSettingsFields($id_wrapper)}
{$carousel_settings = $cb->getWrapperSettingsFields($id_wrapper, 'carousel')}
<div class="cb-wrapper{if !$banners} empty{/if}" data-id="{$id_wrapper|intval}">
    <div class="w-actions">
        <form class="w-settings-form">
            <input type="hidden" name="id_wrapper" value="{$id_wrapper|intval}">
            {foreach $settings as $k => $field}
                {include file="./form-group.tpl"
                    name = $k
                    field = $field
                    form_identifier = $id_wrapper
                    group_class = 'inline-block wrapper-form-group'
                    label_class = 'inline-label'
                    input_wrapper_class = 'inline-block'
                    input_class = 'save-on-the-fly'
                }
            {/foreach}
            <a href="#" class="callSettings btn btn-default{if $settings.display_type.value != 2} hidden{/if}" data-settings="carousel">
                <i class="icon-wrench"></i> {l s='Carousel settings' mod='custombanners'}
            </a>
            <a href="#" class="addBanner pull-right">
                <i class="icon-plus"></i>
                <span class="btn-txt">{l s='New banner' mod='custombanners'}</span>
            </a>
        </form>
        <form class="carousel-settings-form form-horizontal panel" style="display:none">
            <input type="hidden" name="id_wrapper" value="{$id_wrapper|intval}">
            {$total = $carousel_settings|count}
            {$half = $total/2}
            {$first_column = $carousel_settings|array_slice:0:$half}
            {$second_column = $carousel_settings|array_slice:$half:$total}
            {foreach [$first_column, $second_column] as $i => $carousel_settings}
                <div class="col-lg-6">
                    {foreach $carousel_settings as $k => $field}
                        {include file="./form-group.tpl"
                            name = $k
                            field = $field
                            form_identifier = $id_wrapper
                            label_class = 'control-label col-lg-6'
                            input_wrapper_class = 'col-lg-6'
                        }
                    {/foreach}
                </div>
            {/foreach}
            <div class="p-footer">
                <button class="btn btn-default saveCarouselSettings"><i class="process-icon-save"></i> {l s='Save' mod='custombanners'}</button>
            </div>
        </form>

        <a href="#" class="deleteWrapper" title="{l s='Delete wrapper' mod='custombanners'}"><i class="icon-trash"></i></a>
        <a href="#" class="dragger w-dragger">
            <i class="icon icon-arrows-v"></i>
        </a>
        <div class="settings-container" style="display:none;"></div>
    </div>
    <div class="banner-list">
        {foreach $banners as $banner}
            {include file="./banner-form.tpl" banner = $banner}
        {/foreach}
    </div>
</div>
