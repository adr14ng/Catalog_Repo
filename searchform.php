<?php 

/**
 * Template Name: Advanced Search Form Template
 */ 

$post_types = get_post_types(array('publicly_queryable' => true), 'objects');
$exclude = array('post', 'attachment');

$department_shortname = get_terms('department_shortname');
$departments = array();
$departments_plus = array();
$colleges = array();
$college_slugs = array('amc', 'cecs', 'coh', 'csbs', 'csm', 'cobae', 'educ', 'hhd');
foreach($department_shortname as $term)
{
	if($term->parent != 0)
	{
		$courses = new WP_Query( array('post_type' => 'courses', 'department_shortname' => $term->slug) );
		if($courses->have_posts())
		{
			$departments_plus[] = $term;
		}
		if($term->parent != 511)
		{
			$departments[] = $term;
		}
	}
	elseif(in_array($term->slug, $college_slugs))
	{
		$colleges[] = $term;
	}
}
$departments = sort_terms_by_description($departments);
$colleges = sort_terms_by_description($colleges);

$degree_level = get_terms('degree_level');
$aca_year = get_terms('aca_year');
$general_education = get_terms('general_education');
 
get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<span class="dept-title-small">Search</span>
					<h1 class="prog-title">Advanced Search</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="section-content">
				<div class="col-xs-12 col-md-9 clearfix">
					<form id="advanced-search" role="search" method="get" action="<?php echo home_url( '/?s='); ?>">
						<input type="hidden" name="s" value="" />
						<fieldset id="search-terms">
							<legend>Search Terms</legend>
							<ul class="checkbox-list">
								<li>
									<label for="and">All these words: </label>
									<input type="text" name="and-words" id="and" />
								</li>
								<li>
									<label for="or">Any of these words: </label>
									<input type="text" name="or-words" id="or" />
								</li>
								<li>
									<label for="not">None of these words: </label>
									<input type="text" name="not-words" id="not" />
								</li>
								<li>
									<label for="exact">This exact word or phrase: </label>
									<input type="text" name="exact-words" id="exact" />
								</li>
							</ul>
						</fieldset>
						<fieldset>
							<legend>Then Filter by: </legend>
							<div id="post_type_container" class="field">
								<label for="post_type"> Content Type: </label>
								<select name="post_type" id="post_type">
									<option selected value='any'></option>
								<?php foreach($post_types as $post_type) : if(!in_array($post_type->name, $exclude)) : ?>
									<option value="<?php echo $post_type->name; ?>"><?php echo $post_type->label; ?></option>
								<?php endif; endforeach; ?>
								</select>
							</div>
							
							<div id="college_container" class="optional field programs staract plans faculty courses departments">
								<label for="college"> College: </label>
								<select name="college" id="college">
									<option selected value=''></option>
								<?php foreach($colleges as $college) : ?>
									<option value="<?php echo $college->slug; ?>"><?php echo $college->description; ?></option>
								<?php endforeach; ?>
								</select>
							</div>
							
							<div id="department_container" class="optional field programs staract plans faculty">
								<label for="department"> Department/Program: </label>
								<select name="department" id="department">
									<option selected value=''></option>
								<?php foreach($departments as $deparment) : ?>
									<option value="<?php echo $deparment->slug; ?>"><?php echo $deparment->description; ?></option>
								<?php endforeach; ?>
								</select>
							</div>
							
							<div id="department_code_container" class="optional field courses">
								<label for="department_code"> Department/Program: </label>
								<select name="department_code" id="department_code">
									<option selected value=''></option>
								<?php foreach($departments_plus as $deparment) : ?>
									<option value="<?php echo $deparment->slug; ?>"><?php echo $deparment->name; ?> - <?php echo $deparment->description; ?></option>
								<?php endforeach; ?>
								</select>
							</div>
							
							<div id="degree_level_container" class="optional field programs">
								<label for="degree_level"> Program Type: </label>
								<select name="degree_level" id="degree_level">
									<option selected value=''></option>
								<?php foreach($degree_level as $type) : ?>
									<option value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
								<?php endforeach; ?>
								</select>
							</div>
							
							<div id="fund_source_container" class="optional field programs">
								<label> Funding Source: </label>
								<input type="radio" name="fund_source" id="fund_source_both" value="">
								<label for="fund_source_both" class="little-label"> Any </label>
								<input type="radio" name="fund_source" id="fund_source_state" value="state,both">
								<label for="fund_source_state" class="little-label"> State Support </label>
								<input type="radio" name="fund_source" id="fund_source_self" value="self,both">
								<label for="fund_source_self" class="little-label"> Self Support </label>
							</div>
							
							<div id="aca_year_container" class="optional field staract plans">
								<label for="aca_year"> Catalog Year: </label>
								<select name="aca_year" id="aca_year">
									<option selected value=''></option>
								<?php foreach($aca_year as $year) : ?>
									<option value="<?php echo $year->slug; ?>"><?php echo $year->name; ?></option>
								<?php endforeach; ?>
								</select>
							</div>
							
							<div id="hire_year_container" class="optional field faculty">
								<label for="hire_year"> Year Hired: </label>
								<input type="checkbox" name="hire_year" id="hire_year" value="true">
								<input type="number" min="1940" max="2039" step="1" value=1940 name="hire_year_start" id="hire_year">
								To
								<input type="number" min="1940" max="2039" step="1" value=2015 name="hire_year_end" id="hire_year">
							</div>
							
							<div id="current_container" class="optional field faculty">
								<label for="current"> Only Current Faculty: </label>
								<input type="checkbox" name="current" id="current" value="true">
							</div>
							
							<div id="administrator_container" class="optional field faculty">
								<label for="administrator"> Only Administrators: </label>
								<input type="checkbox" name="administrator" id="administrator" value="true">
							</div>
							
							<div id="emeritus_container" class="optional field faculty">
								<label for="emeritus"> Only Emeritus Faculty: </label>
								<input type="checkbox" name="emeritus" id="emeritus" value="true">
							</div>
							
							<div id="general_education_department_container" class="optional field courses">
								<label for="general_education_department"> Only General Education Courses: </label>
								<input type="checkbox" name="general_education_department" id="general_education_department" value="true">
							</div>
							
							<div id="general_education_container" class="optional field ge-courses">
								<label for="general_education"> General Education Section: </label>
								<select name="general_education" id="general_education">
									<option selected value=''></option>
								<?php foreach($general_education as $cats) : ?>
									<option value="<?php echo $cats->slug; ?>"><?php echo $cats->description; ?></option>
								<?php endforeach; ?>
								</select>
							</div>
							
						</fieldset>
						<input type="hidden" name="advanced_search" value="true">
						<input class="btn btn-primary pull-right" type="submit" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>