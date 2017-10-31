<?php

  /*
   * Project    : EIS Login Module
   * EAO IT Services Pvt. Ltd. | www.eaoservices.com
   * Copyright reserved @2017

   * File Description :

   * Created on : 13 Jul, 2017 | 6:09:59 PM
   * Author     : Bilal Wani
   * Email      : bilal.wani@eaoservices

   */
  require_once 'config.php';
  if ( !class_exists("EisLog") ) {

      class EisLog {

          public static function Record($message, $file = null) {
              global $g_app_config;
              
              //if app setting logging is not enabled, don't record
              if ( !$g_app_config['logging']) {
                  return;
              }
              
              date_default_timezone_set('Asia/Calcutta');
              $dateTime = date("Y-m-d H:i:s");
              $dest_file =  dirname(__DIR__).'\logs\eis-app-log.txt';
              
              if($file){
                  $message .=  "\r\n $file";
              }
              $message .= "\r\n\r\n";
              
              error_log($dateTime . " | " . $message, 3, $dest_file);
          }

      }

  }

