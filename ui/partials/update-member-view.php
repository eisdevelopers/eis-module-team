<<<<<<< HEAD

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

            <div class="eis-input-group">
                <span class="eis-add-on"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" id="mem_name" class="form-control" name="name" placeholder="Enter Name" required>
            </div>
            <br>
            <div class="eis-input-group">
                <span class="eis-add-on"><span class="glyphicon glyphicon-pencil"></span></span>
                <input type="text" id="mem_designation"  class="form-control" name="designation" placeholder="Enter Designation" required>
            </div>
            <br>
           

            <div class="eis-input-group">
                <span class="eis-add-on"><span class="glyphicon glyphicon-filter"></span></span>
                <div class="radio-group">                    
                    <p>Status</p>
                    <label class="radio-control">Enable
                        <input type="radio" id="mem_status_enable" name="mem_status" value="1" >
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-control">Disable
                        <input type="radio"  id="mem_status_disable" name="mem_status" value="0">
                        <span class="checkmark"></span>
                    </label>
                </div>

            </div>
            <br>
            <div class="eis-input-group">
                <img src="" id="mem_dp" class="img-circle dp-size">
                <!--<span class="eis-add-on"><span class="glyphicon glyphicon-pencil"></span></span>-->
                <input type="file" class="form-control" id="mem_profile_pic" name="mem_profile_pic" accept ="image/*" required> 
            </div> 
            

            <input type="text" name="mem_id" hidden>
            <input type="text" value="4" name="msg_id" hidden="">

            <br>
            <button type="submit" id="btnMemberSubmit" class="btn btn-lg btn-info">Update</button>
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

        g_UpdateFormObj.FillForm();
        
        
    });
</script>


=======
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
<div id="eis-partial-view">
<div class="container-fluid" align="center">

    <div class="eis-subscribe" id="eis-subscribe-screen">
        <h1> Update Member Details  </h1>
        <form id="FORM-ID-UPDATE-MEMBER" action="#" class="form-horizontal" method="POST" enctype="multipart/form-data" >

            <div class="eis-input-group">
                <span class="eis-add-on"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" id="mem_name" class="form-control" name="name" placeholder="Enter Name" required>
            </div>
            <br>
            <div class="eis-input-group">
                <span class="eis-add-on"><span class="glyphicon glyphicon-pencil"></span></span>
                <input type="text" id="mem_designation"  class="form-control" name="designation" placeholder="Enter Designation" required>
            </div>
            <br>
           

            <div class="eis-input-group">
                <span class="eis-add-on"><span class="glyphicon glyphicon-filter"></span></span>
                <div class="radio-group">                    
                    <p>Status</p>
                    <label class="radio-control">Enable
                        <input type="radio" id="mem_status_enable" name="mem_status" value="1" >
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-control">Disable
                        <input type="radio"  id="mem_status_disable" name="mem_status" value="0">
                        <span class="checkmark"></span>
                    </label>
                </div>

            </div>
            <br>
            <div class="eis-input-group">
                <img src="" id="mem_dp" class="img-circle dp-size">
                <!--<span class="eis-add-on"><span class="glyphicon glyphicon-pencil"></span></span>-->
                <input type="file" class="form-control" id="mem_profile_pic" name="mem_profile_pic" accept ="image/*" required> 
            </div> 
            

            <input type="text" id="mem_id" name="mem_id" value="" hidden>
            <input type="text" value="4" name="msg_id" hidden="">

            <br>
            <button type="submit" id="btnUpdateMemberSubmit" class="btn btn-lg btn-info">Update</button>
        </form>
    </div>
</div>
</div>

<script>
    $(document).ready(function () {
        
        g_UpdateFormObj.FillForm();
        
        $("#FORM-ID-UPDATE-MEMBER").submit(function (e) {
            var objUI = new EisUIClass();
            e.preventDefault();
            var form_data = new FormData(this);
            
            $("#eis-partial-view").hide();
            console.log("Form Data");
            console.log(form_data);
            objUI.UpdateMember(form_data, g_elem_output);
        });

        
        
        
    });
</script>



>>>>>>> 792cc8530bdee0758428c32005e8305b58106696
