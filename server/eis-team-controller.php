
<?php

  header("Access-Control-Allow-Origin: *");
  /*
   * Project    : EIS Subscription Module
   * EAO IT Services Pvt. Ltd. | www.eaoservices.com
   * Copyright reserved @2017

   * File Description :

   * Created on : 3 Oct, 2017 | 12:38:45 PM
   * Author     : Bilal Wani
   * Email      : bilal.wani@eaoservices

   */
  session_start();

  require_once 'config.php';
  require_once 'log-class.php';
  require 'eis-team-model.php';

//CODE for Message ID
  define("MSG_GET_MEMBERS", 1);
  define("MSG_CREATE_MEMBERS", 2);
  define("MSG_VIEW_MEMBERS", 3);
  define("MSG_UPDATE_MEMBER", 4);
  define("MSG_DELETE_MEMBER", 5);
  define("MSG_SEARCH_MEMBER", 6);
  define("MSG_MEMBER_STATUS", 7);

  class EisMessage {

      public $msg_id;
      public $msg_data;

  }

  class EisResponse {

      public static $res_array = ["msg_id" => null, 'data' => array(), 'errno' => 0, 'err_msg' => null];

  }

  if ( !class_exists('EisTeam') ) {

      class EisTeamController {

          private $m_model_team = null;
          private $m_error_msg = null;

          public function __construct($host, $user, $pwd, $database) {
              $this->m_model_team = new EisTeamModel($host, $user, $pwd, $database);
          }

          public function SetError($msg) {
              $this->m_error_msg = $msg;
          }

          public function GetErrorMsg() {
              return $this->m_error_msg;
          }
          
          public function GetErrorNum(){
              return $this->m_model_team->GetErrorNum();
          }

          public function Dispatcher($message) {
              $msgid = $message->msg_id;
              $result = -1;


              switch ($msgid) {
                  case MSG_GET_MEMBERS:
                      $result = $this->GetAllMembers();
                      break;

                  case MSG_CREATE_MEMBERS:
                      $name = $message->msg_data["name"];
                      $designation = $message->msg_data["designation"];
                      $img_filename = strtolower($name);

                      $img_url = $this->HandleFileUpload($_FILES, "profile_pic", $img_filename);

                      if ( $img_url == NULL ) {
                          /* This is error in image upload, don't proceed */
                          $this->SetError("Something is wrong with your profile picture. Please check");
                          return $result;
                      }

                      $result = $this->m_model_team->CreateMember($name, $designation, $img_url, null, 1);

                      if ( EIS_DEBUG ) {
                          EisLog::Record(__FUNCTION__ . " | Return : " . $result);
                      }
                      break;

                  case MSG_VIEW_MEMBERS:
                      if ( $this->m_model_team ) {
                          $result = $this->m_model_team->viewMemberList();
                      }
                      break;

                  case MSG_UPDATE_MEMBER:
                      $id = $message->msg_data["mem_id"];
                      if ( isset($id) ) {
                          $name = $message->msg_data["name"];
                          $designation = $message->msg_data["designation"];

                          $img_filename = strtolower($name);

                          $img_url = $this->HandleFileUpload($_FILES, "mem_profile_pic", $img_filename);

                          $result = $this->UpdateMember($id, $name, $designation, $img_url);
                      } else {
                          echo "Unable to update the member details";
                      }
                      break;

                  case MSG_DELETE_MEMBER:
                      if ( isset($message->msg_data["mem_id"]) ) {
                          $mem_id = $message->msg_data["mem_id"];
                          $result = $this->DeleteMember($mem_id);
                      } else {
                          $result = "Please provide valid member id";
                      }
                      break;

                  case MSG_SEARCH_MEMBER:
                      if ( isset($message["srh"]) ) {
                          $search = $message["search"];
                          $result = $this->SearchMember($search);
                      } else {
                          echo "<br> No Result Found !!!<br>";
                      }
                      break;

                  case MSG_MEMBER_STATUS:
                      if ( isset($message->msg_data["mem_id"]) ) {
                          $id = $message->msg_data["mem_id"];
                          $value = $message->msg_data["status"];
                          $result = $this->SetMemberStatus($id, $value);
                      } else {
                          $result = "Please provide valid member id";
                      }
                      break;

                  default;
              }
              return $result;
          }

          public function GetAllMembers() {

              $result = $this->m_model_team->GetAllMembers();

              return $result;
          }

          public function CreateMember($name, $designation, $img_url, $style_line, $status) {
              $ret = $this->m_model_team->CreateMember($name, $designation, $img_url, $style_line, $status);
              if ( EIS_DEBUG ) {
                  EisLog::Record(__FUNCTION__ . "Ret = " . $ret);
              }
              return $ret;
          }

          public function DeleteMember($id) {
              $ret = $this->m_model_team->DeleteMember($id);
              return $ret;
          }

          public function UpdateMember($id, $name, $designation, $img) {
              $result = 0;
              if ( EIS_DEBUG ) {
                  EisLog::Record(__FUNCTION__ . " Invoke Update Memeber Model");
              }
              if ( $this->m_model_team ) {
                  $result = $this->m_model_team->UpdateMember($id, $name, $designation, $img);
              }
              return $result;
          }

          public function SearchMember($name, $designation) {
              $ret = $this->m_model_team->SearchMember($name, $designation);
              return $ret;
          }

          /** @method SetMemberStatus
           * 
           * @param type $id
           * 
           * @return on success runs query
           */
          public function SetMemberStatus($id, $value) {
              $ret = $this->m_model_team->SetMemberStatus($id, $value);
              return $ret;
          }

          public function HandleFileUpload($_files, $fileToUpload, $img_name) {
              /*
               * The file is first stored at $_FILES[$fileToUpload]["tmp_name"]
               */
              $target_dir = "./../media/img/";
              $target_file = $target_dir . basename($_files[$fileToUpload]["name"]);
              $target_file_name = null;


              $imgFileType = pathinfo($target_file, PATHINFO_EXTENSION);
              $allow_upload = false;


              //Get image size
              $imgSize = filesize($_files[$fileToUpload]["tmp_name"]);

              EisLog::Record(__FUNCTION__ . " File Type  = " . $imgFileType);

              if ( EIS_DEBUG ) {
                  EisLog::Record(__FUNCTION__ . " File Type  = " . $imgFileType);
                  EisLog::Record(__FUNCTION__ . " File Size  = " . $imgSize);
              }

              //Check file type for jpeg or png
              if ( $imgFileType == 'jpeg' ||
                      $imgFileType == 'jpg' ||
                      $imgFileType == 'png' ) {
                  $allow_upload = true;
                  $target_file_name = $img_name . "." . $imgFileType;
                  $target_file = $target_dir . $target_file_name;
              } else {
                  $allow_upload = false;
              }

              /* Allow files less than 1 MB Size */
              if ( $imgSize > ( 1 * 1024 * 1024) ) {
                  $allow_upload = false;
              }

              if ( $allow_upload ) {
                  $ret = move_uploaded_file($_files[$fileToUpload]["tmp_name"], $target_file);
                  if ( $ret == false ) {
                      return null;
                  } else {
                      return "media/img/" . $target_file_name;
                  }
              }
          }

      }

  }

  if ( isset($_REQUEST) ) {

      $method = $_SERVER['REQUEST_METHOD'];
      global $g_server, $g_pwd, $g_user, $g_db;

      $ctrl = new EisTeamController($g_server, $g_user, $g_pwd, $g_db);
      $MsgObj = new EisMessage();

      switch ($method) {
          //Handle Post Request
          case "POST":
              global $g_server, $g_pwd, $g_user, $g_db;

              try {
                  $ctrl = new EisTeamController($g_server, $g_user, $g_pwd, $g_db);
                  $MsgObj = new EisMessage();
                 if ( isset($_POST["msg_id"]) ) {
                      $MsgObj->msg_id = $_POST["msg_id"];
                  }

                  $MsgObj->msg_data = $_POST;
                  ;
                  //$MsgObj->msg_id = $_GET["msg_id"];

                  $result = $ctrl->Dispatcher($MsgObj);
                  $json_obj = json_encode($result);
                  echo $json_obj;
              } catch (Exception $ex) {
                  echo "Error : " . $ex->getMessage();
              }

              $MsgObj->msg_id = $_POST["msg_id"];
              $MsgObj->msg_data = $_POST;          
              break;

          //Handle Get Request
          case "GET":
                  if ( isset($_GET["msg_id"]) ) {
                      $MsgObj->msg_id = $_GET["msg_id"];
                  }

                  $MsgObj->msg_data = $_GET;
              break;
      }

      if ( EIS_DEBUG ) {
          EisLog::Record(__FUNCTION__ . "MSG_ID: " . $MsgObj->msg_id );
      }

      try {
          $result = $ctrl->Dispatcher($MsgObj);
          EisResponse::$res_array['msg_id'] = $MsgObj->msg_id;
          EisResponse::$res_array['data'] = $result;
          EisResponse::$res_array['errno'] = $ctrl->GetErrorNum();
          EisResponse::$res_array['err_msg'] = $ctrl->GetErrorMsg();
          
          $json_obj = json_encode(EisResponse::$res_array);

          //send response
          echo $json_obj;
      } catch (Exception $e) {
          echo "Error : " . $ex->getMessage();
      }
  }

  /*
   * Test Functions
   */

  function TestGetAllMembers() {
      global $g_server, $g_pwd, $g_user, $g_db;

      try {
          $ctrl = new EisTeamController($g_server, $g_user, $g_pwd, $g_db);

          $members = $ctrl->GetAllMembers();
          $json_obj = json_encode($members);
          echo $json_obj;
      } catch (Exception $ex) {
          echo "Error : " . $ex->getMessage();
      }
  }

  function TestHandleFileUpload() {
      try {
          global $g_server, $g_pwd, $g_user, $g_db;
          $ctrl = new EisTeamController($g_server, $g_user, $g_pwd, $g_db);

          $ctrl->HandleFileUpload($_SESSION["FILES"], "profile_pic");
      } catch (Exception $ex) {
          echo "Error : " . $ex->getMessage();
      }
  }

//  TestHandleFileUpload();
//  TestGetAllMembers();

  