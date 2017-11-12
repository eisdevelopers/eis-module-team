<?php
  /*
   * Project    : EIS Subscription Module
   * EAO IT Services Pvt. Ltd. | www.eaoservices.com
   * Copyright reserved @2017

   * File Description :

   * Created on : 25 Oct, 2017 | 5:30:57 PM
   * Author     : Bilal Wani
   * Email      : bilal.wani@eaoservices

   */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <meta name="description" content="EIS Admin Panel">
        <meta name="author" content="EIS Developers - EAO IT SERVICES PVT LTD">
        <link rel="icon" href="../../favicon.ico">

        <title>EIS Admin Panel</title>

        <link href="deps/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!--<link href="deps/bootstrap4.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="deps/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <link href="css/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="css/main-style.css" rel="stylesheet" type="text/css"/>
        <link href="css/eis-ui.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <!--
            Include Scripts
        -->


        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">EIS Panel</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Search...">
                    </form>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <div class="top-bar-sm" align="center">
                        <ul >
                            <li><span class="fa fa-2x fa-group"></span></li>
                            <li><span class="fa fa-2x  fa-plus"></span></li>
                            <li><span class="fa fa-2x  fa-pencil"></span></li>
                            <li><span class="fa fa-2x  fa-times-rectangle"></span></li>

                        </ul>
                    </div>

                    <ul class="nav nav-sidebar">
                        <li class="nav-item">
                            <div class="eis-menu-item" id="eis-top-menuitem"> 
                                <div class="eis-menu-icon">
                                    <span class="fa fa-group"></span>
                                </div>
                                <div class="eis-menu-label">
                                    <a id="idListMembers" class="nav-link" href="#">&nbsp;  List Members</a>
                                    <p><small> Shows all Members</small></p>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="eis-menu-item"> 
                                <div class="eis-menu-icon">
                                    <span class="fa fa-plus"></span>
                                </div>
                                <div class="eis-menu-label">
                                    <a id="idAddMember" class="nav-link" href="#">&nbsp;  Add Members</a>
                                    <p><small>Add New Members</small></p>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="eis-menu-item"> 
                                <div class="eis-menu-icon">
                                    <span class="fa fa-pencil"></span>
                                </div>
                                <div class="eis-menu-label">
                                    <a id="idUpdateMember" class="nav-link" href="#">&nbsp; Update Members</a>
                                    <p><small> Update Existing Members </small></p>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="eis-menu-item"> 
                                <div class="eis-menu-icon">
                                    <span class="fa fa-times-rectangle"></span>
                                </div>
                                <div class="eis-menu-label">
                                    <a  id="idDelMember" class="nav-link" href="#">&nbsp;  Delete Members</a>
                                    <p><small> Delete Existing Members </small></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Dashboard</h1>

                    <div id="update-content"></div>
                    <div id="output"> </div>
                    <div id="content" class="content">
                        <!--This section is dynamically update-->
                    </div>


                </div>
            </div>

        </div>
        <script src="deps/jquery/jquery-3.1.1.js" type="text/javascript"></script>
        <script src="deps/bootstrap-3.3.7-dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <script src="js/admin-js.js" type="text/javascript"></script>
    </body>
</html>





