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
    <script src="../js_scripts/sendTopic.js" type="text/javascript"></script>    
<!--    <script src="../js_scripts/modalForVotes.js" type="text/javascript"></script>-->

    <title>LiveTag - Send topic</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/3-col-portfolio.css" rel="stylesheet">
    <link href="../css/modal.css" rel="stylesheet">

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
                    <li>
                        <a href="../andjela/profil.php?userID=<?php echo $_SESSION['userID']; ?>"><?php echo $_SESSION['userName']; ?></a>
                    </li>
                    <li>
                        <a href="../genal/logout.php">Logout</a>
                    </li>
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
            <div class="col-lg-12 topicHeader">
                <h1 class="page-header" id="topic" style="margin-top: 20px;">
                	Pošaljite topik
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <form enctype="multipart/form-data" method="POST" id="sendTopicForm">
        
			Unesite topik:
			<input type="text" name="inputTopic" id="inputTopic" size="100">
            
			<br/>            
       		<br/>   
                     
            <input hidden="true" type="text" name="userID" id="userID" value="<?php echo $_SESSION['userID']?>" />
            
			<input type="submit" value="Postavi baner" id="btn">
		</form>
       

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

</body>

</html>

