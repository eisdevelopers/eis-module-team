<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../eis-team-controller.php';


$g_ctrl = new EisTeamController('localhost', 'root', '', 'eis-dev');

  /*----Test CREATE function----*/

function TestCreateMember($name, $designation, $img_url, $style_line, $status) {
    global $g_ctrl;
    $ret = $g_ctrl->CreateMember($name, $designation, $img_url, $style_line, $status);
    if( $ret==0 ){
        echo "<br> Create Member";
    }else{
        echo "Create member action has some errors.";
    }
}
   /*----Test DELETE function----*/

function TestDeleteMember($id) {
    global $g_ctrl;
    $ret = $g_ctrl->DeleteMember($id);
    if( $ret==0 ){
        echo "<br>Member Deleted";
    }else{
        echo "Delete member action has some errors.";
    }
}

/*----Test UPDATE function----*/
function TestUpdateMember($id,$name,$designation,$img) {
    global $g_ctrl;
    $ret = $g_ctrl->UpdateMember($id,$name,$designation,$img);
    echo"<br>";
    echo$ret;
    if( $ret == 0 ){
        echo "<br>Member updated";
    }else{
        echo "<br>update member action has some errors.";
    }
}
function TestSearchMember($name,$designation) {
    global $g_ctrl;
    $ret = $g_ctrl->SearchMember($name,$designation);
    echo"<br>";
    if( $ret == 0 ){
        echo "<br>Search found";
    }else{
        echo "<br>search action has some errors.";
    }
}
function TestSetMemberStatus($id) {
    global $g_ctrl;
    $ret = $g_ctrl->SetMemberStatus($id);
    if( $ret==0 ){
        echo "no updated";
    }else{
        echo "status  updated";
    }
}
//function TestDeleteMember($id) {
//    global $g_ctrl;
//  $result = $g_ctrl->DeleteMember($id);
//if  (($g_ctrl->GetErrorNum() == 0 ) && ($result) ) {
//    echo $this->o_userModel->DeleteUser($id);
// } else {
// echo $g_ctrl->GetErrorMsg();
// }
// }
//TestDeleteMember(5);
//TestUpdateMember(8,'kisan','web','https://localhost/GitHub/team-module/media/img/bilal-wani-profile-2017.png' );
//TestCreateMember("kirab","technisian","https://localhost/GitHub/team-module/media/img/bilal-wani-profile-2017.png"," ",'active');
//TestSearchMember('kamjran',"");
TestSetMemberStatus(19) ;