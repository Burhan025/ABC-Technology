<?php
/**
 * @package WordPress
 * @subpackage ABC
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="google-site-verification" content="F0tidd5LzR-YsKWHbXHG5A6sssb4otcq6cy-qiD0luw" />
	<title><?php wp_title('|', true, 'right'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">

	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<?php wp_head(); ?>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body <?php body_class(); ?>>
	<?php $abc_options = get_option('abc_options'); ?>

	<div class="header safety-header">
		<div class="container">
                <div class="col-sm-6 header-left">
                    <div class="head-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" rel="home"><img src="https://abctechgroup.com/wp-content/uploads-abc/2023/07/logo-a.png" alt="<?php bloginfo('description'); ?>"/></a>
                    </div>
                    <div class="head-tag">
                    <p><?php the_field('header_tag'); ?></p>
                    </div>
                </div>
                <div class="col-sm-6 header-right">
                    <div class="head-cta">
                    <?php the_field('header_cta'); ?>
                    </div>
                    <div class="head-support">
                    <?php the_field('header_support'); ?>
                    </div>
                </div>
		</div>
	</div>