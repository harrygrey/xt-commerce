<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_precision.inc.php 70 2007-01-07 14:19:12Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   by Mario Zanier for XTcommerce
   
   based on:
   (c) 2003	 nextcommerce (xtc_precision.inc.php,v 1.5 2003/08/19); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
   
function xtc_precision($number,$places)
	{
	 return (round($number,$places));
	}
 ?>