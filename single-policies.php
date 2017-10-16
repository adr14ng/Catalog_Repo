<?php 

/**
 * Template Name: Policies Single View
 */

$id = get_the_ID();

 
get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="prog-title" href="<?php echo site_url('/policies/alphabetical/'); ?>"><h1 class="prog-title">Policies and Procedures</h1></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">
				<div class="row">
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
						<h2 class="inner-title dark"><?php the_title(); ?></h2>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<?php 
							$subject_line = "CSUN Catalog - ".get_the_title();
							$subject_line = str_replace(' ', '%20', $subject_line);
							$body = 'Permalink : '.get_permalink($id);
							$body = str_replace(' ', '%20', $body);
						?>
						<ul id="share-icons">
							<!-- <li><?php pdf_all_button(); ?></li> -->
							<li>
								<a class="no-line" title="Email this page" 
									href='mailto:?subject=<?php echo $subject_line ?>&amp;body=<?php echo $body; ?>' >
									<span class="stLarge glyphicon glyphicon glyphicon-envelope share-icon"></span>
									<span class="screen-reader-text">email</span>
								</a>
							</li>
							<li><a class="no-line" href="javascript:window.print()" title="Print this page.">
									<span class="glyphicon glyphicon-print share-icon"></span>
									<span class="screen-reader-text">print</span>
							</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="pad-box">
				<div id="inset-content">
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
				
					<div class="row">
						<div class="col-xs-12">
							<div class="section-content">
								<?php the_content(); ?>
								
								<?php $related = get_field('related_topics');
								if($related != false) : ?>
								<div id="related-topics">
									<h3 class="pseudo-h5">Related Topics</h3>
									<?php the_field('related_topics'); ?>
								</div>
								<?php endif; ?>
								
								<?php $related = get_field('related_pols');
								if($related != false) : ?>
								<div id="related-pols">
									<h3 class="pseudo-h5">Related Topics</h3>
									<?php foreach($related as $post) : ?>
										<?php setup_postdata($post); ?>
										<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
									<?php endforeach; ?>
									<?php wp_reset_postdata(); ?>
								</div>
								<?php endif; ?>
								
								<div id="policy-tags">
								<?php $terms = get_the_terms( $id, 'policy_categories' ); 
								$base = site_url('/policies/categories/');
								if($terms) : foreach($terms as $term):?>
									<a href="<?php echo $base.$term->slug; ?>" title="View all policies filed under <?php echo $term->name; ?>">
										<span class="btn btn-primary btn-xs">
											<?php echo $term->name; ?>
										</span>
									</a>
								<?php endforeach; endif; ?>
								<?php $terms = get_the_terms( $id, 'policy_tags' );
								$base = site_url('/policies/keywords/');								
								if($terms) : foreach($terms as $term):?>
									<a href="<?php echo $base.$term->slug; ?>" title="View all policies filed under <?php echo $term->name; ?>">
										<span class="btn btn-success btn-xs">
											<?php echo $term->name; ?>
										</span>
									</a>
								<?php endforeach; endif; ?>
								</div>
							</div>	
						</div>
					</div>
					
				<?php endwhile; else: ?>
				
					<p><?php _e('Sorry, no policies matched your criteria.'); ?></p>
					
				<?php endif; ?>
				</div>
			</div> <!-- end pad-box -->
		</div> <!-- end inset-content -->
	</div>
</div>

<?php get_footer(); ?>