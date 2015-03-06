<?php 

/**
 * Template Name: Sitemap Template
 * 
 * Faculty/Emeriti links, policy categories, departments, pages (- JSON), majors, minors, groups
 * 
 */ 
 
 //departments, pages, groups
$posts = get_posts( array(
		'posts_per_page' => -1,
		'post_type' => array('departments', 'pages', 'groups'),
		'exclude' => array(32859),								//exclude the json page
	)
);

//policy categories
$pol_cats = get_terms('policy_categories');

$links = array(
	'faculty' => array (
		'name' => 'Faculty and Administration',
		'link' => site_url('/faculty/a'),
		),
	'emeriti' => array (
		'name' => 'Emeriti',
		'link' => site_url('/emeriti/a'),
		),
	'majors' => array (
		'name' => 'Majors',
		'link' => site_url('/programs/major/'),
		),
	'minors' => array (
		'name' => 'Minors',
		'link' => site_url('/programs/minor/'),
		),
	'policies' => array (
		'name' => 'Policies',
		'link' => site_url('/policies/'),
		)
	);
	
foreach($posts as $post)
{
	$title = sanitize_title($post->post_title);
	$links[$title] = array(
		'name' => $post->post_title,
		'link' => get_permalink($post->ID)
	);
}

foreach($pol_cats as $cat)
{
	$links[$cat->slug] = array(
		'name' => $cat->name,
		'link' => get_term_link($cat, 'policy_categories'),
	);
}

ksort($links);
$curr_letter = '';

get_header(); ?>


<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="section-content">
				<!--
				<div id="abc_nav" data-spy="affix" data-offset-top="440" data-offset-bottom="10" class = "hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php foreach (range('A', 'Z') as $char) : ?>
						<a href="#<?php echo 'index-'.$char; ?>">
							<span class="btn btn-primary btn-sm"><?php echo $char; ?></span>
						</a>
					<?php endforeach; ?>
				</div>
				<div class = "col-sm-3 col-md-3 col-lg-3"></div> !-->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 a-z-container">
				
				<?php foreach($links as $entry) : ?>
					<?php 
						$this_letter = strtoupper(substr($entry['name'],0,1));
							
						if($this_letter != $curr_letter) {
							echo '<span class="section-title abc_title"><span><h2 id="index-'.$this_letter.'">'.$this_letter.'</h2></span></span>';
							$curr_letter = $this_letter;
						}
					?>
					<p><a href="<?php echo $entry['link']; ?>"><?php echo $entry['name']; ?></a></p>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>