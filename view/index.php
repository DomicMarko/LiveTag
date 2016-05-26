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

    <title>LiveTag - Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/3-col-portfolio.css" rel="stylesheet">
    <link href="../css/modal.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


	<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">LiveTag</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
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
        </div><!--/.nav-collapse -->
      </div>
    </div>

	
    

    <!-- Page Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12 topicHeader">
                <h1 class="page-header" id="topic" style="margin-top: 20px;">
                </h1>
            </div>
        </div>
        <!-- /.row -->

		<!-- Upload image -->
        <div class="row">
            <div class="col-lg-12" id="uploadLink">
				
            </div>
        </div>
        <!-- /.row -->     
        
        
        <!-- Place where images will be loaded -->        
        <div id="addRowsPoint"></div>           

        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

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

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
      <h2>Korisnici koji su glasali:</h2>
    </div>
    <div id="modal-body" class="modal-body">
		
    </div>
  </div>

</div>


<div hidden="true" id="hiddenInfoUserID" data-value="<?php echo $_SESSION['userID']?>"></div>
<div hidden="true" id="hiddenInfoUserType" data-value="<?php echo $_SESSION['userType']?>"></div>

<script src="../js_scripts/jquery.js"></script>
<script src="../js_scripts/bootstrap.min.js"></script>
<script src="../js_scripts/loadImages.js" type="text/javascript"></script>
<script src="../js/modernizr.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../js_scripts/retina-1.1.0.js"></script>
<!--<script src="../js_scripts/jquery.hoverdir.js"></script>-->
<!--<script src="../js_scripts/jquery.hoverex.min.js"></script>-->
<!--<script src="../js_scripts/jquery.prettyPhoto.js"></script>-->
<!--<script src="../js_scripts/jquery.isotope.min.js"></script>-->

</body>

</html>

