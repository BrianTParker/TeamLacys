
  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/plugins.js"></script>
  <script defer src="js/script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mylibs/lacy.lib.js"></script>
  <!-- end scripts-->

	
  <!-- Change UA-XXXXX-X to be your site's ID -->
  <script>
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  </br></br>
  <hr style="border-top: 1px solid #ddd; margin:0">
  
    <div class="container-fluid">
       
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-nav-lacys">
		 <li><a href="contact.php">Contact Us</a></li>
			  <li><a href="privacy.php">Privacy Policy</a></li>
			  <li><a href="about.php">About Us</a></li>
		 
		</ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->

	<!--		
	 		<ul class="nav navbar-nav navbar-footer">
			  <!--<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>-->
			 <!-- <li><a href="contact.php">Contact Us</a></li>
			  <li><a href="privacy.php">Privacy Policy</a></li>
			  <li><a href="about.php">About Us</a></li>
			</ul>

	</br></br></br>-->
    <div>
	 <p align="center" style="border-top: 1px solid #ddd; font-size: 11px;">© Contigo Solutions Inc, 5150 Sugarloaf Pkwy, 
	     Lawrenceville, GA 30043<br> All rights reserved</p>
		 </div>
  </body>
</html>
<?php ob_flush(); ?>