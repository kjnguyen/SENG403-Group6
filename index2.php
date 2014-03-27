<?php
    //Start session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="template/css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="template/css/grid.css" type="text/css" media="all">
	<link rel="stylesheet" href="template/css/style.css" type="text/css" media="all">
	<script type="text/javascript" src="template/js/jquery-1.4.2.min.js" ></script>
	<script type="text/javascript" src="template/js/cufon-yui.js"></script>
	<script type="text/javascript" src="template/js/Myriad_Pro_italic_400-Myriad_Pro_italic_600.font.js"></script>
	<script type="text/javascript" src="template/js/cufon-replace.js"></script>	
	<script type="text/javascript" src="template/js/jquery.faded.js"></script>
	<script type="text/javascript" src="template/js/script.js"></script>
	<!--[if lt IE 7]>
		<link rel="stylesheet" href="template/css/ie/ie6.css" type="text/css" media="screen">
		<script type="text/javascript" src="template/js/ie_png.js"></script>
		<script type="text/javascript">
				ie_png.fix('.png, .logo, .extra-banner');
		</script>
	<![endif]-->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="template/js/html5.js"></script>
	<![endif]-->
</head>

<body>
	<!-- header -->
        <header style="height: 140px;">
		<div class="container_16">
			<div class="logo">
				<h1><a href="./"><strong>4J</strong> Estates</a></h1>
			</div>
			<nav>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="admin" >Login</a></li>
				</ul>
			</nav>
                    	
            
            <!-- From Jack: You will have change the listing here...-->
			<!-- faded slider begin -->
			
		</div>
	</header>
        <section id="content" style="height: 510px;">
		<div class="container_16">
			<div class="clearfix">
				<section id="mainContent" class="grid_10">
					<article>
						<h2>Welcome to 4J Estates Online!</h2>
						<p>For realtors, as well as prospective buyers and renters who
						 are looking for a convenient marketplace; 4J Estates is a website
						  that is fast, effective, and simple to use where realtors can
						   advertise properties and where buyers can easily find their 
						   dream estate. Unlike other real estate markets, our product
						    is easily accessible, user friendly, and ad-free!</p>
					</article>
				</section>
			</div>
                    <div id="faded">
				<div class="rap">
					<a href="#"><img src="images/big-img1.jpg" alt="" width="571" height="398"></a>
					<a href="#"><img src="images/big-img2.jpg" alt="" width="571" height="398"></a>
					<a href="#"><img src="images/big-img3.jpg" alt="" width="571" height="398"></a>
				</div>
				<ul class="pagination" style="right: auto; left: 600px;">
                                    <?php
                                    define("search.php", True);
                                    include_once 'search.php';
                                    ?>
				</ul>
				<img src="images/extra-banner.png" alt="" class="extra-banner">
			</div>
		</div>
            
	</section>


	<!-- content -->


<?php
    include_once "footer.php";
?>
