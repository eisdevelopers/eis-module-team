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
        <!-- Bootstrap core CSS -->
        <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->


        <!-- Custom styles for this template -->
        <!--<link href="dashboard.css" rel="stylesheet">-->
        <link href="css/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="css/main-style.css" rel="stylesheet" type="text/css"/>
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
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                                  <input type="text" value="1" name="ViewID" hidden="">
                                <button type="submit" class="btn btn-primary btn-listmembers">
                                   List Members
                                </button>
                                 <input type="text" value="2" name="ViewID" hidden="">
                                <button type="submit" class="btn btn-primary btn-addmembers">
                                    Add Members
                                </button>
                                  <input type="text" value="3" name="ViewID" hidden="">
                                   <button type="submit" class="btn btn-primary btn-upmembers">
                                    Update Members
                                </button>
                                   <input type="text" value="4" name="ViewID" hidden="">
                                   <button type="submit" class="btn btn-primary btn-delmembers">
                                    Delete Members
                                </button>
                            </form>
                          <!--<a  id="List_Members" class="nav-link active" href="#">List Members<span class="sr-only">(current)</span></a>-->
                        </li>
                        <!--<li class="nav-item">-->
                            <!--<a id="Add_Member" class="nav-link" href="#">Add Members</a>-->
                        <!--</li>-->
                        <!--<li class="nav-item">-->
                           <!--<a class="nav-link" href="#">Update Members</a>-->
                        <!--</li>-->
                        <!--<li class="nav-item">-->
                            <!--<a class="nav-link" href="#">Delete Members</a>-->
                        <!--</li>-->
                    </ul>
                </nav>

                <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
                    <h1>Dashboard</h1>

                    <section class="row text-center placeholders">
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

                    <div class="content">
                        
                        <?php
                        switch ($g_view_id) {
                            case 1:
                                require_once './partials/admin-view.php';
                                break;
                            case 2:
                                require_once './partials/create-member-view.php';
                                break;
                            case 3:
                                require_once './partials/admin-view.php';
                              break;
                            case 4:
                                require_once './partials/admin-view.php';
                            default :
                        }
                        ?>
                        
                    </div>

                </main>
            </div>
        </div>
       
    </body>

</html>

