<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

/**
 * Initialize theme default settings
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom pagination for this theme.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Comments file.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Load WooCommerce functions.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load Editor functions.
 */
require get_template_directory() . '/inc/editor.php';


//ADD FONTS and VCU Brand Bar
add_action('wp_enqueue_scripts', 'alt_lab_scripts');
function alt_lab_scripts() {
	$query_args = array(
		'family' => 'Roboto:100,300,400,700|Oswald:400,500,700|Roboto+Mono:100,400',
		'subset' => 'latin,latin-ext',
	);
	wp_enqueue_style ( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );

	wp_enqueue_script( 'vcu_brand_bar', 'https:///branding.vcu.edu/bar/academic/latest.js', array(), '1.1.1', true );

	wp_enqueue_script( 'alt_lab_js', get_template_directory_uri() . '/js/alt-lab.js', array(), '1.1.1', true );
    }

//add footer widget areas
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Footer - far left',
    'id' => 'footer-far-left',    
    'before_widget' => '<div class = "widgetizedArea">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Footer - medium left',
    'id' => 'footer-med-left',    
    'before_widget' => '<div class = "widgetizedArea">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);


if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Footer - medium right',
    'id' => 'footer-med-right',    
    'before_widget' => '<div class = "widgetizedArea">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Footer - far right',
    'id' => 'footer-far-right',
    'before_widget' => '<div class = "widgetizedArea">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

//set a path for IMGS

  if( !defined('THEME_IMG_PATH')){
   define( 'THEME_IMG_PATH', get_stylesheet_directory_uri() . '/imgs/' );
  }


function bannerMaker(){
	global $post;
	 if ( get_the_post_thumbnail_url( $post->ID ) ) {
      //$thumbnail_id = get_post_thumbnail_id( $post->ID );
      $thumb_url = get_the_post_thumbnail_url($post->ID);
      //$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

        return '<div class="jumbotron custom-header-img" style="background-image:url('. $thumb_url .')"></div>';

    } 
}



//get challenge submissions from gravity forms
function get_challenges($page, $tag){
    $search_criteria = array(
      'status'        => 'active',
      'field_filters' => array(
          'mode' => 'any',
          array(
              'key'   => '5',
              'value' => $tag
          ),     
      )
  );

    //'key' => '1', 'operator' => 'contains', 'value' => 'Steve'
  $entries  = GFAPI::get_entries( 1, $search_criteria );
 // var_dump($entries);
      foreach ($entries as $entry) {   
        $date = $entry['date_created'];  
        $author = $entry['1.3'] . ' ' . $entry['1.6'];
        $email = $entry['2'];
        $album = $entry['3'];
        $tag = $entry['5'];
        echo '<li class="challenge-sub"><span class="author"><a href="mailto:' . $email . '">' . $author . '</a></span><span class="album"> <a href="' . $album . '">album link</a><span class="date"> ' . $date . '</span></li>';
  }
}


function acf_fetch_instagram_shortcode(){
  global $post;
  $html = '';
  $instagram_shortcode = get_field('instagram_shortcode');

    if( $instagram_shortcode) {      
      return $instagram_shortcode;  
    }

}


function acf_fetch_daily_challenge_description($tag){
  global $post;
  $html = '<h2>Daily Challenge</h2>';
  $daily_challenge_description = get_field('daily_challenge_description');

    if( $daily_challenge_description) {      
      $html .= '<div class="daily-description challenge">' . $daily_challenge_description . '</div>';  
      $html .= '<div class="challenge-hashtag">The Instagram hashtag for this assignment is <a href="https://www.instagram.com/explore/tags/' . clean_tag($tag) . '">' . $tag . '</a>';  
     return $html;    
    }

}



function acf_fetch_weekly_challenge_description($tag){
  global $post;
  $html = '<h2>Weekly Challenge</h2>';
  $weekly_challenge_description = get_field('weekly_challenge_description');

    if( $weekly_challenge_description) {      
      $html .= '<div class="weekly-description challenge">' . $weekly_challenge_description . '</div>'; 
       $html .= '<div class="challenge-hashtag">The Instagram hashtag for this assignment is <a href="https://www.instagram.com/explore/tags/' . clean_tag($tag) . '">' . $tag . '</a>';
     return $html;    
    }

}



function acf_fetch_daily_challenge_hashtag(){
  global $post;
  $html = '<h2>Daily Challenge</h2>';
  $daily_challenge_hashtag = get_field('daily_challenge_hashtag');

    if( $daily_challenge_hashtag) {      
      $html = $daily_challenge_hashtag;  
     return $html;    
    }

}



function acf_fetch_weekly_challenge_hashtag(){
  global $post;
  $html = '';
  $weekly_challenge_hashtag = get_field('weekly_challenge_hashtag');

    if( $weekly_challenge_hashtag) {      
      $html = $weekly_challenge_hashtag;  
     return $html;    
    }

}


function challenge_submission_structure($tag){
  $html  = '<button type="button" class="submit-work btn-photo" data-tag="' . $tag . '" data-toggle="modal" data-target="#submissionModal">Submit ' . $tag . ' Work </button>';
  return $html;
}


function clean_tag($tag){
  $hash = substr($tag,1);
  if($hash === '#'){
    return substr($hash,1,strlen($hash));
  } else {
    return $hash;
  }

}

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
  'key' => 'group_5bad11c686e33',
  'title' => 'Challenge',
  'fields' => array (
    array (
      'key' => 'field_5bad8061e7431',
      'label' => 'Daily Challenge Description',
      'name' => 'daily_challenge_description',
      'type' => 'textarea',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => '',
      'new_lines' => '',
    ),
    array (
      'key' => 'field_5bad809672840',
      'label' => 'Daily Challenge Hashtag',
      'name' => 'daily_challenge_hashtag',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array (
      'key' => 'field_5bad807cb3964',
      'label' => 'Weekly Challenge Description',
      'name' => 'weekly_challenge_description',
      'type' => 'textarea',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => '',
      'new_lines' => '',
    ),
    array (
      'key' => 'field_5bad80a0b287b',
      'label' => 'Weekly Challenge Hashtag',
      'name' => 'weekly_challenge_hashtag',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'page_template',
        'operator' => '==',
        'value' => 'page-templates/challenge.php',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

endif;