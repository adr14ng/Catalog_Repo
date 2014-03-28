<?php /**
 * Template Name: Graduate Programs Master Template
 */ 
// $dept = get_query_var( 'department_shortname' );

// $deptterm = get_term_by( 'slug', $dept, 'department_shortname' );

// $deptdesc = $deptterm->description;

//Make ascending by title
global $query_string;
query_posts( $query_string . '&orderby=title&order=ASC' );

get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">Master</a>
					<a href="<?php echo the_permalink(); ?>"><h1 class="prog-title">Graduate Programs</h1></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main-section">
	<div class="container" id="wrap">
		<div class="row small-marg-top">
			<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 left-sidebar ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 side-nav-col clearfix noborder">
					<ul class="side-nav">
						<li><a href="<?php bloginfo( 'url' ); ?>/graduate-programs/">Overview</a></li>
						<li><a href="<?php bloginfo( 'url' ); ?>/graduate-programs/credential-office/">Credential Office</a></li>
						<li class="indent"><a href="<?php bloginfo( 'url' ); ?>/graduate-programs/credential-office/credentials/">Credentials</a></li>
						<li><a href="<?php bloginfo( 'url' ); ?>/graduate-programs/certificates/">Post-Baccalaureate University Certificate Programs</a></li>
						<li class="side-nav-active"><a href="<?php bloginfo( 'url' ); ?>/graduate-programs/masters/">Masters</a></li>
						<li><a href="<?php bloginfo( 'url' ); ?>/graduate-programs/doctorates/">Doctorate</a></li>
					</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
				<div class="row">
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<?php $values = get_the_content();
					if ( $values != false ): ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix small-marg-bottom">
						<div class="content">
							<span class="section-title"><span><h2>Masters Program Programs</h2></span></span>
									<p><?php the_content(); ?></p>
						</div>
					</div>
					<?php endif; ?>
				<?php endwhile; endif; ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
						<div class="content">
							<span class="section-title"><span><h2>Masters Program List</h2></span></span>
							<div class="dept-container content">
							<?php 
							$query_prog = new WP_Query(array('post_type' => 'programs', 'orderby' => 'title', 'order' => 'ASC',  'degree_level' => 'master'));
					
							if($query_prog->have_posts()): while ($query_prog->have_posts()) : $query_prog->the_post(); ?>
								<div class="dept-item ">
									<a href="<?php the_permalink(); ?>"><?php the_field('degree_type'); ?>, <?php the_title(); 
								
									$post_option=get_field('option_title');
											
									if(isset($post_option)&&$post_option!=='') {
										echo ': '.$post_option;
									}
									?></a>
								</div>
							<?php endwhile; else: ?>
								<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
							<?php endif; 
							wp_reset_query();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php get_footer(); ?>