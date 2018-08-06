<?php
/**
 * Poseidon - Astra Child theme Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Poseidon - Astra Child theme
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_POSEIDON_ASTRA_CHILD_THEME_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'poseidon-astra-child-theme-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_POSEIDON_ASTRA_CHILD_THEME_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );







// astra hooks for the header, footer and content
require ( get_stylesheet_directory() . '/inc/customizer/astra_hooks.php' );


// added fields to the customizer
require ( get_stylesheet_directory() . '/inc/customizer/added_fields.php' );





function url_shortcode() {

return '<a href="'.get_bloginfo('url') .'/wp-login.php"><img src="' .get_stylesheet_directory_uri() . '/assets/images/ugs_dtl_logo.png" alt="Divison of Teaching and Learning and College of Undergraduate Studies"> </a>
				Copyright © ' . date("Y") . ' <a href="//dtl.ucf.edu">Division of Teaching and Learning</a> |<a href="//undergrad.ucf.edu">College of Undergraduate Studies</a>';
}
add_shortcode('login-logo','url_shortcode');







/**
* Change blog post navigation text
*/
function default_strings_callback( $strings ) {
    // Next text
  //  $strings['string-blog-navigation-next']		= __('Next work plese Page', 'astra') . ' <span class="ast-right-arrow">→</span>';
    // Previous Text
  //  $strings['string-blog-navigation-previous']	= '<span class="ast-left-arrow">←</span> ' . __('Previous ---- Page', 'astra');

	/* single post nave text */
	$next_post = get_next_post();
	$prev_post = get_previous_post();
		$strings['string-single-navigation-next']	= '<div class="black-text"> Next Post </div> '.  __(esc_attr( $next_post->post_title ), 'astra');
		$strings['string-single-navigation-previous']	= '<div class="black-text"> Previous Post </div> <div>'.  __( esc_attr( $prev_post->post_title ), 'astra'). '</div>';

    return $strings;
}
//add_filter( 'astra_default_strings', 'default_strings_callback', 10 );



class ucf_header_Meta_Box {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes',        array( $this, 'add_metabox' )         );
		add_action( 'save_post',             array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		add_meta_box(
			'header-box-display',
			__( 'Display Header Image', 'ucftext' ),
			array( $this, 'render_metabox' ),
			'page',
			'side',
			'low'
		);

	}

	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'ucf_ugs_header_nonce_action', 'ucf_ugs_header_nonce' );

		// Retrieve an existing value from the database.
		$ucf_ugs_header_dpy_header = get_post_meta( $post->ID, 'ucf_ugs_header_dpy_header', true );

		// Set default values.
		if( empty( $ucf_ugs_header_dpy_header ) ) $ucf_ugs_header_dpy_header = '';

		// Form fields.
		echo '<table class="form-table">';

		echo '	<tr>';
		echo '		<td>';
		echo '			<label><input type="checkbox" id="ucf_ugs_header_dpy_header" name="ucf_ugs_header_dpy_header" class="ucf_ugs_header_dpy_header_field" value="checked" ' . checked( $ucf_ugs_header_dpy_header, 'checked', false ) . '> ' . __( '', 'ucftext' ) . '</label>';
		echo '			<span class="description">' . __( 'Hide the banner image', 'ucftext' ) . '</span>';
		echo '		</td>';
		echo '	</tr>';

		echo '</table>';

	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['ucf_ugs_header_nonce'] ) ? $_POST['ucf_ugs_header_nonce'] : '';
		$nonce_action = 'ucf_ugs_header_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Check if the user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $post_id ) )
			return;

		// Check if it's not a revision.
		if ( wp_is_post_revision( $post_id ) )
			return;

		// Sanitize user input.
		$ucf_ugs_header_new_dpy_header = isset( $_POST[ 'ucf_ugs_header_dpy_header' ] ) ? 'checked'  : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'ucf_ugs_header_dpy_header', $ucf_ugs_header_new_dpy_header );

	}

}

new ucf_header_Meta_Box;
