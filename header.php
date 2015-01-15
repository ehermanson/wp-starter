<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  if ( is_single() ) {
    wp_enqueue_script( 'comment-reply' );
  }
  ?>

  <?php wp_head(); ?>

</head>
<!--[if lt IE 10]>
<div class="update-browser"><p>Your browser is outdated and potentially unsafe. Please <a href="http://browsehappy.com/">upgrade your broswer</a> for the best experience on this site and many others.</div> 
<![endif]-->

<body <?php body_class(); ?>>

<header class="site-header" role="banner">
  <div class="block">
    <div class="navbar">
      <a class="logo" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
    </div>

    <nav class="primary-menu" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'navigation'));
        endif;
      ?>
    </nav>
  </div>
</header>

<?php get_template_part( 'templates/page-header' ); ?>

<div class="page-wrap">