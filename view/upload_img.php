<?php

    require_once('../genal/checklogin.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <script src="../js_scripts/jquery.js"></script>    
    <script src="../js_scripts/bootstrap.min.js"></script>
    <script src="../js_scripts/uploadImage.js" type="text/javascript"></script>

    <title>LiveTag - Upload Image</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/3-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">LiveTag</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        if(($_SESSION['userType'] != 'guest') && ($_SESSION['userType'] != 'admin')) {
                            echo "<li><a href=\"../andjela/profil.php?userID=" . $_SESSION['userID'] . "\">" . $_SESSION['userName'] . "</a></li>"
                                . "<li><a href=\"../genal/logout.php\">Logout</a></li>";
                        } 
                        if($_SESSION['userType'] == 'guest') {
                            echo "<li><a href=\"../genal/logout.php\">Ulogujte se</a></li>";
                        }
                        if($_SESSION['userType'] == 'admin') {
                            echo "<li><a href=\"../gazda/adminpanel.php\">Admin panel</a></li>" . 
                                "<li><a href=\"../gazda/moderator.php\">Moderator panel</a></li>" . 
                                "<li><a href=\"../genal/logout.php\">Logout</a></li>";
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                	Upload Image
                </h1>
            </div>
        </div>      
        <!-- /.row -->              

		<form enctype="multipart/form-data" method="POST" id="imageUploadForm">
        
			Izaberite fajl:
			<input type="file" name="fileToUpload" id="fileToUpload">
            
			<br/>            
       		<br/>   
                     
            <input hidden="true" type="text" name="userID" id="userID" value="<?php echo $_SESSION['userID']?>" />
            
			<input type="submit" value="Postavi baner" id="btn">
		</form>

		<div id="response"></div>
        
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->    

</body>

</html>
