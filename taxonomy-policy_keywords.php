<?php

/** Template Name: Policy Keyword View
 * The template to display policy keywords
 */



get_header(); ?>



<section id="primary" class="span8">



	<?php tha_content_before(); ?>

	<div id="content" role="main">

		<?php tha_content_top();

		

		if ( have_posts() ) : 

			while ( have_posts() ) {

				the_post();

				get_template_part( '/partials/content', get_post_format() );

			}

			the_bootstrap_content_nav();

		else :

			get_template_part( '/partials/content', 'not-found' );

		endif;

		

		tha_content_bottom(); ?>

	</div><!-- #content -->

	<?php tha_content_after(); ?>

</section><!-- #primary -->



<?php

get_sidebar();

get_footer();