Module is installed in a regular way - simply upload your archive and click install.

CHANGELOG:
===========================
v 1.3.1 (July 10, 2017)
===========================
- [*] Fixed $itemsList.sortable error on product sheet

Files modified
-----
- /amazzingblog.php

===========================
v 1.3.0 (July 9, 2017)
===========================
- [+] Related products/posts
- [+] New block types: selected blog categories, subcategories
- [*] Improved exceptions for blocks
- [*] Minor updates in configuration interface
- [*] Misc fixes and optimizations

Files modified
-----
- /amazzingblog.php
- /classes/BlogFields.php
- /controllers/admin/AdminBlog.php
- /controllers/front/blog.php
- /defaults/data.zip
- /views/css/back.css
- /views/css/front.css
- /views/js/back.js
- /views/js/front.js
- /views/js/post.js
- /views/templates/admin/block-form.tpl
- /views/templates/admin/category-tree.tpl
- /views/templates/admin/configure.tpl
- /views/templates/admin/field.tpl
- /views/templates/admin/item-header.tpl
- /views/templates/admin/post-form.tpl
- /views/templates/admin/post-images.tpl
- /views/templates/admin/settings-form.tpl
- /views/templates/front/category.tpl
- /views/templates/front/pagination.tpl
- /views/templates/front/post.tpl
- /views/templates/front/post-list.tpl
- views/templates/front/post-list-item.tpl
- /views/templates/front/post-list-item-compact.tpl
- /views/templates/hook/blocks.tpl

Files added
-----
- /upgrade/install-1.3.0.php
- /views/css/related-products.css
- /views/templates/admin/product-tab.tpl
- /views/templates/admin/related-items.tpl
- /views/templates/front/item-list.tpl
- /views/templates/front/product-list-item.tpl

===========================
v 1.2.2 (March 31, 2017)
===========================
- [+] New option in category settings: ajax/non-ajax pagination
- [+] French translation
- [*] Autosave number of posts per page selected by user
- [*] Fixed auto-generated link_rewrite for new added posts
- [*] Minor fixes

Files modified
-----
- /amazzingblog.php
- /classes/BlogFields.php
- /controllers/front/blog.php
- /views/js/back.js
- /views/js/category.js
- /views/templates/front/pagination.tpl
- /views/templates/front/post-list.tpl
- /views/templates/front/post-tags.tpl

Files added
-----
- /translations/fr.php
- /upgrade/install-1.2.2.php

===========================
v 1.2.1 (January 25, 2017)
===========================
- [+] Define number of posts per page in category settings
- [*] Fixed pagination bug on category page
- [*] Fixed isDate validation for posts added before 12 PM

Files modified
-----
- /amazzingblog.php
- /classes/BlogFields.php
- /controllers/front/blog.php
- /views/templates/front/pagination.tpl
- /views/js/category.js
- /views/css/back.css
- /views/css/category.css

Files added
-----
- /views/css/category-17.css

===========================
v 1.2.0 (November 23, 2016)
===========================
- [+] Scheduled publication dates (from-to)
- [+] Post tags
- [+] New sorting options in BO: state, tags
- [+] New block type: Related posts
- [+] Added tags icon to Blog-icons-font
- [*] Compatibility with PS 1.7
- [*] Special class for empty avatars
- [*] Improved exceptions mechanism: display hook only on selected pages
- [*] Removed extra step for saving new post before adding images

Files modified
-----
- /amazzingblog.php
- /classes/BlogFields.php
- /controllers/front/blog.php
- /views/css/back.css
- /views/css/blog-icons.css
- /views/css/front.css --------------------------------> note
- /views/css/post.css ---------------------------------> note
- /views/css/icons.css
- /views/fonts/blogIcons.eot
- /views/fonts/blogIcons.svg
- /views/fonts/blogIcons.ttf
- /views/fonts/blogIcons.woff
- /views/js/back.js
- /views/js/post.js -----------------------------------> note
- /views/templates/admin/block-form.tpl
- /views/templates/admin/category-tree.tpl
- /views/templates/admin/configure.tpl
- /views/templates/admin/field.tpl
- /views/templates/admin/hook-exceptions-form.tpl
- /views/templates/admin/item-header.tpl
- /views/templates/admin/multilang-field.tpl
- /views/templates/admin/post-form.tpl
- /views/templates/front/breadcrumbs.tpl --------------> note
- /views/templates/front/comment-form.tpl -------------> note
- /views/templates/front/comment.tpl ------------------> note
- /views/templates/front/post-list.tpl ----------------> note
- /views/templates/front/post.tpl ---------------------> note
- /views/templates/front/sorting.tpl
- /views/templates/hook/blocks.tpl --------------------> note
- /defaults/data.zip

Files added
-----
- /upgrade/install-1.2.0.php
- /views/css/back-17.css
- /views/templates/front/post-list-item.tpl
- /views/templates/front/post-list-item-compact.tpl
- /views/templates/front/post-tags.tpl
- /views/templates/front/content-17.tpl

Files removed
-----
- /views/templates/front/post-list-compact.tpl


===========================
v 1.0.2 (July 16, 2016)
===========================
- [*] Fixed possible smarty variables interference
- [*] Fixed tooltips in popups
- [*] Minor fixes

Files modified
-----
- /amazzingblog.php
- /controllers/front/blog.php
- /classes/BlogFields.php
- /views/js/back.js
- /views/templates/front/category.tpl
- /views/templates/front/post.tpl

===========================
v 1.0.1 (July 3, 2016)
===========================
- [*] Fixed general settings > date > none
- [*] Fixed fields validation on PHP 7
- [*] Fixed multilang content bug on saving posts

Files modified
-----
- /amazzingblog.php
- /classes/BlogFields.php
- /views/templates/front/post-list.tpl
- /views/templates/front/post-list-compact.tpl

===========================
v 1.0.0 (May 17, 2016)
===========================
Initial release
