<?php 

/**
 * Template Name: Sitemap Template
 */ 

get_header(); ?>


<div id="main-section">
	<div class="container" id="wrap">
		<div class="row">
			<div class="section-content">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<span class="section-title"><span><h2>Courses of Study</h2></span></span>
					<?php				
					$query_departments = new WP_Query(array('post_type' => 'departments', 'orderby' => 'title', 'order' => 'ASC'));
							
					if($query_departments->have_posts()) : while($query_departments->have_posts()) : $query_departments->the_post(); 
					
						$post_id = get_the_ID();
						$terms = wp_get_post_terms( $post_id, 'department_shortname');
						$url = get_csun_archive('departments', $terms[0]->slug);
					?>
						<a href="<?php echo $url;?>"/><?php the_title(); ?></a> <br />
					<?php endwhile; endif; 
						
						wp_reset_query(); ?> 
					<br />
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<span class="section-title"><span><h2>Policies</h2></span></span>
					<?php				
					$terms = get_terms('policy_categories');

					foreach($terms as $term) : ?>
						<a href="<?php echo get_term_link($term, 'policy_categories');?>"/><?php echo $term->name; ?></a><br />
					<?php endforeach; ?> 
					<br />
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<span class="section-title"><span><h2>About</h2></span></span>
					<?php		
						$about = get_page_by_title('The California State University');
						?>
						<a href="<?php echo get_permalink($about->ID);?>"/><?php echo $about->post_title; ?></a><br />
						<?php
						
						$about_pages = get_pages(array('child_of' => ($about->ID)));
						
						foreach($about_pages as $page): ?>
							<a href="<?php echo get_permalink($page->ID);?>"/><?php echo $page->post_title; ?></a><br />
						<?php endforeach;?> 
						<br />
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<span class="section-title"><span><h2>Graduate Studies</h2></span></span>
					<?php		
						$rgs = get_page_by_title('Graduate Programs');
						?>
						<a href="<?php echo get_permalink($rgs->ID);?>"/><?php echo $rgs->post_title; ?></a><br />
						<?php
						
						$rgs_pages = get_pages(array('child_of' => ($rgs->ID)));
						
						foreach($rgs_pages as $page): ?>
							<a href="<?php echo get_permalink($page->ID);?>"/><?php echo $page->post_title; ?></a><br />
						<?php endforeach;?> 
						<br />
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<span class="section-title"><span><h2>General Education</h2></span></span>
					<?php		
						$gened = get_page_by_title('General Education');
						?>
						<a href="<?php echo get_permalink($gened->ID);?>"/><?php echo $gened->post_title; ?></a><br />
						<?php
						
						$gened_pages = get_pages(array('child_of' => ($gened->ID)));
						
						foreach($gened_pages as $page): ?>
							<a href="<?php echo get_permalink($page->ID);?>"/><?php echo $page->post_title; ?></a><br />
						<?php endforeach;?>  
						<br />
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>