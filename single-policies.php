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
					<a href="<?php echo site_url('/policies/alphabetical/'); ?>"><h1 class="prog-title">Policies</h1></a>
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
						<a class="no-line" href="<?php the_permalink(); ?>"><h2 class="inner-title dark"><?php the_title(); ?></h2></a>
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
								
								<div id="policy-tags">
								<?php $terms = get_the_terms( $id, 'policy_categories' ); 
								foreach($terms as $term):?>
									<a href="<?php echo get_term_link( $term ); ?>" title="View all policies filed under <?php echo $term->name; ?>">
										<span class="btn btn-primary btn-xs">
											<?php echo $term->name; ?>
										</span>
									</a>
								<?php endforeach; ?>
								<?php $terms = get_the_terms( $id, 'policy_tags' ); 
								foreach($terms as $term):?>
									<a href="<?php echo get_term_link( $term ); ?>" title="View all policies filed under <?php echo $term->name; ?>">
										<span class="btn btn-success btn-xs">
											<?php echo $term->name; ?>
										</span>
									</a>
								<?php endforeach; ?>
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