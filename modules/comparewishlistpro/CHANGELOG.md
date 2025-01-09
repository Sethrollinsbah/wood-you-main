# Changelog

## 1.4.8 - 2021-04-26

- Add compatibility with the _Product Attribute List_ module.

### Modified files

- /views/js/front.js

## 1.4.7 - 2021-04-24

- Use the inactive wishlist icon in the header if wishlist is empty.

### Modified files

- /views/js/front.js
- /views/templates/front/display-nav.tpl
- /views/templates/front/wishlist-icon-active.tpl
- /views/templates/front/wishlist-icon.tpl

## 1.4.6 - 2021-04-23

- Remove parentheses around wishlist and comparison product counts in the header.
- Replace remaining wishlist Material Design icons with SVG.

### Modified files

- /views/css/front.css
- /views/templates/front/display-nav-mobile.tpl
- /views/templates/front/display-nav.tpl
- /views/templates/front/easywishlist-extra.tpl
- /views/templates/front/my-account.tpl

## 1.4.5 - 2021-04-23

- Fix wishlist table not updating properly after default wishlist deletion.
- Explicitly escape some template variables to pass _PrestaShop Addons_ moderation.
- Minor improvements.

### Modified files

- /controllers/front/mywishlist.php
- /views/js/front.js
- /views/templates/front/comparison.tpl
- /views/templates/front/easywishlist-ajax.tpl
- /views/templates/front/easywishlist-extra.tpl
- /views/templates/front/easywishlist.tpl
- /views/templates/front/easywishlist_button.tpl
- /views/templates/front/managewishlist.tpl
- /views/templates/front/view.tpl
- /views/templates/hook/display-admin-customers.tpl
- /comparewishlistpro.php

### Removed files

- /views/templates/admin/\_configure/helpers/list/list_content.tpl

## 1.4.4 - 2021-04-21

- Fix the same wishlist and comparison links template being used on user account pages and in the footer.

### Modified files

- /comparewishlistpro.php

## 1.4.3 - 2021-04-10

- Fix wishlist and comparison icons on catalog pages disappearing after certain actions (filtering, sorting, etc.) sometimes.

### Modified files

- /views/js/front.js

## 1.4.2 - 2021-04-06

- Fix wishlist and comparison links styling on the user account page.

### Modified files

- /comparewishlistpro.php

## 1.4.1 - 2021-03-26

- Improve module UI in the front office.
- Restructure parts of the module to meet _PrestaShop Addons Marketplace_ requirements.

### Modified files

- /views/css/front.css
- /views/js/front.js
- /views/templates/front/easywishlist-catalog.tpl
- /comparewishlistpro.php

### Added files

- /controllers/front/buywishlistproduct.php
- /controllers/front/cart.php
- /controllers/front/comparisontools.php
- /controllers/front/managewishlist.php
- /controllers/front/sendwishlist.php

### Removed files

- /buywishlistproduct.php
- /cart.php
- /comparisontools.php
- /managewishlist.php
- /sendwishlist.php

## 1.4.0 - 2021-03-18

- Add ability to install module settings from an external file.
- Minor improvements.

### Modified files

- /views/css/front.css
- /views/js/front.js
- /views/templates/front/easywishlist-catalog.tpl
- /views/templates/front/easywishlist-extra.tpl
- /comparewishlistpro.php

### Added files

- /views/templates/front/wishlist-icon-active.tpl
- /views/templates/front/wishlist-icon.tpl

## 1.3.0 - 2021-03-17

- Add a more suitable icon for products not added to a wishlist.
- Improve wishlist notifications.
- Minor improvements.

### Modified files

- /views/css/front.css
- /views/js/front.js
- /views/templates/admin/configure.tpl
- /views/templates/front/easywishlist-catalog.tpl
- /views/templates/front/easywishlist-extra.tpl
- /comparewishlistpro.php

### Added files

- /views/templates/hook/display-admin-customers.tpl
- /views/templates/hook/display-wishlist-products.tpl

## 1.2.1 - 2021-03-12

- Add module logo.
- Minor improvements.

### Modified files

- /views/js/front.js
- /comparewishlistpro.php

### Added files

- /logo.gif
- /logo.png

## 1.2.0 - 2021-03-12

- Add a hook for use with the _Customer “Sign in” link_ module.
- Improve notification image loading for users with slow connections.
- Replace comparison icon with a more suitable one.
- Minor improvements.

### Modified files

- /views/css/front.css
- /views/js/front.js
- /views/templates/front/display-nav.tpl
- /views/templates/front/easywishlist-catalog.tpl
- /views/templates/front/easywishlist-extra.tpl
- /views/templates/front/my-account.tpl
- /comparewishlistpro.php

### Added files

- /views/templates/front/comparison-icon.tpl
- /views/templates/hook/display-customer-sign-in-menu-links.tpl

## 1.1.1 - 2021-01-13

- Fix comparison table back button not working properly.
- Fix some links on wishlist pages leading to non-existent pages.

### Modified files

- /views/js/front.js
- /views/templates/front/easywishlist.tpl
- /views/templates/front/managewishlist.tpl
- /views/templates/front/my-account-links.tpl
- /views/templates/front/view.tpl

## 1.1.0 - 2020-12-04

- Add options for changing container elements of mobile menu items and product page buttons.
- Fix wrong coloring of the condition and brand rows in the comparison table when filtering products.
- Improve compatibility with the Presta Search module.

### Modified files

- /views/js/front.js
- /comparewishlistpro.php

## 1.0.1 - 2020-11-22

- Remove sharing link for the now-defunct Google+.

## 1.0.0 - 2020-11-15

- Initial release.
