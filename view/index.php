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
    
    <link rel="stylesheet" type="text/css" href="../css/jquery.fancybox-thumbs.css?v=1.0.7" />
    <link rel="stylesheet" type="text/css" href="../css/jquery.fancybox-buttons.css?v=1.0.5" />
    <link rel="stylesheet" type="text/css" href="../css/jquery.fancybox.css?v=2.1.5" media="screen" />
    
    <style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}

		body {
			max-width: 700px;
			margin: 0 auto;
		}
	</style>

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

<!-- Add jQuery library -->
	<script type="text/javascript" src="../js_scripts/jquery-1.10.1.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="../js_scripts/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="../js_scripts/jquery.fancybox.js?v=2.1.5"></script>


	<!-- Add Button helper (this is optional) -->

	<script type="text/javascript" src="../js_scripts/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->

	<script type="text/javascript" src="../js_scripts/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="../js_scripts/jquery.fancybox-media.js?v=1.0.6"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>


</body>

</html>

