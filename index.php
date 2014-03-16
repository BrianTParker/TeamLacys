<?php
include "header.php";
?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
	  
	  
        <div class="item active">
          
          <div class="container">
		  <div class="row">

			<div class="col-sm-8 col-sm-offset-2">
          <img src="img/img1.jpg" alt="First slide">
            <div class="carousel-caption">
              
            </div>
			</div>
			</div>
          </div>
        </div>
        <div class="item">
          
          <div class="container">
		  <div class="row">

			<div class="col-sm-8 col-sm-offset-2">
            <img src="img/img2.jpg" alt="First slide">
          </div>
		  </div>
			</div>
        </div>
        <div class="item">
          
          <div class="container">
		  <div class="row">

			<div class="col-sm-8 col-sm-offset-2">
            <img src="img/img3.jpg" alt="First slide">
          </div>
		  </div>
		  </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
</div>



<?php
include "footer.php";
?>