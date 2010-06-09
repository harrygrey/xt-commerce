<?php
/* -----------------------------------------------------------------------------------------
   $Id: create_account.php,v 1.12 2004/03/22 13:18:46 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(create_account.php,v 1.63 2003/05/28); www.oscommerce.com
   (c) 2003  nextcommerce (create_account.php,v 1.27 2003/08/24); www.nextcommerce.org 

   Released under the GNU General Public License 
   -----------------------------------------------------------------------------------------
   Third Party contribution:

   Credit Class/Gift Vouchers/Discount Coupons (Version 5.10)
   http://www.oscommerce.com/community/contributions,282
   Copyright (c) Strider | Strider@oscworks.com
   Copyright (c  Nick Stanko of UkiDev.com, nick@ukidev.com
   Copyright (c) Andre ambidex@gmx.net
   Copyright (c) 2001,2002 Ian C Wilson http://www.phesis.org


   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

  include( 'includes/application_top.php');
     // create smarty elements
  $smarty = new Smarty;
  // include boxes
  require(DIR_FS_CATALOG .'templates/'.CURRENT_TEMPLATE. '/source/boxes.php'); 

  // include needed functions
  require_once(DIR_FS_INC . 'xtc_draw_radio_field.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_country_list.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_countries.inc.php');
  require_once(DIR_FS_INC . 'xtc_draw_checkbox_field.inc.php');
  require_once(DIR_FS_INC . 'xtc_draw_password_field.inc.php');
  require_once(DIR_FS_INC . 'xtc_validate_email.inc.php');
  require_once(DIR_FS_INC . 'xtc_encrypt_password.inc.php');
  require_once(DIR_FS_INC . 'xtc_php_mail.inc.php');
  require_once(DIR_FS_INC . 'xtc_draw_hidden_field.inc.php');
  require_once(DIR_FS_INC . 'xtc_draw_pull_down_menu.inc.php');
  require_once(DIR_FS_INC . 'xtc_validate_vatid.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_geo_zone_code.inc.php');
  require_once(DIR_WS_CLASSES . 'class.phpmailer.php');
  require_once(DIR_FS_INC . 'xtc_write_user_info.inc.php');


  $process = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    $process = true;

    if (ACCOUNT_GENDER == 'true') $gender = xtc_db_prepare_input($_POST['gender']);
    $firstname = xtc_db_prepare_input($_POST['firstname']);
    $lastname = xtc_db_prepare_input($_POST['lastname']);
    if (ACCOUNT_DOB == 'true') $dob = xtc_db_prepare_input($_POST['dob']);
    $email_address = xtc_db_prepare_input($_POST['email_address']);
    if (ACCOUNT_COMPANY == 'true') $company = xtc_db_prepare_input($_POST['company']);
    if (ACCOUNT_COMPANY_VAT_CHECK == 'true') $vat = xtc_db_prepare_input($_POST['vat']);
    $street_address = xtc_db_prepare_input($_POST['street_address']);
    if (ACCOUNT_SUBURB == 'true') $suburb = xtc_db_prepare_input($_POST['suburb']);
    $postcode = xtc_db_prepare_input($_POST['postcode']);
    $city = xtc_db_prepare_input($_POST['city']);
    $zone_id = xtc_db_prepare_input($_POST['zone_id']);
    if (ACCOUNT_STATE == 'true') $state = xtc_db_prepare_input($_POST['state']);
    $country = xtc_db_prepare_input($_POST['country']);
    $telephone = xtc_db_prepare_input($_POST['telephone']);
    $fax = xtc_db_prepare_input($_POST['fax']);
    $newsletter = '0';
    $password = xtc_db_prepare_input($_POST['password']);
    $confirmation = xtc_db_prepare_input($_POST['confirmation']);

    $error = false;

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('create_account', ENTRY_GENDER_ERROR);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_LAST_NAME_ERROR);
    }

    if (ACCOUNT_DOB == 'true') {
      if (checkdate(substr(xtc_date_raw($dob), 4, 2), substr(xtc_date_raw($dob), 6, 2), substr(xtc_date_raw($dob), 0, 4)) == false) {
        $error = true;

        $messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }

// Vat Check
  if(xtc_get_geo_zone_code($country) != '6'){

  if ($vat !=''){

  if (ACCOUNT_COMPANY_VAT_CHECK == 'true') {

  $validate_vatid = validate_vatid($vat);

  if ($validate_vatid == '0') {
  if (ACCOUNT_VAT_BLOCK_ERROR == 'true'){
  $messageStack->add('create_account', ENTRY_VAT_ERROR);
  $error = true;
  }
  $customer_group = DEFAULT_CUSTOMERS_STATUS_ID;
  $customers_vat_id_status  = '0';
  }

  if($validate_vatid == '1') {
  if ($country == '81'){
  $customer_group = DEFAULT_CUSTOMERS_STATUS_ID;
  }else{

  if (ACCOUNT_COMPANY_VAT_GROUP == 'true'){
  $customer_group = DEFAULT_CUSTOMERS_VAT_STATUS_ID;
  }else{
  $customer_group = DEFAULT_CUSTOMERS_STATUS_ID;
  }
  }
  $customers_vat_id_status  = '1';
  }

  if($validate_vatid == '8'){
  if (ACCOUNT_VAT_BLOCK_ERROR == 'true'){
  $messageStack->add('create_account', ENTRY_VAT_ERROR);
  $error = true;
  }
  $customer_group = DEFAULT_CUSTOMERS_STATUS_ID;
  $customers_vat_id_status  = '8';
  }

  if($validate_vatid == '9'){
  if (ACCOUNT_VAT_BLOCK_ERROR == 'true'){
  $messageStack->add('create_account', ENTRY_VAT_ERROR);
  $error = true;
  }
  $customer_group = DEFAULT_CUSTOMERS_STATUS_ID;
  $customers_vat_id_status  = '9';
  }

  }else {
  $customer_group = DEFAULT_CUSTOMERS_STATUS_ID;
  }

  }else{
  $customer_group = DEFAULT_CUSTOMERS_STATUS_ID;
  }
  }
// Vat Check

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (xtc_validate_email($email_address) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    } else {
      $check_email_query = xtc_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . xtc_db_input($email_address) . "'");
      $check_email = xtc_db_fetch_array($check_email_query);
      if ($check_email['total'] > 0) {
        $error = true;

        $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      }
    }

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_POST_CODE_ERROR);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_CITY_ERROR);
    }

    if (is_numeric($country) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_COUNTRY_ERROR);
    }

    if (ACCOUNT_STATE == 'true') {
      $zone_id = 0;
      $check_query = xtc_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
      $check = xtc_db_fetch_array($check_query);
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        $zone_query = xtc_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name like '" . xtc_db_input($state) . "%' or zone_code like '%" . xtc_db_input($state) . "%')");
        if (xtc_db_num_rows($zone_query) > 1) {
        $zone_query = xtc_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and zone_name = '" . xtc_db_input($state) . "'");
        }
        if (xtc_db_num_rows($zone_query) >= 1) {
          $zone = xtc_db_fetch_array($zone_query);
          $zone_id = $zone['zone_id'];
        } else {
          $error = true;

          $messageStack->add('create_account', ENTRY_STATE_ERROR_SELECT);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('create_account', ENTRY_STATE_ERROR);
        }
      }
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_TELEPHONE_NUMBER_ERROR);
    }


    if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR);
    } elseif ($password != $confirmation) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
    }

    if ($error == false) {
      $sql_data_array = array('customers_vat_id' => $vat,
                              'customers_vat_id_status' => $customers_vat_id_status,
                              'customers_status' => $customer_group,
                              'customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
                              'customers_password' => xtc_encrypt_password($password));

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = xtc_date_raw($dob);





      


      xtc_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $_SESSION['customer_id'] = xtc_db_insert_id();
      $user_id=xtc_db_insert_id();
      xtc_write_user_info($user_id);
      $sql_data_array = array('customers_id' => $_SESSION['customer_id'],
                              'entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = $zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

      xtc_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = xtc_db_insert_id();

      xtc_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . $address_id . "' where customers_id = '" . (int)$_SESSION['customer_id'] . "'");

      xtc_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$_SESSION['customer_id'] . "', '0', now())");
      
      if (SESSION_RECREATE == 'True') {
        xtc_session_recreate();
      }

      $_SESSION['customer_first_name'] = $firstname;
      $_SESSION['customer_last_name'] = $lastname;
      $_SESSION['customer_default_address_id'] = $address_id;
      $_SESSION['customer_country_id'] = $country;
      $_SESSION['customer_zone_id'] = $zone_id;

      // restore cart contents
      $_SESSION['cart']->restore_contents();

      // build the message content
      $name = $firstname . ' ' . $lastname;


      // load data into array
      $module_content = array();
      $module_content = array(
        'MAIL_NAME' => $name,
        'MAIL_REPLY_ADDRESS' => EMAIL_SUPPORT_REPLY_ADDRESS,
        'MAIL_GENDER'=>$gender);

      // assign data to smarty
      $smarty->assign('language', $_SESSION['language']);
      $smarty->assign('logo_path',HTTP_SERVER.DIR_WS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/img/');
      $smarty->assign('content', $module_content);
      $smarty->caching = false;


      // GV Code Start
            // ICW - CREDIT CLASS CODE BLOCK ADDED  ******************************************************* BEGIN
              if (NEW_SIGNUP_GIFT_VOUCHER_AMOUNT > 0) {
                $coupon_code = create_coupon_code();
                $insert_query = xtc_db_query("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $coupon_code . "', 'G', '" . NEW_SIGNUP_GIFT_VOUCHER_AMOUNT . "', now())");
                $insert_id = xtc_db_insert_id($insert_query);
                $insert_query = xtc_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $email_address . "', now() )");


                $smarty->assign('SEND_GIFT','true');
                $smarty->assign('GIFT_AMMOUNT',$xtPrice->xtcFormat(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT,true));
                $smarty->assign('GIFT_CODE',$coupon_code);
                $smarty->assign('GIFT_LINK',xtc_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code,'NONSSL', false));

              }
              if (NEW_SIGNUP_DISCOUNT_COUPON != '') {
                $coupon_code = NEW_SIGNUP_DISCOUNT_COUPON;
                $coupon_query = xtc_db_query("select * from " . TABLE_COUPONS . " where coupon_code = '" . $coupon_code . "'");
                $coupon = xtc_db_fetch_array($coupon_query);
                $coupon_id = $coupon['coupon_id'];
                $coupon_desc_query = xtc_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $coupon_id . "' and language_id = '" . (int)$_SESSION['languages_id'] . "'");
                $coupon_desc = xtc_db_fetch_array($coupon_desc_query);
                $insert_query = xtc_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $coupon_id ."', '0', 'Admin', '" . $email_address . "', now() )");

                $smarty->assign('SEND_COUPON','true');
                $smarty->assign('COUPON_DESC',$coupon_desc['coupon_description']);
                $smarty->assign('COUPON_CODE',$coupon['coupon_code']);

              }
            // ICW - CREDIT CLASS CODE BLOCK ADDED  ******************************************************* END
            // GV Code End       // create templates
      $smarty->caching = 0;
      $html_mail = $smarty->fetch(CURRENT_TEMPLATE . '/mail/'.$_SESSION['language'].'/create_account_mail.html');
      $smarty->caching = 0;
      $txt_mail = $smarty->fetch(CURRENT_TEMPLATE . '/mail/'.$_SESSION['language'].'/create_account_mail.txt');

      xtc_php_mail(EMAIL_SUPPORT_ADDRESS,EMAIL_SUPPORT_NAME,$email_address , $name , EMAIL_SUPPORT_FORWARDING_STRING, EMAIL_SUPPORT_REPLY_ADDRESS, EMAIL_SUPPORT_REPLY_ADDRESS_NAME, '', '', EMAIL_SUPPORT_SUBJECT, $html_mail, $txt_mail);

      if (!isset($mail_error)) {
          xtc_redirect(xtc_href_link(FILENAME_SHOPPING_CART, '', 'SSL'));
      }
      else {
          echo $mail_error;
      }
    }
  }

  $breadcrumb->add(NAVBAR_TITLE_CREATE_ACCOUNT, xtc_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));

 require(DIR_WS_INCLUDES . 'header.php');


  if ($messageStack->size('create_account') > 0) {
  $smarty->assign('error',$messageStack->output('create_account'));

  }
  $smarty->assign('FORM_ACTION',xtc_draw_form('create_account', xtc_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onSubmit="return check_form(create_account);"') . xtc_draw_hidden_field('action', 'process'));

  if (ACCOUNT_GENDER == 'true') {
  $smarty->assign('gender','1');

  $smarty->assign('INPUT_MALE',xtc_draw_radio_field('gender', 'm'));
  $smarty->assign('INPUT_FEMALE',xtc_draw_radio_field('gender', 'f').(xtc_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''));

  } else {
    $smarty->assign('gender','0');
    }

  $smarty->assign('INPUT_FIRSTNAME',xtc_draw_input_field('firstname') . '&nbsp;' . (xtc_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''));
  $smarty->assign('INPUT_LASTNAME',xtc_draw_input_field('lastname') . '&nbsp;' . (xtc_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''));

  if (ACCOUNT_DOB == 'true') {
  $smarty->assign('birthdate','1');

  $smarty->assign('INPUT_DOB',xtc_draw_input_field('dob') . '&nbsp;' . (xtc_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="inputRequirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''));

  }  else {
  $smarty->assign('birthdate','0');
  }

  $smarty->assign('INPUT_EMAIL',xtc_draw_input_field('email_address') . '&nbsp;' . (xtc_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''));

  if (ACCOUNT_COMPANY == 'true') {
  $smarty->assign('company','1');
  $smarty->assign('INPUT_COMPANY',xtc_draw_input_field('company') . '&nbsp;' . (xtc_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''));
  }  else {
  $smarty->assign('company','0');
  }

  if (ACCOUNT_COMPANY_VAT_CHECK == 'true') {
  $smarty->assign('vat','1');
  $smarty->assign('INPUT_VAT',xtc_draw_input_field('vat') . '&nbsp;' . (xtc_not_null(ENTRY_VAT_TEXT) ? '<span class="inputRequirement">' . ENTRY_VAT_TEXT . '</span>': ''));
  }  else {
  $smarty->assign('vat','0');
  }

  $smarty->assign('INPUT_STREET',xtc_draw_input_field('street_address') . '&nbsp;' . (xtc_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''));

  if (ACCOUNT_SUBURB == 'true') {
  $smarty->assign('suburb','1');
 $smarty->assign('INPUT_SUBURB',xtc_draw_input_field('suburb') . '&nbsp;' . (xtc_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''));

  } else {
  $smarty->assign('suburb','0');
  }

  $smarty->assign('INPUT_CODE',xtc_draw_input_field('postcode') . '&nbsp;' . (xtc_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''));
  $smarty->assign('INPUT_CITY',xtc_draw_input_field('city') . '&nbsp;' . (xtc_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''));

  if (ACCOUNT_STATE == 'true') {
  $smarty->assign('state','1');

    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = xtc_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = xtc_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        $state_input= xtc_draw_pull_down_menu('state', $zones_array);
      } else {
        $state_input= xtc_draw_input_field('state');
      }
    } else {
      $state_input= xtc_draw_input_field('state');
    }

    if (xtc_not_null(ENTRY_STATE_TEXT)) $state_input.= '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT;

   $smarty->assign('INPUT_STATE',$state_input);
  } else {
  $smarty->assign('state','0');
  }

  if ($_POST['country']){
  $selected = $_POST['country'];
  }else{
  $selected = STORE_COUNTRY;
  }

  $smarty->assign('SELECT_COUNTRY',xtc_get_country_list('country', $selected) . '&nbsp;' . (xtc_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''));
  $smarty->assign('INPUT_TEL',xtc_draw_input_field('telephone') . '&nbsp;' . (xtc_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''));
  $smarty->assign('INPUT_FAX',xtc_draw_input_field('fax') . '&nbsp;' . (xtc_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''));
  //$smarty->assign('CHECKBOX_NEWSLETTER',xtc_draw_checkbox_field('newsletter', '1') . '&nbsp;' . (xtc_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="inputRequirement">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''));
  $smarty->assign('INPUT_PASSWORD',xtc_draw_password_field('password') . '&nbsp;' . (xtc_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_TEXT . '</span>': ''));
  $smarty->assign('INPUT_CONFIRMATION',xtc_draw_password_field('confirmation') . '&nbsp;' . (xtc_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''));

  $smarty->assign('language', $_SESSION['language']);
  $smarty->caching = 0;
  $smarty->assign('BUTTON_SUBMIT',xtc_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE));
  $main_content=$smarty->fetch(CURRENT_TEMPLATE . '/module/create_account.html');

  $smarty->assign('language', $_SESSION['language']);
  $smarty->assign('main_content',$main_content);
  $smarty->caching = 0;
  if (!defined(RM)) $smarty->load_filter('output', 'note');
  $smarty->display(CURRENT_TEMPLATE . '/index.html');
  ?>