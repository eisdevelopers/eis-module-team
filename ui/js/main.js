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
g_server_url = 'http://localhost/github-projs/eis-module-team/server/index.php';


/*
 * @class This class provides UI Thread functionality which includes
 * 1 - Display List of Users in table format
 * 2 - Team Profile
 * 3 - Attach Dynamic Event Handlers
 * 4 - Create Dynamic Views
 * 5 - 
 */
function EisUIClass() {

    this.HandleErrorMessage = function (msg, elemID) {

    };

    /**
     * Attaches on Click Button Handler to the given element id
     * @function
     * @param {string} id - Element Id
     */
    this.AddBtnHandler = function (id) {
        $("#" + id).on('click', function () {
            var mem_id = $("#" + id).val();
            $.ajax({
                method: "get",
                url: g_server_url + '?msg_id=3&mem_id=' + mem_id,
                success: function (data) {
                    console.log(data);
                    alert("Response for delete request")

                },
                error: function (data) {
                    alert("Gadbad - delete");
                }
            });
        });
    };


    /**
     * DisplayMemberList - Create html Table with member information
     * @function
     * @param {string} members - Json Object Array of Members
     * @param {string} elementID - Html element ID to which table is attached
     * @returns {Undefined}
     */
    this.DisplayMemberList = function (members, elementID) {
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
        document.getElementById(elementID).innerHTML = html;

        for (var i = 0; i < members.length; i++) {
            this.AddDeleteHandler("btn_del_" + members[i].id);
            this.AddUpdateHandler("btn_update_" + members[i].id);
            this.AddStatusHandler("btn_status_" + members[i].id);
        }

    };

    this.AddUpdateHandler = function (elemId) {
        $("#" + elemId).on('click', function () {
            var mem_id = $("#" + elemId).val();
            $("#update-content").load('partials/update-member-view.php');
            this.PopulateUpdateForm(mem_id);
        });
    }

    /**
     * @function  PopulateUpdateForm
     * @description This function supplies input to update form
     * @param {string} mem_id  Id of the team member
     * @returns {undefined}
     */
    this.PopulateUpdateForm = function (mem_id) {
        $("#update_name").val('Bilal Wani');
    };

    this.AddDeleteHandler = function (elemId) {
        $("#" + elemId).on('click', function () {
            var mem_id = $("#" + elemId).val();
            $.ajax({
                method: "get",
                url: g_server_url + '?msg_id=5&mem_id=' + mem_id,
                success: function (data) {
                    console.log(data);
                    alert("Member Deleted");
                    location.reload();
//                DisplayMemberList(JSON.parse(data));
                },
                error: function (data) {
                    alert("Gadbad - delete");
                }
            });
        });
    };


    /**
     * @function ProcessMembers
     * @description This function sends the ajax request to get all team members from
     *              the server. The response calls DisplayMemberList method to show the results.
     * @param 
     * @returns {undefined}
     */
    this.ProcessMembers = function () {
        $.ajax({
            method: "get",
            url: g_server_url + '?msg_id=1',
            success: function (data) {
//            alert("Ureka!!!");
                console.log(data);
                var obj = new EisUIClass();
                obj.DisplayMemberList(JSON.parse(data), 'members');
            },
            error: function (data) {
                alert("Gadbad ProcessMembers");
            }
        });
    };

    this.DisplayMembers = function (members) {
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
    };

    /**
     * Initiates request to fetch member information from server.
     * On success, generates the profile view using DisplayMembers
     * @returns {undefined}
     */
    this.LoadMembers = function () {
        $.ajax({
            method: "get",
            url: g_server_url + '?msg_id=1',
            success: function (data) {
                if (EIS_DEBUG) {
                    console.log(data);
                }
                DisplayMembers(JSON.parse(data));
            },
            error: function (data) {
                alert("Gadbad");
            }
        });
    };

    /**
     * Handles the update request from the client using ID of the member.
     * On success, it fetches the member details and shows in the form
     * 
     * @param {int} elemId - ID of the member
     * 
     * @returns {undefined}
     */
    this.ProcessUpdateRequest = function (elemId) {
        $("#" + elemId).on('click', function () {
            var mem_id = $("#" + elemId).val();
            $.ajax({
                method: "get",
                url: g_server_url + '?msg_id=4&mem_id=' + mem_id,
                success: function (data) {
                    if (EIS_DEBUG) {
                        console.log(data);
                        alert("Member Updated");
                    }
                    
                    location.reload();
                    GetMemberDetails(JSON.parse(data));
                },
                error: function (data) {
                    alert("Gadbad - Updated");
                }
            });
        });
    };

    /**
     * Handles the status update for the member.
     * If the status is enable, then possible action is to disable it and 
     * vice versa.
     * 
     * @param {int} elemId - ID of the member
     * @returns {none}
     */
    this.AddStatusHandler = function (elemId) {
        $("#" + elemId).on('click', function () {
            var mem_id = $("#" + elemId).val();
            var label = $("#" + elemId).val();
            var status = 0;

            if (label === "Enable") {
                status = 1;
            }
            $.ajax({
                method: "get",
                url: g_server_url + '?msg_id=7&mem_id=' + mem_id + "&status=" + status,
                success: function (data) {
//            alert("Ureka!!!");
                    console.log(data);
                    alert("Status Updated");
                    location.reload();
//                DisplayMemberList(JSON.parse(data));
                },
                error: function (data) {
                    alert("Gadbad - delete");
                }
            });
        });
    };




    this.ShowAdminPage = function () {
        $("#content").load('partials/list-members-view.php');
    }

}

$(document).ready(function () {
    var objUI = new EisUIClass();
    $("#idListMembers").on('click', function (e) {
        e.preventDefault();
        $("#content").load('partials/list-members-view.php');

    });

    $("#idAddMember").on('click', function (e) {
        e.preventDefault();
        $("#content").load('partials/create-member-view.php');
    });

    $("#idUpdateMember").on('click', function (e) {
        e.preventDefault();
        $("#content").load('partials/list-members-view.php');
    });

    $("#idDelMember").on('click', function (e) {
        e.preventDefault();
        $("#content").load('partials/list-members-view.php');
    });

});