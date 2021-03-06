<?php

/* -----------------------------------------------------------------------------------------
   $Id: amoneybookers.php 192 2007-02-24 16:24:52Z mzanier $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(moneybookers.php,v 1.01 2003/01/20); www.oscommerce.com

   Released under the GNU General Public License
   -----------------------------------------------------------------------------------------
   Third Party contributions:
   Moneybookers v1.0                       Autor:    Gabor Mate  <gabor(at)jamaga.hu>

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_TITLE', 'Secure Payment through Moneybookers');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_DESCRIPTION', 'Moneybookers<br /><br /><img src="images/icon_arrow_right.gif"> <b><a href="http://www.xt-commerce.com/index.php?option=com_content&task=view&id=76&lang=en" target="_blank">Help / Explanation</a></b>');
define('MODULE_PAYMENT_AMONEYBOOKERS_NOCURRENCY_ERROR', 'There\'s no Moneybookers accepted currency installed!');
define('MODULE_PAYMENT_AMONEYBOOKERS_ERRORTEXT1', 'payment_error=');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO','');
define('MODULE_PAYMENT_AMONEYBOOKERS_ERRORTEXT2', '&error=There was an error during your payment at Moneybookers!');
define('MODULE_PAYMENT_AMONEYBOOKERS_ORDER_TEXT', 'Date of the order: ');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_ERROR', 'Payment error!');
define('MODULE_PAYMENT_AMONEYBOOKERS_CONFIRMATION_TEXT', 'Thank you for your order!');
define('MODULE_PAYMENT_AMONEYBOOKERS_TRANSACTION_FAILED_TEXT', 'Your payment transaction at Moneybookers has failed. Please try again, or select an other payment option!');

define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO_2', '<b>100% security</b> - All data transactions are secure with Moneybookers most modern security technology');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO_3', '<b>100% data protection</b> - Your personal data will be stored at Moneybookers and not be passed on to the shop');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO_4', '<b>Maximum comfort</b> -  Once you have a Moneybookers account, you only need your e-mail address and password for all future transactions');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO_5', '<b>Broad acceptance</b> -  With Moneybookers, you can pay in serveral thousand shops');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO_1', '<br /><br />Pay instantly by...');

define('MB_TEXT_MBDATE', 'Last Change:');
define('MB_TEXT_MBTID', 'TR ID:');
define('MB_TEXT_MBERRTXT', 'Status:');

define('MODULE_PAYMENT_AMONEYBOOKERS_PROCESSED_STATUS_ID_TITLE', 'Order status - Processed');
define('MODULE_PAYMENT_AMONEYBOOKERS_PROCESSED_STATUS_ID_DESC', '');

define('MODULE_PAYMENT_AMONEYBOOKERS_PENDING_STATUS_ID_TITLE', 'Order status - Sheduled');
define('MODULE_PAYMENT_AMONEYBOOKERS_PENDING_STATUS_ID_DESC', '');

define('MODULE_PAYMENT_AMONEYBOOKERS_CANCELED_STATUS_ID_TITLE', 'Order status - Canceled');
define('MODULE_PAYMENT_AMONEYBOOKERS_CANCELED_STATUS_ID_DESC', '');

define('MODULE_PAYMENT_AMONEYBOOKERS_ICONS_TITLE', 'Icons');
define('MODULE_PAYMENT_AMONEYBOOKERS_ICONS_DESC', '');


define('MODULE_PAYMENT_AMONEYBOOKERS_STATUS_TITLE', 'Enable Moneybookers');
define('MODULE_PAYMENT_AMONEYBOOKERS_STATUS_DESC', 'Do you want to accept payments through Moneybookers?<br /><br /><img src="images/icon_arrow_right.gif"> <b><a href="http://www.xt-commerce.com/index.php?option=com_content&task=view&id=76&lang=en" target="_blank">Help / Explanation</a></b>');
define('MODULE_PAYMENT_AMONEYBOOKERS_EMAILID_TITLE', 'Email Address');
define('MODULE_PAYMENT_AMONEYBOOKERS_EMAILID_DESC', 'Email address you have registered with Moneybookers. <font color="ff0000">* Required</font>');
define('MODULE_PAYMENT_AMONEYBOOKERS_PWD_TITLE', 'Moneybookers Secret Word');
define('MODULE_PAYMENT_AMONEYBOOKERS_PWD_DESC', 'The secret word can be found in your Moneybookers profile (this is not your password!)');
define('MODULE_PAYMENT_AMONEYBOOKERS_MERCHANTID_TITLE', 'Merchant ID');
define('MODULE_PAYMENT_AMONEYBOOKERS_MERCHANTID_DESC', 'Merchant ID of your Moneybookers account <font color="ff0000">* Required</font>');
define('MODULE_PAYMENT_AMONEYBOOKERS_CURRENCY_TITLE', 'Transaction Currency');
define('MODULE_PAYMENT_AMONEYBOOKERS_CURRENCY_DESC', 'If the user\'s currency that is not available at Moneybookers this currency will be used for the payment.');
define('MODULE_PAYMENT_AMONEYBOOKERS_LANGUAGE_TITLE', 'Transaction Language');
define('MODULE_PAYMENT_AMONEYBOOKERS_LANGUAGE_DESC', 'If the user\'s language is not available at Moneybookers this language will be used for the payment.');



define('MODULE_PAYMENT_AMONEYBOOKERS_COST_TITLE',_MODULES_PAYMENT_FEE_TITLE);
define('MODULE_PAYMENT_AMONEYBOOKERS_COST_DESC',_MODULES_PAYMENT_FEE_DESC);
define('MODULE_PAYMENT_AMONEYBOOKERS_ZONE_TITLE', _MODULES_ZONE_TITLE);
define('MODULE_PAYMENT_AMONEYBOOKERS_ZONE_DESC', _MODULES_ZONE_DESC);
define('MODULE_PAYMENT_AMONEYBOOKERS_ALLOWED_TITLE' , _MODULES_ZONE_ALLOWED_TITLE);
define('MODULE_PAYMENT_AMONEYBOOKERS_ALLOWED_DESC' ,_MODULES_ZONE_ALLOWED_DESC);
define('MODULE_PAYMENT_AMONEYBOOKERS_SORT_ORDER_TITLE', _MODULES_SORT_ORDER_TITLE);
define('MODULE_PAYMENT_AMONEYBOOKERS_SORT_ORDER_DESC', _MODULES_SORT_ORDER_DESC);
?>