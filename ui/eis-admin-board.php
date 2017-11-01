<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$g_view_id = 1;
if (isset($_POST["ViewID"])) {
    $g_view_id = $_POST["ViewID"];
}
?>
 <!-- html file-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Dashboard Template for Bootstrap</title>
        <!--<link href="deps/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="deps/bootstrap4.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="deps/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        
        <!-- Bootstrap core CSS -->
        <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->


        <!-- Custom styles for this template -->
        <!--<link href="dashboard.css" rel="stylesheet">-->
        <link href="css/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="css/main-style.css" rel="stylesheet" type="text/css"/>
        <link href="css/eis-ui.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <script src="deps/jquery/jquery-3.1.1.js" type="text/javascript"></script>
        <script src="deps/bootstrap4.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Dashboard</a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Help</a>
                    </li>
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <div class="eis-menu-item" id="eis-top-menuitem"> 
                                <div class="eis-menu-icon">
                                    <span class="fa fa-group"></span>
                                </div>
                                <div class="eis-menu-label">
                                     <a id="idListMembers" class="nav-link" href="#">&nbsp;  List Members</a>
                                     <label> Show all Members</label>
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
                                     <label> Add New Members</label>
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
                                     <label> Update Existing Members</label>
                                </div>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                              <div class="eis-menu-item"> 
                                <div class="eis-menu-icon">
                                    <span class="fa fa-pencil"></span>
                                </div>
                                <div class="eis-menu-label">
                                      <a  id="idDelMember" class="nav-link" href="#">&nbsp;  Delete Members</a>
                                      <label> Delete Existing Members</label>
                                </div>
                            </div>
                        </li>
                    </ul>
                    
                </nav>

                <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
                    <h1>Dashboard</h1>

                    <section class="row text-center placeholders top-section">
                        <div class="col-6 col-sm-3 placeholder">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                            <h4>Label</h4>
                            <div class="text-muted">Something else</div>
                        </div>
                        <div class="col-6 col-sm-3 placeholder">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                            <h4>Label</h4>
                            <span class="text-muted">Something else</span>
                        </div>
                        <div class="col-6 col-sm-3 placeholder">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                            <h4>Label</h4>
                            <span class="text-muted">Something else</span>
                        </div>
                        <div class="col-6 col-sm-3 placeholder">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                            <h4>Label</h4>
                            <span class="text-muted">Something else</span>
                        </div>
                    </section>

                    <div id="content" class="content">

                    </div>

                </main>
            </div>
        </div>

    </body>

</html>

