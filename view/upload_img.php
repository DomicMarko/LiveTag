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

    <title>LiveTag - Objavite sliku</title>

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
                <h1 class="headerPage" id="topic" style="margin-top: 20px;">Objavite sliku</h1>
            </div>
        </div>
        
        <hr>             

		<form enctype="multipart/form-data" method="POST" id="imageUploadForm">
        
        	<div class="form-group">
    			<label for="inputFile">Učitajte sliku sa vašeg računara (veličina slike do 5MB):</label>
    			<input type="file" name="fileToUpload" id="fileToUpload">
  			</div>
                      
       		<br/>   
                     
            <input hidden="true" type="text" name="userID" id="userID" value="<?php echo $_SESSION['userID']?>" />
            
            <button type="submit" id="btn" class="btn btn-primary">Objavite sliku</button>
		</form>

		<div id="response"></div>
        
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
	    
    <script src="../js_scripts/jquery.js"></script>    
    <script src="../js_scripts/bootstrap.min.js"></script>
    <script src="../js_scripts/uploadImage.js" type="text/javascript"></script>

</body>

</html>
