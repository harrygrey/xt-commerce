<?php

/* -----------------------------------------------------------------------------------------
   $Id: paypal.php 192 2007-02-24 16:24:52Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(paypal.php,v 1.7 2002/04/17); www.oscommerce.com 
   (c) 2003	 nextcommerce (paypal.php,v 1.4 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

define('MODULE_PAYMENT_PAYPAL_TEXT_TITLE', 'PayPal');
define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', 'PayPal');
define('MODULE_PAYMENT_PAYPAL_TEXT_INFO', '');
define('MODULE_PAYMENT_PAYPAL_STATUS_TITLE', 'PayPal Modul aktivieren');
define('MODULE_PAYMENT_PAYPAL_STATUS_DESC', 'M&ouml;chten Sie Zahlungen per PayPal akzeptieren?');
define('MODULE_PAYMENT_PAYPAL_ID_TITLE', 'eMail Adresse');
define('MODULE_PAYMENT_PAYPAL_ID_DESC', 'eMail Adresse, welche f&uuml;r PayPal verwendet wird');
define('MODULE_PAYMENT_PAYPAL_CURRENCY_TITLE', 'Transaktionsw&auml;hrung');
define('MODULE_PAYMENT_PAYPAL_CURRENCY_DESC', 'W&auml;hrung, welche f&uuml;r Kreditkartentransaktionen verwendet wird');
define('MODULE_PAYMENT_PAYPAL_TMP_STATUS_ID_TITLE', 'Tempor&auml;er Bestellstatus');
define('MODULE_PAYMENT_PAYPAL_TMP_STATUS_ID_DESC', 'Bestellstatus f&auml;r noch nicht abgeschlossene Transaktionen');
define('MODULE_PAYMENT_PAYPAL_USE_CURL_TITLE', 'cURL');
define('MODULE_PAYMENT_PAYPAL_USE_CURL_DESC', 'cURL Anbindung oder normale Weiterleitung.');

define('MODULE_PAYMENT_PAYPAL_COST_TITLE', _MODULES_PAYMENT_FEE_TITLE);
define('MODULE_PAYMENT_PAYPAL_COST_DESC', _MODULES_PAYMENT_FEE_DESC);
define('MODULE_PAYMENT_PAYPAL_ZONE_TITLE', _MODULES_ZONE_TITLE);
define('MODULE_PAYMENT_PAYPAL_ZONE_DESC', _MODULES_ZONE_DESC);
define('MODULE_PAYMENT_PAYPAL_ALLOWED_TITLE', _MODULES_ZONE_ALLOWED_TITLE);
define('MODULE_PAYMENT_PAYPAL_ALLOWED_DESC', _MODULES_ZONE_ALLOWED_DESC);
define('MODULE_PAYMENT_PAYPAL_SORT_ORDER_TITLE', _MODULES_SORT_ORDER_TITLE);
define('MODULE_PAYMENT_PAYPAL_SORT_ORDER_DESC', _MODULES_SORT_ORDER_DESC);
define('MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID_TITLE', _MODULES_SET_ORDER_STATUS_TITLE);
define('MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID_DESC', _MODULES_SET_ORDER_STATUS_DESC);
?>