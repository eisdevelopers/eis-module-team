/*
 * File : main.js
 * Description: Main JS file for all partial forms related to members of the team
 * Author: Nazoo Akhter
 * Company: EAO IT SERVICES
 * 
 * History:
 * Created  - 17-Oct-2017
 */
/*
 * @config 
 */
var g_server_url = 'http://192.168.43.25/github/team-module/server/eis-team-controller.php';
 g_server_url = 'http://localhost:88/team-module/server/eis-team-controller.php';


function LoadMembers() {
    $.ajax({
        method: "get",
        url: 'http://localhost:88/team-module/server/eis-team-controller.php?msg_id=1',
        success: function (data) {
//            alert("Ureka!!!");
            console.log(data);

            DisplayMembers(JSON.parse(data));
        },
        error: function (data) {
            alert("Gadbad");
        }
    });
}


function DisplayMembers(members) {
    var html = "<div class='eis-team-container'>";
    for (var i = 0; i < members.length; i++) {
        html += "<div class='eis-team-profile'> <div class='team-wrapper'>";
        if (members[i].img_url == undefined) {
            html += "<img src= '" + "img/default.png" + "'>";
        } else {
            html += "<img src= '" + members[i].img_url + "'>";
        }

        html += "<div class='team-des'>";
        html += "<h2>" + members[i].name + "</h2>";
        html += "<p>" + members[i].designation + "</p>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
    }

    html += "</div>";
    document.getElementById('output').innerHTML = html;
}


function ProcessMembers() {
    $.ajax({
        method: "get",
        url: g_server_url + '?msg_id=1',
        success: function (data) {
//            alert("Ureka!!!");
            console.log(data);

            DisplayMemberList(JSON.parse(data));
        },
        error: function (data) {
            alert("Gadbad");
        }
    });


}
/*
 * viewMemberList : This function provides an updated list of Members in the database 
 * Return table
 */
function DisplayMemberList(members) {
    var html = "<div class='eis-admin-container' id='displaymember'> <div> ";
    html += "<table class='table table-striped'><thead><tr><th><strong>Image</strong></th><th><strong>Name</strong></th><th><strong>Designation</th><th><strong>Actions</th></tr>";
    for (var i = 0; i < members.length; i++) {
        html += "<tr><td>";
        var id = members[i].id;
        if (members[i].img_url == undefined) {
            html += "<img class='img-circle' src= '" + "img/default.png" + "'>";
        } else {
            html += "<img class='img-circle' src= '" + members[i].img_url + "'>";
        }
        html += "</td>";
        html += "<td><input type=text  readonly value= '" + members[i].name + "'></td>";
        html += "<td>" + members[i].designation + "</td>";

        //Check for status
        var status_label = 'Disable';
        if (members[i].status == 0) {
            status_label = 'Enable';
        }

        html += "<td>"
        html += "<button id='btn_up_" + id + "'>Update</button>";
        html += "<button id='btn_del_" + id + "' value='" + id + "'>Delete</button>";

        html += "<button id='btn_status_" + id + "' value=''>" + status_label + "</button>";
        html += "</td>";
        html += "</tr>";

    }

    html += "</table>";
    html += "</div>";
    html += "</div>";
    document.getElementById('members').innerHTML = html;

    for (var i = 0; i < members.length; i++) {
        AddBtnHandler("btn_del_" + members[i].id);
    }

}


function AddBtnHandler(id) {
    $("#" + id).on('click', function () {
        var mem_id = $("#" + id).val();
        $.ajax({
            method: "get",
            url: 'http://localhost:88/team-module/server/eis-team-controller.php?msg_id=3&mem_id=' + mem_id,
            success: function (data) {
//            alert("Ureka!!!");
                console.log(data);
                alert("Response for delete request")

//                DisplayMemberList(JSON.parse(data));
            },
            error: function (data) {
                alert("Gadbad - delete");
            }
        });
    });
}

$(document).ready(function(){
    $("#idListMembers").on('click', function(e){
        e.preventDefault();
        $("#content").load('partials/list-members-view.php');    
        
    });
    
    $("#idAddMember").on('click', function(e){
        e.preventDefault();
        $("#content").load('partials/create-member-view.php');         
    });
    
    $("#idUpdateMember").on('click', function(e){
        e.preventDefault();
        $("#content").load('partials/list-members-view.php');         
    });
    
     $("#idDelMember").on('click', function(e){
        e.preventDefault();
        $("#content").load('partials/list-members-view.php');         
    });
    
    
    function init(){
        $("#content").load('partials/list-members-view.php');    
    }
    
    init();
});