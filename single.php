<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package artify
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();  ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


				<div style="color: white; background-color: #060b1f;" class="col-xs-6 col-sm-8 col-lg-12" >
					<div class="container" >
						<div class="row" >


							<?php

							$submitted_address = get_post_meta ( $post->ID, 'submitted_address', true );
							?>
							<div class="col-xs-6 col-sm-8 col-lg-12" >
								<?php artify_post_thumbnail(); ?>

							</div>
							<header style="padding: 1%; color: white; padding-left: 40%;" class="entry-header text-center">

								<?php //the_title( '<h2 class="entry-title text-center"><a class="text-center" style="color:white;" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );  ?>

							</header><!-- .entry-header -->


							<div style="background: #495a4d; padding: 5%;"  class="col-xs-6 col-sm-8 col-lg-12 text-center">
								<?php
/*
								the_content( sprintf(
									wp_kses(

										__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'artify' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									get_the_title()
								) );
*/

								?>
							<p>Aadress: <?php print $submitted_address ?></p>

							</div><!-- .entry-content -->

							<footer class="entry-footer col-xs-6 col-sm-8 col-lg-12">
								<?php //the_post_navigation(); ?>
								<?php 	// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
/*
									wp_link_pages( array(
										'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'artify' ),
										'after'  => '</div>',
									) );
*/
									?>
								<?php artify_entry_footer(); ?>
							</footer><!-- .entry-footer -->
						</div>
					</div>
				</div>
			</article><!-- #post-<?php the_ID(); ?> -->
<?php
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
