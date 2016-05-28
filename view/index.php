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
    <link href="../css/modal.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">    

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
          			<li id="newMessage"></li>                              
          			<?php
				   		if(($_SESSION['userType'] != 'guest') && ($_SESSION['userType'] != 'admin')) {
		  					echo "<li><a href=\"../andjela/profil.php?userID=" . $_SESSION['userID'] . "\"><div class=\"avatarWrapper\"><img src=\"../andjela/" . $_SESSION['userAvatar'] . "\"></div> " . $_SESSION['userName'] . "</a></li>"
		  						. "<li><a href=\"../genal/logout.php\">Odjavite se</a></li>";
				  		} 
				  		if($_SESSION['userType'] == 'guest') {
		  					echo "<li><a href=\"../genal/logout.php\">Prijavite se</a></li>";
		  				}
				  		if($_SESSION['userType'] == 'admin') {
				  			echo "<li><a href=\"../gazda/adminpanel.php\">Adminov panel</a></li>" . 
		  						"<li><a href=\"../gazda/moderator.php\">Panel moderatora</a></li>" . 
		  						"<li><a href=\"../genal/logout.php\">Odjavite se</a></li>";
		  				}
				  	?>                    
          		</ul>
        	</div><!--/.nav-collapse -->
      	</div>
    </div>
    

    <!-- Page Content -->
    <div class="container">
    
    	<hr> 
        
    	<!-- Page Header -->
    	<div class="row">
            <div class="col-lg-12 topicHeader">
                <h1 class="headerPage" id="topic" style="margin-top: 20px;"></h1>
            </div>
        </div>
        
        <hr>
        
        <div class="row">
	    	<div class="col-md-12">
                <ul class="list-group" id="uploadLink"></ul>
        	</div>
        </div>
        
        <hr>
        
    	<div class="row">            
            <div class="col-md-12">				                
                <!-- Place where images will be loaded -->        
		        <div id="addRowsPoint"></div>                                                    
            </div>                                                
        </div> 

        <hr>       

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row footerCustom">
                <div class="col-lg-12">
                    <p>Elites &nbsp;&nbsp;| &nbsp;&nbsp;Copyright &copy; 2016 &nbsp;&nbsp;| &nbsp;&nbsp;Sva prava zadržana,  autor projekta tim Elites.</p>
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
            <div id="modal-body" class="modal-body"></div>
        </div>
    </div>

    <!-- The Modal Message-->
    <div id="myModalMessage" class="modalMessage">
        <!-- Modal content -->
        <div class="modal-content-message">
            <div class="modal-header-message">
                <span class="close-message">×</span>
                <h2>Nova poruka</h2>
            </div>
            <div id="modal-body-message" class="modal-body-message"></div>
        </div>
    </div>


    <div hidden="true" id="hiddenInfoUserID" data-value="<?php echo $_SESSION['userID']?>"></div>
    <div hidden="true" id="hiddenInfoUserType" data-value="<?php echo $_SESSION['userType']?>"></div>
    <div hidden="true" id="hiddenNewMessage"></div>

	<script src="../js_scripts/jquery.js"></script>
    <script src="../js_scripts/bootstrap.min.js"></script>
    <script src="../js_scripts/loadImages.js" type="text/javascript"></script>

    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="../js_scripts/jquery.fancybox.js?v=2.1.5"></script>
        
    <script type="text/javascript" src="../js_scripts/lightBoxRest.js"></script>	

</body>

</html>

