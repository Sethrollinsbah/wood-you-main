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

{if $posts}
    <div class="presentation-wrapper">
        <div class="main-item col-lg-8">{* filled dynamically *}</div>
        <div class="all-items col-lg-4">
            {foreach $posts as $k => $post}
                <div class="presentation-preview{if !$k} current{/if}">
                    {if !empty($post.cover)}
                        <div class="presentation-preview-img">
                            {$src = $blog->img_dir|cat:'posts/'|cat:$post.id_post|cat:'/'|cat:$settings.cover_type|cat:'/'|cat:$post.cover}
                            <img src="{$src|escape:'html':'UTF-8'}">
                        </div>
                    {/if}
                    <h4 class="presentation-preview-title">
                        {$post.title|truncate:$settings.title_truncate:'...'|escape:'html':'UTF-8'}
                    </h4>
                    <div class="hidden full-content">
                        {$link = $blog->getPostLink($post.id_post, $post.link_rewrite)}
                        {if !empty($post.cover)}
                            <div class="presentation-main-cover">
                                {$src = $blog->img_dir|cat:'posts/'|cat:$post.id_post|cat:'/'|cat:$settings.main_item_img_type|cat:'/'|cat:$post.cover}
                                <img src="{$src|escape:'html':'UTF-8'}">
                            </div>
                        {/if}
                        {if !empty($blog->general_settings.date)}
                            {$split_date = $blog->prepareDate($post[$blog->general_settings.date])}
                            <div class="post-item-date">
                                {foreach $split_date as $i => $fragment}
                                    <div class="{$i|escape:'html':'UTF-8'}">{$fragment|escape:'html':'UTF-8'}</div>
                                {/foreach}
                            </div>
                        {/if}
                        <h3 class="post-item-title">
                            {$post.title|truncate:$settings.title_truncate:'...'|escape:'html':'UTF-8'}
                        </h3>
                        <div class="post-item-content">{$post.content|strip_tags|truncate:$settings.main_item_truncate:'...'|escape:'html':'UTF-8'}</div>
                        <div class="post-item-footer clearfix">
                            <div class="post-item-infos pull-left">
                                {if !empty($settings.show_author)}
                                    {$author_name = $blog->getAuthorNameById($post.author)}
                                    <span class="post-item-info author">
                                        <i class="icon-user"></i>
                                        {$author_name|escape:'html':'UTF-8'}
                                    </span>
                                {/if}
                                {if !empty($settings.show_views)}
                                    <span class="post-item-info views-num">
                                        <i class="icon-eye"></i>
                                        {$post.views|intval}
                                    </span>
                                {/if}
                                {if !empty($settings.show_comments)}
                                    <a href="{$link|escape:'html':'UTF-8'}#post-comments" class="post-item-info comments-num">
                                        <i class="icon-comment"></i>
                                        {$post.comments|intval}
                                    </a>
                                {/if}
                            </div>
                            {if !empty($settings.show_readmore)}
                                <a href="{$link|escape:'html':'UTF-8'}" title="{l s='Read more' mod='amazzingblog'}" class="item-readmore pull-right">
                                    {l s='Read more' mod='amazzingblog'}
                                    <i class="icon-arrow-right"></i>
                                </a>
                            {/if}
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
{else}
    <div class="alert-warning">{l s='No posts' mod='amazzingblog'}</div>
{/if}
