<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	<title><?php if(is_home()) bloginfo('name'); else wp_title(''); ?></title>
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.columnizer.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>


  

  <script type="text/javascript" src="//use.typekit.net/gfb2mjm.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php wp_head();?>
</head>


<body>

<div id="fixbar">

  <div id="mininav">
    <div class="iconblock">
      <a><span id="menuicon" class="glyphicon glyphicon-align-justify"></span>
      </a>
    </div> <!-- end menu iconblock -->

    <div id="neglogo">
      <img src="<?php bloginfo('template_directory'); ?>/img/negative-logo.png">
    </div> <!-- end neglogo -->

    <div class="iconblock">
      <a ><span id="searchicon" class="glyphicon glyphicon-search right"></span></a>
    </div><!-- end search iconblock -->
  </div>

  <div class="container" id="headerbar">
      <div class="row">

          <div class="col-sm-4 col-lg-4">
            <img src="<?php bloginfo('template_directory'); ?>/img/logo.png" id="logo">
          </div>

          <div class="col-sm-8 col-lg-8">

            <div class="row" id="quicklinks">
                <ul class="right">
                    <li ><a href="#">Archives</a><div class="arrow-down"></div></li>
                    <li ><a href="#">Quicklinks</a><div class="arrow-down"></li>
                </ul>
            </div>

            <div class="row" id="quicklinks-lg">
                <ul class="right">
                    <li ><a href="#">Downloads</a></li>
                    <li ><a href="#">Skip Nav</a></li>
                    <li ><a href="#">Accessibility</a></li>
                    <li ><a href="#">Calendar</a></li>
                    <li ><a href="#">People Finder</a></li>
                    <li ><a href="#">A to Z</a></li>
                    <li ><a href="#">Webmail</a></li>
                </ul>
            </div>

            <form class="navbar-form clearfix" role="search">
              <label for="srch-term">Search Catalog:</label>
              <div id="csunsearch" class="input-group ">
                <input type="text" class="form-control" placeholder="Search Catalog" name="srch-term" id="srch-term">
                
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><!-- <div class="arrow-left"></div> --><span class="glyphicon glyphicon-search"></span></button>
                </div>
              </div>
            </form>
          </div>

      </div>   <!-- end row -->
  </div>


  <div id="csunnav" class="hideme">
      <div class="container clearfix">
      <ul class="nav">
          <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
          <li><a href="<?php bloginfo('url'); ?>">Majors</a></li>
          <li><a href="<?php bloginfo('url'); ?>">Minors</a></li>
          <li><a href="<?php bloginfo('url'); ?>">Policies</a></li>
          <li><a href="<?php bloginfo('url'); ?>">General Education</a></li>
          <li><a href="<?php bloginfo('url'); ?>">Graduate Program</a></li>

      </ul>
      </div>

  </div> <!-- end csunnav -->




</div> <!-- end fixbar -->
