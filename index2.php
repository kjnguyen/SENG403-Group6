<?php
    include_once "header.php";
?>
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
