<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package artify
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<video-header >
				<div class="overlay"></div>
				<video autoplay loop class="embed-responsive-item">
						<source src="<?php echo get_template_directory_uri() . '/inc/video/albert-video.mp4'; ?>" type="video/mp4">
				</video>
				<div class="container h-100">
					<div class="d-flex text-center h-100">
						<div class="my-auto w-100 text-white">
							<h1 style="font-family: 'Molle', cursive;"  class="display-3">Make Art </br>not ads</h1>
						</div>
					</div>
				</div>
			</video-header>
			<section style="background-color: #060b1f" >
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<h1 style="color: white;"  class="section-heading text-uppercase">Meet Albert, the robot muralist.</h1>
							<h3 class="section-subheading text-muted"></h3>
							<h2 class="section-subheading text-muted">Albert is one-of-a-kind robot climbing walls and printing art. Albert thinks that there’s too many ads and not enough art in public space</h2>
							<h3 class="section-subheading text-muted"></h3>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">

						</div>
					</div>
				</div>
			</section>
		 <section style="margin-bottom: -8px; padding: 0px !important;"  >
			 <img class="header-img"  src="<?php echo get_template_directory_uri() . '/inc/img/albert.jpg'; ?>"  >
				<header class="masthead">
					<div class="container">
						<div class="intro-text">
						 <h1 class="text-uppercase"></h1>
						 <div class="intro-lead-in"></div>
						 <div class="intro-lead-in"></div>
						</div>
					</div>

				</header>
				<h1 class="text-uppercase text-center"></h1>
			</section>
			<section style="background-color: #060b1f" >
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<h1 style="color: white;"  class="section-heading text-uppercase">Let’s help Albert to cover all the boring blank walls with art</h1>
							<h3 class="section-subheading text-muted"></h3>
							<h2 class="section-subheading text-muted">Let’s bring beauty and meaning to everyday lives instead </br> of manipulating people to consume more than they need.</h2>
							<h3 class="section-subheading text-muted"></h3>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">

						</div>
					</div>
				</div>
			</section>
			<h1 style="color: white; background-color: #060b1f; margin-bottom: 0px;"  class="text-uppercase text-center">Do You know a blank wall that HOPELESSLY needs art on it</h1>
			<section style="padding: 0px !important;"  >
				<style>
			       /* Always set the map height explicitly to define the size of the div
			        * element that contains the map. */
			       #map {
			         height: 100%;
			       }
			       /* Optional: Makes the sample page fill the window. */
			       html, body {
			         height: 100%;
			         margin: 0;
			         padding: 0;
			       }
			     </style>


			<div id="map"></div>
			<?php
				$marker_coordinates = return_cordinates();
				$marker_fields = return_marker_arrays();

				foreach ( $marker_fields as  $value ) {
					 $url_array[] =  $value['url'];
				}
			 ?>
	    <script>

						var points = [
								['name1', 59.9362384705039, 30.19232525792222, 12, 'www.google.com'],
								//['name2', 59.941412822085645, 30.263564729357767, 11, 'www.amazon.com'],
								//['name3', 59.939177197629455, 30.273554411974955, 10, 'www.stackoverflow.com']
						];

						var title = [<?php foreach ( $marker_fields as  $value ) {
							 print "'" . $value['title']  . "',";
						}  ?>];

						var urls = [<?php foreach ( $marker_fields as  $value ) {
							 print "'" . get_post_permalink( $value['id'] ) . "',";
						}  ?>];

						function setMarkers(map, locations) {
								var shape = {
										coord: [1, 1, 1, 20, 18, 20, 18 , 1],
										type: 'poly'
								};


								for (var i = 0; i < locations.length; i++) {
										var flag = new google.maps.MarkerImage('markers/' + (i + 1) + '.png',

										new google.maps.Size(17, 19),
										new google.maps.Point(0,0),
										new google.maps.Point(0, 19));
										var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';






										var markers = locations.map(function( location, i) {
										var marker =  new google.maps.Marker({
												 position: location,
												 url: urls[i],
												 title: title[i]

												 });
												 google.maps.event.addListener(marker, 'click', function(){
												 window.location.href = this.url;

												});
										return marker;
										});



									var locations = <?php echo str_replace( '"', ' ', $marker_coordinates ); ?>;


								}

								new MarkerClusterer( map, markers,
									 {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m' });





				}


	      function initMap() {

					var myOptions = {
						 center: {lat: 30.0, lng: 0.0},
						 zoom: 3,
						 mapTypeId: google.maps.MapTypeId.ROADMAP
				 };
				 var map = new google.maps.Map(document.getElementById("map"),myOptions);
				 setMarkers(map, points);



			}
	    </script>
	    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
	    </script>
	    <script async defer
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoJXJ2Xkt_HwRNeRjEtAbwKVpjlXoQg1I&callback=initMap">
	    </script>
			</section>
			<h1 style="color: white; background-color: #060b1f; text-align: center; margin-bottom: 0px;" class="text-uppercase">Insert it on our map and Albert will come to the rescue</h1>



			<section style="padding: 0px !important;"  >
				<img class="header-img"  src="<?php echo get_template_directory_uri() . '/inc/img/wall.jpg'; ?>"  >
				 <header class="masthead">
					 <div class="container">
						 <div class="intro-text">
<!--
							 <a style="background-color: #071927;"  class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="https://www.gps-coordinates.net/">GET COORDINATES</a>
-->
							 <a style="background-color: #071927;"  class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="<?php echo get_site_url(  ) . '/upload'; ?>">ADD A WALL</a>
						 </div>
					 </div>
				 </header>
			 </section>
			 <section style="background-color: #060b1f" >
				 <div  class="container">
					 <div class="row">
						 <div class="col-lg-12 text-center">
							 <h1 style="color: white;"  class="section-heading text-uppercase">How we roll</h1>
							 <h3 class="section-subheading text-left text-muted"></h3>
							 <h2 style="padding: 25px; background-color: #212529; background-image: url('<?php echo get_template_directory_uri() . '/inc/img/contact-background.jpg'; ?>'); background-repeat: no-repeat; background-position: center;"
							  class="section-subheading text-left text-left text-muted">1. We collect blank walls all around the world</h2>
							 <h2 style="padding: 25px;" class="section-subheading text-left text-muted">2. We connect artists and funding possibilties to create murals on the walls</h2>
							 <h2 style="padding: 25px; background-color: #212529; background-image: url('<?php echo get_template_directory_uri() . '/inc/img/contact-background.jpg'; ?>'); background-repeat: no-repeat; background-position: center; }"
								 class="section-subheading text-left text-muted">3. It will be complimentary for the property owner who is willint to donate it's wall as a canvas or and art project</h2>
							 <h3 class="section-subheading text-muted"></h3>
						 </div>
					 </div>
					 <div class="row">
						 <div class="col-lg-12">

						 </div>
					 </div>
				 </div>
			 </section>
			 <section style="background-color: #060b1f" id="contact">
				 <div class="container">
					 <div class="row">
						 <div class="col-lg-12 text-center">
							 <h2 class="section-heading text-uppercase">Wanna make art</h2>
							 <h3 class="section-subheading text-muted">Do you need a wall an project ? Are you an artist ? An organiser ? </h3>
							 <h3 class="section-subheading text-muted">Someone who share funding possibilties ? </h3>
							 <h3 class="section-subheading text-muted">Whatever it os, you can</h3>
						 </div>
					 </div>
					 <div class="row">
						 <div class="col-lg-12">
							 <?php echo do_shortcode( '[ninja_form id=1]' );  ?>
						 </div>
					 </div>
				 </div>
			 </section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
