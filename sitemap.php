<?php 

/**
 * Template Name: Sitemap Template
 */ 

get_header(); ?>


<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="section-content">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<ul class="side-nav">
						<li><a href="#csun">CSUN</a></li>
						<li><a href="#undergrad">Undergraduate Programs</a></li>
						<li><a href="#student">Student Services</a></li>
						<li><a href="#special">Special Programs</a></li>
						<li><a href="#ge">General Education (GE)</a></li>
						<li><a href="#grs">Graduate Studies (RGS)</a></li>
						<li><a href="#courses">Courses of Study</a></li>
						<li><a href="#policies">Univeristy Policies</a></li>
						<li><a href="#faculty">Faculty</a></li>
						<li><a href="#planning">Planning Guides</a></li>
					</ul>
					<br />
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<?php if(have_posts()): while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>
				
					<span id="ge" class="section-title"><span><h2>General Education</h2></span></span>
					<p>
					<?php		
						$gened = get_page_by_title('General Education');
						?>
						<a href="<?php echo get_permalink($gened->ID);?>"/><?php echo $gened->post_title; ?></a><br />
						<?php
						
						$gened_pages = get_pages(array('child_of' => ($gened->ID)));
						
						foreach($gened_pages as $page): ?>
							<a href="<?php echo get_permalink($page->ID);?>"/><?php echo $page->post_title; ?></a><br />
						<?php endforeach;?>  
						<a href="<?php echo site_url('/general-education/information-competence/');?>"/>Information Competence</a><br />
						<a href="<?php echo site_url('/general-education/upper-division/');?>"/>Upper Division</a><br />
						<a href="<?php echo site_url('/general-education/courses/');?>"/>Courses</a><br />
						</p>
				
					<span id="grs" class="section-title"><span><h2>Graduate Studies</h2></span></span>
					<p>
					<?php		
						$rgs = get_page_by_title('Research and Graduate Studies');
						?>
						<a href="<?php echo get_permalink($rgs->ID);?>"/><?php echo $rgs->post_title; ?></a><br />
						<?php
						
						$rgs_pages = get_pages(array('child_of' => ($rgs->ID)));
						
						foreach($rgs_pages as $page): ?>
							<a href="<?php echo get_permalink($page->ID);?>"/><?php echo $page->post_title; ?></a><br />
						<?php endforeach;?>
						</p>
				
					<span id="courses" class="section-title"><span><h2>Courses of Study</h2></span></span>
					<p>
					<?php				
					$query_departments = new WP_Query(array('post_type' => 'departments', 'orderby' => 'title', 'order' => 'ASC','posts_per_page' => 1000,));
							
					if($query_departments->have_posts()) : while($query_departments->have_posts()) : $query_departments->the_post(); 
					
						$post_id = get_the_ID();
						$terms = wp_get_post_terms( $post_id, 'department_shortname');
						$url = get_csun_archive('departments', $terms[0]->slug);
					?>
						<a href="<?php echo $url;?>"/><?php the_title(); ?></a> <br />
					<?php endwhile; endif; 
						
						wp_reset_query(); ?>
					</p>
				
					<span id="policies" class="section-title"><span><h2>Policies</h2></span></span>
					<p>
					<?php				
					$terms = get_terms('policy_categories');

					foreach($terms as $term) : ?>
						<a href="<?php echo get_term_link($term, 'policy_categories');?>"/><?php echo $term->name; ?></a><br />
					<?php endforeach; ?> 
					</p>
				
					<span id="faculty" class="section-title"><span><h2>Faculty</h2></span></span>
					<p>
					<a href="<?php echo site_url('/faculty/');?>"/>Faculty and Adminstration</a><br />
					<a href="<?php echo site_url('/faculty/emeriti/');?>"/>Emeriti</a><br />
					</p>
				
					<span id="planning" class="section-title"><span><h2>Planning Guides</h2></span></span>
					<p>
					<a href="<?php echo site_url('/plan/');?>"/>Degree Planning Guides</a><br />
					<a href="<?php echo site_url('/plan/star-act/');?>"/>STAR Act</a><br />
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>