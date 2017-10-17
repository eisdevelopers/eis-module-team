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

if (!class_exists('EisTeam')) {

    class EisTeamController {

        private $m_model_team = null;

        public function __construct($host, $user, $pwd, $database) {
            $this->m_model_team = new EisTeamModel($host, $user, $pwd, $database);
        }

        public function Dispatcher($message) {
            $msgid = $message->msg_id;
            $result = null;


            switch ($msgid) {
                case MSG_GET_MEMBERS:
                    $result = $this->GetAllMembers();
                    break;

                case MSG_CREATE_MEMBERS:
                    $img_url = $this->HandleFileUpload($_FILES, "profile_pic");
                    $name = $message->msg_data["name"];
                    $designation = $message->msg_data["designation"];
                    
                    $result = $this->m_model_team->CreateMember($name, $designation, $img_url, null, 1);
                    break;

                case MSG_VIEW_MEMBERS:
                    if ($this->m_model_team) {
                        $result = $this->m_model_team->viewMemberList();
                    }
                    break;

                case MSG_UPDATE_MEMBER:
                    $id = $message["mem_id"];
                    if (isset($message["upd"])) {
                        $name = $message["name"];
                        $designation = $message["name"];
                        $img = $message["img"];
                        $result = $this->UpdateMember($id, $name, $designation, $img);
                    } else {
                        echo "<br> Updated Successfully !!!<br>";
                    }
                    break;

                case MSG_DELETE_MEMBER:
                    if (isset($message->msg_data["mem_id"])) {
                        $mem_id = $message->msg_data["mem_id"];
                        $result = $this->DeleteMember($mem_id);
                    } else {
                        $result = "Please provide valid member id";
                    }
                    break;
                    
                case MSG_SEARCH_MEMBER:
                    if (isset($message["srh"])) {
                        $search = $message["search"];
                        $result = $this->SearchMember($search);
                    } else {
                        echo "<br> No Result Found !!!<br>";
                    }
                    break;
                    
                case MSG_MEMBER_STATUS:
                    if (isset($message->msg_data["mem_id"])) {
                        $id = $message->msg_data["mem_id"];
                        $result = $this->SetMemberStatus($id);
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
            return $ret;
        }

        public function DeleteMember($id) {
            $ret = $this->m_model_team->DeleteMember($id);
            return $ret;
        }

        public function UpdateMember($id, $name, $designation, $img) {
            if ($this->m_model_team) {
                $result = $this->m_model_team->UpdateMember($id, $name, $designation, $img);
            } return $result;
        }

        public function SearchMember($name, $designation) {
            $ret = $this->m_model_team->SearchMember($name, $designation);
            return $ret;
        }

        public function SetMemberStatus($id) {
            $ret = $this->m_model_team->SetMemberStatus($id);
            return $ret;
        }

        public function HandleFileUpload($_files, $fileToUpload) {
            /*
             * The file is first stored at $_FILES[$fileToUpload]["tmp_name"]
             */
            $target_dir = "../media/img/";
            $target_file = $target_dir . basename($_files[$fileToUpload]["name"]);

            $imgFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            echo "Type : $imgFileType </br>";

            //Get image size
//              $imgSize = getimagesize($_files[$fileToUpload]["tmp_name"]);

            $ret = move_uploaded_file($_files[$fileToUpload]["tmp_name"], $target_file);
            if ($ret == false) {
                return null;
            } else {
                return $target_file;
            }
        }

    }

}

if (isset($_REQUEST)) {

    $method = $_SERVER['REQUEST_METHOD'];
    //$message = $_GET;
//      echo $method;
    switch ($method) {
        case "POST":
            global $g_server, $g_pwd, $g_user, $g_db;

            try {
                $ctrl = new EisTeamController($g_server, $g_user, $g_pwd, $g_db);
                $MsgObj = new EisMessage();

                $MsgObj->msg_id = $_POST["msg_id"];
                $MsgObj->msg_data = $_POST;
                ;
                //$MsgObj->msg_id = $_GET["msg_id"];

                $members = $ctrl->Dispatcher($MsgObj);
                $json_obj = json_encode($members);
//          var_dump($json_obj);
                echo $json_obj;
            } catch (Exception $ex) {
                echo "Error : " . $ex->getMessage();
            }

            break;
        case "GET":
            global $g_server, $g_pwd, $g_user, $g_db;

            try {
                $ctrl = new EisTeamController($g_server, $g_user, $g_pwd, $g_db);
                $MsgObj = new EisMessage();
                if (isset($_GET["msg_id"])) {
                    $MsgObj->msg_id = $_GET["msg_id"];
                }

                $MsgObj->msg_data = $_GET;

                //$MsgObj->msg_id = $_GET["msg_id"];

                $members = $ctrl->Dispatcher($MsgObj);
                $json_obj = json_encode($members);
                //var_dump($json_obj);
                echo $json_obj;
            } catch (Exception $ex) {
                echo "Error : " . $ex->getMessage();
            }
            break;
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
//          var_dump($json_obj);
        echo $json_obj;
    } catch (Exception $ex) {
        echo "Error : " . $ex->getMessage();
    }
}

function TestHandleFileUpload() {
    try {
        global $g_server, $g_pwd, $g_user, $g_db;
        $ctrl = new EisTeamController($g_server, $g_user, $g_pwd, $g_db);

        if (isset($_SESSION["FILES"])) {
            var_dump($_SESSION["FILES"]);
            $ctrl->HandleFileUpload($_SESSION["FILES"], "profile_pic");
        }
    } catch (Exception $ex) {
        echo "Error : " . $ex->getMessage();
    }
}

//  TestHandleFileUpload();
//  TestGetAllMembers();

  