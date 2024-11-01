=== Wp Stock Sync ===
Contributors: rob9095
Donate link: http://www.paypal.me/rob9095
Tags: woocommerce, stock, inventory, sync, out of stock, in stock
Requires at least: 3.0.1
Tested up to: 4.8.2
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin or "fix" for woocommerce that sums variable product stock quantity and then saves that sum as the parent product's stock value. This plugin becomes helpful if your store has a large amount of variable products and you'd like to use the Woocommerce default "Hide out of stock items from the catalog" setting. By default, this setting will only hide out of stock parent products from the front end. This setting is not useful if you have variable products and will works correctly if you manage stock at the product level and regularly update the total inventory value for each parent product. Well, this plugin does exactly that! Horray! Each time your site is accessed or when the products page is viewed from the admin dashboard, the variable product stock quntities will be summed and the parent product will be updated if neccesary. Problem Solved!

== Description ==

A plugin or "fix" for woocommerce that sums variable product stock quantity and then saves that sum as the parent product's stock value. This plugin becomes helpful if your store has a large amount of variable products and you'd like to use the Woocommerce default "Hide out of stock items from the catalog" setting. By default, this setting will only hide out of stock parent products from the front end. This setting is not useful if you have variable products and only works correctly if you manage stock at the product level and regularly update the total inventory value for each parent product. Well, this plugin does exactly that! Horray! Each time your site is accessed or when the products page is viewed from the admin dashboard, the variable product stock quntities will be summed and the parent product will be updated if neccesary. Problem Solved!

== Installation ==

Installation and Setup Info

1. Upload the plugin to the plugins directory or download from the repository
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Activate the sync by navigating to Settings > WP Stock Sync in the WordPress Admin Dashboard

== Frequently Asked Questions ==

= Why is the plugin not working? =

First be sure that you have the sync activated by navigating to Settings > WP Stock Sync in the WordPress Admin Dashboard. Make sure the "Activate Sync" checkbox is checked and then hit the "Save Changes" Button.

If you can confirm the sync is active but the plugin still isn't working right, please check your product and woocommerce settings. Be sure all your products have the checkbox "Enable stock management at product level" checked and also if you would like to hide the out of stock products be sure that option is checked under Woocommerce > Settings > Products > Inventory in the WordPress Admin Dashboard. If you are still having issues open a support ticket at our website or ask us a question on the support forum.

== Screenshots ==

1. The extra Total Quantity column added to the products admin page.

== Changelog ==

= 1.0 =
* Initial Release

== Upgrade Notice ==
=1.0=
*Initial Release

== Main Features ==

Features:

1. Sums variation stock quantity and updates parent product with that stock value
2. The sum occurs when someone access the site and an inventory update is neccesary