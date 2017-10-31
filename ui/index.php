<!--
Main File : 
Description :
History:
-->
<!DOCTYPE html>

<html>  
    <head>
        <meta charset="UTF-8">
        <title>Team | EIS </title>
        
        <link href="./deps/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/main-style.css" rel="stylesheet" type="text/css"/>

        <script src="deps/jquery/jquery-3.1.1.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
    </head>
    <body >

        <div id="content" class="content">
            <!--  Dynamic Content update -->
        </div>

<?php
  echo "<BR> SERVER-NAME: " . $_SERVER['SERVER_NAME']  . "<BR>";
  echo "<BR> SERVER-ADDR: " . $_SERVER['SERVER_PROTOCOL']  . "<BR>";
  echo "<BR> SERVER-SELF: " . $_SERVER['PHP_SELF']  . "<BR>";
  ?>
        <script>
//            ProcessTeamProfileView(content);
        </script>

    </body>
</html>
