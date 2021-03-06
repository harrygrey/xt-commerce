<?php

/* -----------------------------------------------------------------------------------------
   $Id: callback_mb.php 57 2007-01-04 00:57:53Z mzanier $   

   xt:Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2006 xt:Commerce

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/


include ('../../includes/application_top_callback.php');
include (DIR_FS_DOCUMENT_ROOT.'includes/modules/payment/amoneybookers.php');
// redirect

$data = array ();

if (count($_POST) > 0) {

	$mb = new amoneybookers();

	$data['pay_to_email'] = xtc_db_prepare_input($_POST['pay_to_email']);
	$data['pay_from_email'] = xtc_db_prepare_input($_POST['pay_from_email']);
	$data['merchant_id'] = xtc_db_prepare_input($_POST['merchant_id']);
	$data['transaction_id'] = xtc_db_prepare_input($_POST['transaction_id']);
	$data['mb_transaction_id'] = xtc_db_prepare_input($_POST['mb_transaction_id']);
	$data['mb_amount'] = xtc_db_prepare_input($_POST['mb_amount']);
	$data['mb_currency'] = xtc_db_prepare_input($_POST['mb_currency']);
	$data['status'] = xtc_db_prepare_input($_POST['status']);
	$data['md5sig'] = xtc_db_prepare_input($_POST['md5sig']);
	$data['amount'] = xtc_db_prepare_input($_POST['amount']);
	$data['currency'] = xtc_db_prepare_input($_POST['currency']);

	$response = $mb->callback_process($data);

	if ($mb->debug) {
		$mb->_logTransactions();
	}
	if ($mb->repost) {
		header('HTTP/1.0 404 Not Found');
	} else {
		header("HTTP/1.0 200 OK");
	}
}
?>