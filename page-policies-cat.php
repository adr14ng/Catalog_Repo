<?php 

/* Template Name: Policies Page Category*/ 

get_header(); 

?>


<div class="title_bar"><h1>Policies</h1></div>

<div class="col_b">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>  

<h2>Policies: Categorical</h2>

<?php $terms = get_terms('policy_type');
		foreach($terms as $term) {
			echo '<h2> ' . $term->name .'</h2>';
			$query_policies = new WP_Query(array('post_type' => dp_policy, 'orderby' => 'title', 'order' => 'DESC',  'policy_type' => $term->slug));
			if($query_policies->have_posts()) : while($query_policies->have_posts()) : $query_policies->the_post(); ?>
			<h3><a href="<?php the_permalink();?>"/><?php the_title(); ?></a></h3>
		<?php endwhile; endif; 
		}?>

<?php wp_reset_query(); ?> 
<?php endwhile; endif; ?>   

</div>


<?php get_footer(); ?>