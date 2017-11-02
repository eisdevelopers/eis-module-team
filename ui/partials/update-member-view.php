<?php
  /**
   * Project : EIS Login Module
   * EAO IT Services Pvt. Ltd. | www.eaoservices.com
   * Copyright reserved @2017

   * File Description :

   * Created on : 13 Jul, 2017 | 4:52:51 PM
   * Author     : Bilal Wani
   * Email      : bilal.wani@eaoservices

   * History:
   * Author
   */
?>

<div class="container-fluid" align="center">

    <div class="eis-subscribe" id="eis-subscribe-screen">
        <h1> Update Member Details  </h1>
        <form id="FORM-ID-UPDATE-MEMBER" action="#" class="form-horizontal" method="POST" enctype="multipart/form-data" >
            <input type="text" name="mem_id" hidden>
            <div class="eis-input-group">
                <span class="eis-add-on"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
            </div>
            <br>
            <div class="eis-input-group">
                <span class="eis-add-on"><span class="glyphicon glyphicon-pencil"></span></span>
                <input type="text" class="form-control" name="designation" placeholder="Enter Designation" required>
            </div>
            <br>

            <div class="eis-input-group">
                <span class="eis-add-on"><span class="glyphicon glyphicon-pencil"></span></span>
                <input type="file"  class="form-control" id="profile_pic" name="profile_pic" accept ="image/*" required> 
            </div> 

            <input type="text" value="2" name="msg_id" hidden="">

            <br>
            <button type="submit" id="btnMemberSubmit" class="btn btn-lg btn-info">Submit</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#FORM-ID-UPDATE-MEMBER").submit(function (e) {
            var objUI = new EisUIClass();
            e.preventDefault();
            var form_data = new FormData(this);
            console.log(form_data);
            objUI.UpdateMember(form_data, 'server-message');
        });
    });
</script>



