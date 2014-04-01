<?php 
/**
 * Template Name: General Education Courses Template
 */ 



get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php bloginfo( 'url' ); ?>/general-education/">General Education</a>
					<h1 class="prog-title">Courses</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row small-marg-top small-marg-bottom">
			<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 left-sidebar ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 side-nav-col clearfix noborder">
					<ul class="side-nav">
						<li><a href="<?php bloginfo( 'url' ); ?>/general-education/">GE Overview</a></li>
						<li><a href="<?php bloginfo( 'url' ); ?>/general-education/rules/">Rules</a></li>
						<li><a href="<?php bloginfo( 'url' ); ?>/general-education/pattern-modifications/">Pattern Modifications</a></li>
						<li><a href="<?php bloginfo( 'url' ); ?>/general-education/information-competence/">Information Competence (IC)</a></li>
						<li class="side-nav-active"><a href="<?php bloginfo( 'url' ); ?>/general-education/courses/">Courses</a></li>
					</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
				<div class="panel-group" id="accordion">
				<?php 
				$terms = get_terms('general_education');
				$num = 0;
				foreach($terms as $term) :
					$num++;

					if($term->slug !== 'ic'): ?>
						<div class="panel panel-default">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $num;?>" class="collapsed">
								<div class="panel-heading">
									<h4 class="panel-title">
										<?php echo $term->description; ?>
										<span class="glyphicon pull-right glyphicon-plus-sign"></span>
										<span class="glyphicon pull-right glyphicon-minus-sign"></span>
									</h4>
								</div>
							</a>
							<div id="collapse<?php echo $num;?>" class="panel-collapse collapse">
								<div class="panel-body">

								<?php
								
								$query_policies = new WP_Query(array('post_type' => 'courses', 'orderby' => 'title', 'order' => 'ASC',  'general_education' => $term->slug));

								if($query_policies->have_posts()) : while($query_policies->have_posts()) : $query_policies->the_post(); ?>
								
									<p><a href="<?php the_permalink();?>"/><?php the_title(); ?></a></p>

								<?php endwhile; endif; ?>
								</div>
							</div>
						</div>
				<?php endif; endforeach;?>
				<?php wp_reset_query(); ?>
				</div>
			</div>
		</div>
	</div>
</div>



<?php get_footer(); ?>