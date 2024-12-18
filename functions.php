<?php
/**
 * @package WordPress
 * @subpackage ABC
 */

add_action('wp_ajax_abc_get_imgurl', 'abc_get_imgurl');

function abc_setup() {
	add_theme_support( 'automatic-feed-links' );
	register_nav_menu( 'primary', __( 'Navigation Menu', 'abc' ) );
	register_nav_menu( 'footer', __( 'Footer Menu', 'abc' ) );
	register_nav_menu( 'home', __( 'Home Menu', 'abc' ) );
	register_nav_menu( 'demo', __( 'Demo Menu', 'abc' ) );
	
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'banner', 1440, 9999, true );
	set_post_thumbnail_size( 1440, 9999, true );
}
add_action( 'after_setup_theme', 'abc_setup' );

function abc_scripts_styles() {
	wp_enqueue_style( 'fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.1.1' );
	wp_enqueue_style( 'flowplayer', get_template_directory_uri() . '/flowplayer/skin/minimalist.css', array(), '5.4.3' );
	wp_enqueue_style( 'abc_custom', get_template_directory_uri() . '/css/abc-custom-style.css?v='.time(), array() );
	wp_enqueue_style( 'abc_customs', get_template_directory_uri() . '/landing-style.css?v='.time(), array() );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.1.1', true );
    wp_enqueue_script( 'slicksliderjs', get_stylesheet_directory_uri().'/js/slick.min.js', true);
	wp_enqueue_script( 'flowplayer', get_template_directory_uri() . '/flowplayer/flowplayer.min.js', array('jquery'), '5.4.3', true );
	wp_enqueue_script( 'abc', get_template_directory_uri() . '/js/script.js', array('jquery'), '2014-05-29', true );
}
add_action( 'wp_enqueue_scripts', 'abc_scripts_styles' );

function abc_admin_scripts_styles() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-sortable');
	
	add_thickbox();
	
	wp_enqueue_style('abc', get_template_directory_uri() . '/css/admin.css');
	wp_enqueue_script('abc', get_template_directory_uri() . '/js/admin.js');
}
add_action( 'admin_enqueue_scripts', 'abc_admin_scripts_styles');

function abc_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'abc' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'abc_wp_title', 10, 2 );

function abc_page_title() {
	
	if ( is_singular() )
	{
		global $wp_query;
		echo get_the_title( $wp_query->post->ID );
	}
	elseif ( is_category() ) single_cat_title();

	elseif ( is_tag() ) single_tag_title();

	elseif ( is_author() ) printf( __( 'Author: %s', 'abc' ), get_the_author() );

	elseif ( is_day() ) printf( __( 'Day: %s', 'abc' ), get_the_date() );

	elseif ( is_month() ) printf( __( 'Month: %s', 'abc' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'abc' ) ) );

	elseif ( is_year() ) printf( __( 'Year: %s', 'abc' ), get_the_date( _x( 'Y', 'yearly archives date format', 'abc' ) ) );

	elseif ( is_search() ) _e( 'Search Results', 'abc' );

	else _e( 'Archives', 'abc' );
}

function abc_widgets_init() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('WP_Widget_Text');
}
add_action( 'widgets_init', 'abc_widgets_init' );

function abc_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<?php if ( get_next_posts_link() ) : ?>
		<div class="paging"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older', 'abc' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="paging pull-right"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&rarr;</span>', 'abc' ) ); ?></div>
		<?php endif; ?>
		
		<div style="clear: both;"></div>
	</nav><!-- .navigation -->
	<?php
}

add_filter( 'show_admin_bar', '__return_false' );

function the_excerpt_text($content) {
	$content = trim(strip_tags($content));
	if ( strlen( $content ) > 155 ) {
		$content = substr($content, 0, 156);
		
		while(substr($content, -1) != ' ')
			$content = substr($content, 0, -1);
		
		return substr($content, 0, -1) . '...';
	} else {
		return $content;
	}
}

function abc_admin_menu() {
	add_menu_page( __( 'ABC Options', 'abc' ), __( 'ABC Options', 'abc' ), 'manage_options', 'abc-options', 'abc_options' );
}
add_action( 'admin_menu', 'abc_admin_menu' );

function abc_options()
{
	$updated_msg = '';
	if( array_key_exists( 'abc_options_submit', $_REQUEST ) ) {
		$updated_msg = abc_options_updatedb();
	}
	
	$options = get_option( 'abc_options' ); ?>
	
	<div class="wrap">
		<div id="icon-options-general" class="icon32"><br></div><h2>ABC Options</h2>
		
		<?php if($updated_msg != '') : ?>
			<div id="message" class="updated"><p><?php echo $updated_msg; ?></p></div>
		<?php endif; ?>
		
		<form action="" method="post">
			<input type="hidden" name="abc_options_submit" value="1" />
			<?php wp_nonce_field( 'lr-options-updatedb' ); ?>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label><?php _e( 'Slider Images', 'abc' ); ?></label></th>
					<td>
						<div id="abc_slider_images_ul" class="abc_images_list">
							<ul><?php
								if(is_array($options['abc_slider_images']) && count($options['abc_slider_images'])) foreach($options['abc_slider_images'] as $abc_slider_image) {
									$imgid = intval($abc_slider_image['imgid']);
									if($imgid > 0) {
										$imgurl = wp_get_attachment_thumb_url($imgid);
										if($imgurl) echo '<li><img src="' . $imgurl. '"/>
										<div><input type="hidden" name="abc_slider_images[]" value="' . $imgid . '"/>
										<input type="text" name="abc_slider_title[]" value="' . esc_attr($abc_slider_image['title']). '" placeholder="Title"/>
										<input type="text" name="abc_slider_link[]" value="' . esc_attr($abc_slider_image['link']). '" placeholder="Link"/>
										</div><a>X</a></li>';
									}
							} ?></ul>
							<div style="clear: both;"></div>
						</div>
						<input type="button" class="button" onclick="javascript:abc_upload_slider('#abc_slider_images');" value="<?php _e('Add image', 'ctl'); ?>"/>
						<script type="text/javascript">
							jQuery(document).ready(function($) {
								$('#abc_slider_images_ul ul').sortable({
									placeholder: 'abc_drop_holder',
									handle: 'img',
									cancel: 'a'
								});
								$('#abc_slider_images_ul ul li a').click(function() {
									$(this).parent().remove();
								});
							});
						</script>
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row"><label for="abc_featured"><?php _e( 'Home Featured', 'abc' ); ?></label></th>
					<td><?php wp_editor($options['abc_featured'], 'abc_featured'); ?></td>
				</tr>
				
				<tr><td colspan="2"><hr /></td></tr>
				
				<tr valign="top">
					<th scope="row"><label for="twitter_acc"><?php _e( 'Twitter account', 'abc' ); ?></label></th>
					<td>http://twitter.com/<input type="text" name="twitter_acc" id="twitter_acc" class="regular-text" value="<?php echo esc_attr($options['twitter_acc']); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="facebook_acc"><?php _e( 'Facebook account', 'abc' ); ?></label></th>
					<td>http://www.facebook.com/<input type="text" name="facebook_acc" id="facebook_acc" class="regular-text" value="<?php echo esc_attr($options['facebook_acc']); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="mail_acc"><?php _e( 'Email address', 'abc' ); ?></label></th>
					<td><input type="text" name="mail_acc" id="mail_acc" class="regular-text" value="<?php echo esc_attr($options['mail_acc']); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="google_acc"><?php _e( 'Google plus account', 'abc' ); ?></label></th>
					<td>https://plus.google.com/<input type="text" name="google_acc" id="google_acc" class="regular-text" value="<?php echo esc_attr($options['google_acc']); ?>" /></td>
				</tr>
				
				<tr><td colspan="2"><hr /></td></tr>
				
				<tr valign="top">
					<th scope="row"><label for="top_text"><?php _e( 'Top block text', 'abc' ); ?></label></th>
					<td><input type="text" name="top_text" id="top_text" class="large-text" value="<?php echo esc_attr($options['top_text']); ?>" /></td>
				</tr>
				
				<tr valign="top">
					<th scope="row"><label for="footer_text"><?php _e( 'Footer text', 'abc' ); ?></label></th>
					<td><input type="text" name="footer_text" id="footer_text" class="large-text" value="<?php echo esc_attr($options['footer_text']); ?>" /></td>
				</tr>
				
			</table>
			
			<p class="submit"><input type="submit" name="submit" class="button button-primary" value="<?php _e( 'Update', 'abc' ) ?>" /></p>
		</form>
	</div>
	<?php
}

function abc_options_updatedb() {
	$options = get_option( 'abc_options' );
	
	$options['twitter_acc'] = stripslashes(strtolower(trim($_REQUEST['twitter_acc'])));
	$options['facebook_acc'] = stripslashes(strtolower(trim($_REQUEST['facebook_acc'])));
	$options['mail_acc'] = stripslashes(strtolower(trim($_REQUEST['mail_acc'])));
	$options['google_acc'] = stripslashes(strtolower(trim($_REQUEST['google_acc'])));
	
	$options['abc_slider_images'] = array();
	if(count($_REQUEST['abc_slider_images'])) {
		$slider_count = 0;
		foreach($_REQUEST['abc_slider_images'] as $imgid) {
			$options['abc_slider_images'][] = array(
				'imgid' => $imgid,
				'title' => stripslashes($_REQUEST['abc_slider_title'][$slider_count]),
				'link' => stripslashes($_REQUEST['abc_slider_link'][$slider_count])
			);
			$slider_count++;
		}
	}
	
	$options['abc_featured'] = stripslashes($_REQUEST['abc_featured']);
	
	$options['top_text'] = stripslashes($_REQUEST['top_text']);
	$options['footer_text'] = stripslashes($_REQUEST['footer_text']);
	
	update_option( 'abc_options', $options );
	
	return 'ABC options updated';
}

function abc_shortcode_permalink( $atts, $content = null ) {
	extract(shortcode_atts(array("id" => '0'), $atts));
	if($content != null) {
		return '<a href="' . get_permalink(intval($id)) . '">' . do_shortcode($content) . '</a>';
	}
	
	return get_permalink(intval($id));
}
add_shortcode('abc_permalink', 'abc_shortcode_permalink');

function abc_video_permalink( $atts, $content = null ) {

	extract(shortcode_atts(array('splash' => ''), $atts));
	if($splash != '') $splash = ' style="background-image:url(' . $splash . ');"';

	if($content != null) {
		return '<div' . $splash . ' data-ratio="0.56" data-swf="' . get_template_directory_uri() . '/flowplayer/flowplayer.swf" class="flowplayer no-toggle play-button color-light is-splash" data-embed="false" data-fullscreen="false" data-keyboard="false"><video>' . $content . '</video></div>';
	}else{	
	return '';
        }
}
add_shortcode('abc_video', 'abc_video_permalink');

function abc_get_imgurl() {
	$imgid = isset($_REQUEST['imgid']) ? intval($_REQUEST['imgid']) : 0;
	if($imgid > 0) {
		$imgurl = wp_get_attachment_thumb_url($imgid);
		if($imgurl) echo json_encode(array('status'=>'OK', 'imgurl'=>$imgurl));
	}
	die();
}
/*2-12*/
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<button class='button gform_button' id='gform_submit_button_{$form['id']}'><span>SEND</span></button>";
}
/*function pw_loading_scripts_wrong() {
	//echo '<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>';
	echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/jquery-1.10.2.min.js"></script>';
}
//add_action('admin_head', 'pw_loading_scripts_wrong');*/
add_filter('gform_init_scripts_footer', '__return_true');

