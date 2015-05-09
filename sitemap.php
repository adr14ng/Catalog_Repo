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
		'post_type' => array('departments', 'page', 'groups'),
		'exclude' => array(168, 32859, 28938),		//exclude the json and a-z page
	)
);

//policy categories
$pol_cats = get_terms('policy_categories');

$links = array(
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
		'name' => 'Policies and Procedures',
		'link' => site_url('/policies/'),
		)
	);
	
foreach($posts as $post)
{
	$title = sanitize_title($post->post_title);
	$offset = strpos($title, 'college-of'); 
	if($offset)	//0 or false we don't need to do anything
	{
		$title = substr($title, $offset);
	}
	if(strpos($title, 'the') === 0)	//if the is the first word
	{
		$title = substr($title, 4);
	}
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

end($links);
$last_letter = strtoupper(substr(key($links),0,1));

get_header(); ?>

<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="section-content">
				<div id="abc_nav" data-spy="affix" data-offset-top="325" class = "hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php foreach (range('A', $last_letter) as $char) : ?>
						<a href="#<?php echo 'index-'.$char; ?>">
							<span class="btn btn-primary btn-sm"><?php echo $char; ?></span>
						</a>
					<?php endforeach; ?>
				</div>
				<div class = "col-sm-3 col-md-3 col-lg-3"></div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 a-z-container">
				<?php foreach($links as $k=>$entry) : ?>
					<?php 
						$this_letter = strtoupper(substr($k,0,1));
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