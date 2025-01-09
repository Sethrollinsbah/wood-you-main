Module is installed in a regular way - simply upload your archive and click install

===========================
v 2.5.0 (August 27, 2017)
===========================
- [+] New option: allow posting only for customers who placed orders
- [+] Configurable multilingual friendly URL and SEO meta fields for Testimonials page
- [+] Configurable left/right columns and h1-header for Testimonials page
- [*] Compatibility with PS 1.7
- [*] Improved configuration interface
- [*] Misc fixes and optimizations

Files modified
-----
- /testimonialswithavatars.php
- /controllers/front/ajax.php
- /controllers/front/testimonials.php
- /views/css/back.css
- /views/css/front_simple.css
- /views/css/front.css
- /views/js/back.js
- /views/js/front_simple.js
- /views/js/front.js
- /views/templates/admin/configure.tpl
- /views/templates/admin/post-list.tpl
- /views/templates/front/post-list.tpl
- /views/templates/front/twa.tpl

Files added
-----
- /upgrade/install-2.5.0.php
- /views/templates/admin/form-group.tpl
- /views/templates/front/content-17.tpl
- /readme_en.pdf

===========================
v 2.2.0 (May 23, 2017)
===========================
- [+] New option: allow posting only for registered customers
- [*] Fixed fields validation on PHP 7
- [*] Fixed carousel responsivity on resizing window
- [*] Misc fixes and improvements

Files modified
-----
- /testimonialswithavatars.php
- /controllers/front/testimonials.php
- /views/js/front.js
- /views/js/front_simple.js
- /views/templates/front/post-list.tpl
- views/templates/front/twa.tpl

===========================
v 2.1.4 (November 11, 2015)
===========================
[+] Show/hide view all link
[*] Minor code optimizations

Files modified
-----
- /testimonialswithavatars.php
- /views/templates/admin/configure.tpl
- /views/templates/hook/twa_hook.tpl
- /Readme.md

===========================
v 2.1.3 (September 18, 2015)
===========================
[-] Removed $_POST declarations, basing on validator requirements

Files modified
-----
- /testimonialswithavatars.php
- /Readme.md

===========================
v 2.1.2 (June 30, 2015)
===========================
Changed
-----
- Keep settings and posts in other shops during reset
- Minor code optimizations

Files modified
-----
- /testimonialswithavatars.php
- /views/js/back.js
- /views/templates/admin/post-list.tpl
- /Readme.md

===========================
v 2.1.1 (May 28, 2015)
===========================
Changed
-----
- Set unique names for avatars, uploaded by guests. So guest avatars are not bound to guest->id anymore
- Minor bug fixes

Files modified
-----
- /testimonialswithavatars.php
- /Readme.md


===========================
v 2.1.0 (May 25, 2015)
===========================
Changed
-----
- Replaced Owl carousel by BxSlider, that is included in default PS installation
- Changed folder structure basing on validator requirements

Directories moved to /views/:
-----
- /js
- /css
- /img

Files modified
-----
- /testimonialswithavatars.php
- /views/templates/front/post-list.tpl
- /views/templates/front/twa.tpl
- /views/templates/hook/twa_hook.tpl
- /views/js/front_simple.js
- /views/js/front.js
- /views/css/front_simple.css
- /views/css/front.css

Files added
-----
- /upgrade/index.php
- /upgrade/install-2.1.0.php
- /Readme.md

Files removed
-----
- /changelog.txt

Directories removed
-----
- /views/js/owl/
- /views/css/owl/
- /views/img/owl/


===========================
v 2.0.0 (February 10, 2015)
===========================

Changed name from guestbookwithavatars to testimonialswithavatars.


Added
-----
- Possibility to add rating
- Possibility to change post positions

Updated
-----
- Enhanced demo data install
- Updated backoffice interface
- Misc bug fixes


Files modified:
-----
Most of files were modified/renamed due to module name change

===========================
v 1.0.0 (November 12, 2014)
===========================
Initial relesase
