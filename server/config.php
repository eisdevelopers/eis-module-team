<?php

  /*
   * Project    : EIS Subscription Module
   * EAO IT Services Pvt. Ltd. | www.eaoservices.com
   * Copyright reserved @2017

   * File Description :

   * Created on : 3 Oct, 2017 | 1:31:02 PM
   * Author     : Bilal Wani
   * Email      : bilal.wani@eaoservices

   */

  $g_server = 'localhost';
  $g_db = 'eis-dev';
  $g_user = 'root';
  $g_pwd = '';
  $g_app_config['logging'] = true;

  define("EIS_DEBUG", true);

//  error_reporting(0);
  define("APP_ROOT", dirname(__FILE__));
  DEFINE('BASE_URL', "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . '/');
  