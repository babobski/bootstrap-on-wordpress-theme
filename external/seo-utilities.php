<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function seo_support() {
	
	global $screens;

	foreach ( $screens as $screen ) {

		add_meta_box(
			'babobski_seo_support',
			__( 'SEO', 'wp_babobski' ),
			'myplugin_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'seo_support' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback( $post ) {

	wp_nonce_field( 'seo_support_metabox', 'seo_support_nonce' );

	$title 		= get_post_meta ( $post->ID, '_seo_title_', true );
	$desc 		= get_post_meta ( $post->ID, '_seo_desc_', true );
	$keywords 	= get_post_meta ( $post->ID, '_seo_key_', true );
	$noindex 	= get_post_meta ( $post->ID, '_seo_noindex_', true );
	$checked	= '';
	
	if($noindex == 'on'){
		$checked = 'checked="checked"';
	}

	echo '<p><label for="seo_title"><strong>';
	_e( 'Page title', 'wp_babobski' );
	echo '<strong></label><br>';
	echo '<input type="text" id="seo_title" name="seo_title" value="' . esc_attr( $title ) . '" size="54" /></p>';
	echo '<p><label for="seo_desc">';
	_e( 'Page description', 'wp_babobski' );
	echo '</label><br>';
	echo '<textarea id="seo_desc" name="seo_desc" cols="52" rows="5" >' . esc_attr( $desc ) . '</textarea></p>';
	echo '<p><label for="seo_key">';
	_e( 'Page keywords', 'wp_babobski' );
	echo '</label><br>';
	echo '<textarea id="seo_key" name="seo_key" cols="52" rows="5" >' . esc_attr( $keywords ) . '</textarea></p>';
	echo '<p><input type="checkbox" id="seo_noindex" name="seo_noindex" ' . $checked . ' /><label for="seo_noindex">';
	_e( 'No index / No follow (hidden for searchengine)', 'wp_babobski' );
	echo '</label>';
	echo '</p>';
}

function myplugin_save_meta_box_data( $post_id ) {

	if ( ! isset( $_POST['seo_support_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['seo_support_nonce'], 'seo_support_metabox' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	if ( isset( $_POST['seo_title'] ) ) {
		$my_data = sanitize_text_field( $_POST['seo_title'] );
	
		update_post_meta( $post_id, '_seo_title_', $my_data );
	} 
	
	if ( isset( $_POST['seo_desc'] ) ) {
		$my_data = sanitize_text_field( $_POST['seo_desc'] );
	
		update_post_meta( $post_id, '_seo_desc_', $my_data );
	}
	
	if ( isset( $_POST['seo_key'] ) ) {
		$my_data = sanitize_text_field( $_POST['seo_key'] );
	
		update_post_meta( $post_id, '_seo_key_', $my_data );
	}
	
	//if ( isset( $_POST['seo_noindex'] ) ) {
		$my_data = sanitize_text_field( $_POST['seo_noindex'] );
	
		update_post_meta( $post_id, '_seo_noindex_', $my_data );
	//}
	
}
add_action( 'save_post', 'myplugin_save_meta_box_data' );


function seo_pages_columns( $columns ) {

	$SeoColumns = array(
		'seo_title' => __( 'Seo Title', 'wp_babobski' ),
		'seo_desc' => __( 'Seo Desciption', 'wp_babobski' ),
		'seo_key' => __( 'Seo Keywords', 'wp_babobski' ),
		'seo_noindex' => __( 'No Index / No Follow', 'wp_babobski' )
	);
	$columns = array_merge( $columns, $SeoColumns );
	
	unset(
		$columns['author'],
		$columns['comments']
	);

	return $columns;
}
add_filter( 'manage_pages_columns', 'seo_pages_columns' );

function seo_page_column_content( $column_name, $post_id ) {
	switch ($column_name) {
		case 'seo_title':
			echo get_post_meta( $post_id, '_seo_title_', true);
			break;
		case 'seo_desc':
			echo get_post_meta( $post_id, '_seo_desc_', true);
			break;
		case 'seo_key':
			echo get_post_meta( $post_id, '_seo_key_', true);
			break;
		case 'seo_noindex':
			echo get_post_meta( $post_id, '_seo_noindex_', true) == 'on' ? '<span style="color: red;" class="dashicons dashicons-no"></span> No index / No follow' : '';
			break;
	}
}

add_action( 'manage_pages_custom_column', 'seo_page_column_content', 10, 2 );

function seo_posts_columns( $columns ) {

	$SeoColumns = array(
		'seo_title' => __( 'Seo Title', 'wp_babobski' ),
		'seo_desc' => __( 'Seo Desciption', 'wp_babobski' ),
		'seo_key' => __( 'Seo Keywords', 'wp_babobski' ),
		'seo_noindex' => __( 'No Index / No Follow', 'wp_babobski' )
	);
	$columns = array_merge( $columns, $SeoColumns );
	
	unset(
		$columns['author'],
		$columns['comments']
	);

	return $columns;
}
add_filter( 'manage_posts_columns', 'seo_posts_columns' );

function seo_post_column_content( $column_name, $post_id ) {
	switch ($column_name) {
		case 'seo_title':
			echo get_post_meta( $post_id, '_seo_title_', true);
			break;
		case 'seo_desc':
			echo get_post_meta( $post_id, '_seo_desc_', true);
			break;
		case 'seo_key':
			echo get_post_meta( $post_id, '_seo_key_', true);
			break;
		case 'seo_noindex':
			echo get_post_meta( $post_id, '_seo_noindex_', true) == 'on' ? '<span style="color: red;" class="dashicons dashicons-no"></span> No index / No follow' : '';
			break;
	}
}

add_action( 'manage_posts_custom_column', 'seo_post_column_content', 10, 2 );

function get_seo_meta() {
    global $post;
    $theme_options = get_option('bootstrap_theme_options');
    $html = '';
    $seo_title = '';
    $seo_title_comapny = '';
    $seo_title_separator = '|';
    $seo_desc = '';
    $seo_key = '';
    $seo_noindex = '';
    
    
    if(is_home()) {
        if(isset($theme_options['home_seo_title']) && ! empty($theme_options['home_seo_title'])){
            $seo_title = $theme_options['home_seo_title'];
        }
        
         if(isset($theme_options['home_seo_desc']) && ! empty($theme_options['home_seo_desc'])){
            $seo_desc = $theme_options['home_seo_desc'];
        }
        
         if(isset($theme_options['home_seo_key']) && ! empty($theme_options['home_seo_key'])){
            $seo_key = $theme_options['home_seo_key'];
        }
    }
    
    if(is_single() || is_page()){
        $seo_title = get_post_meta( $post->ID, '_seo_title_', true);
        $seo_desc = get_post_meta( $post->ID, '_seo_desc_', true);
        $seo_key = get_post_meta( $post->ID, '_seo_key_', true);
        $seo_noindex = get_post_meta( $post->ID, '_seo_noindex_', true);
    }
    
    if(isset($theme_options['home_site_title_company_ending']) && $theme_options['home_site_title_company_ending'] == 'on'){
        $seo_title_comapny =  get_bloginfo( 'name' );
    }
    
    if( isset( $theme_options['site_title_separator'] ) && $theme_options['site_title_separator'] != null ){
        $seo_title_separator =  $theme_options['site_title_separator'];
    }
    
    if(! isset($theme_options['home_site_title_company_ending'])) {
        $seo_title_separator = '';
    }
    
    if(! empty($seo_title)){
        $html .= '<title>' . $seo_title . ' ' . $seo_title_separator . ' ' . $seo_title_comapny . '</title>';
    } else {
        $title = get_the_title();
        if(is_category()) {
                $title = __('Category Archive:', 'wp_babobski') . single_cat_title( '', false );
            } elseif(is_archive()) {
                $title = __('Archive', 'wp_babobski');
            
        }
        $html .= '<title>' . $title . wp_title( $seo_title_separator, false, 'right' ) . $seo_title_comapny . '</title>';
    }
    
     if(! empty($seo_desc)){
        $html .= '<meta name="description" content="' . $seo_desc . '">' . PHP_EOL;
    }
    
     if(! empty($seo_key)){
        $html .= '<meta name="keywords" content="' . $seo_key . '">' . PHP_EOL;
    }
    
     if(! empty($seo_noindex)){
        $html .= '<meta name="robots" content="noindex, nofollow">' . PHP_EOL;
    }
    
    
    return $html;
}