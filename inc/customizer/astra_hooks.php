<?php

/**
 * Astra Hooks
 */




 $args = array(
 	'width'         => 1224,
 	'height'        => 326,
 	'default-image' => get_stylesheet_directory_uri() . '/assets/images/header.jpg',
 	'uploads'       => true,
 );

 // add header image
 add_theme_support( 'custom-header', $args );



function add_script_page_banner_after_header() {
    // Your PHP goes here
$display_header = get_post_meta(  get_the_ID() , 'ucf_ugs_header_dpy_header', true );

	if( !is_front_page() &&  empty($display_header) ){
				?><div class="header-img" style=" background-image: url('<?php header_image(); ?>'); ">
				</div><?php
  			}
}
// add the banner to all pages except the frontpage
add_action( 'astra_masthead_bottom', 'add_script_page_banner_after_header' );




function add_script_astra_primary_content_top() {

	   if( current_user_can('edit_posts') && !is_front_page() ) {edit_post_link('Edit this Page', '<div class="ugs-edit"><p>', '</p></div>');}
    $display_header = get_post_meta(  get_the_ID() , 'ucf_ugs_header_dpy_header', true );
      if(empty($display_header)){
        if(function_exists('seopress_display_breadcrumbs')) { echo seopress_display_breadcrumbs(); }
      }

  }

// adds edit button to entrys and pages
add_action( 'astra_entry_top', 'add_script_astra_primary_content_top' );









function add_script_before_footer() {


$classes[] = 'footer-adv';
$classes[] = 'footer-adv-layout-2';
$classes   = implode( ' ', $classes );
?>

<div class="<?php echo esc_attr( $classes ); ?>">
	<div class="footer-adv-overlay">
		<div class="ast-container">
			<?php do_action( 'astra_footer_inside_container_top' ); ?>
			<div class="ast-row">
				<div class="ast-col-lg-4 ast-col-md-4 ast-col-sm-12 ast-col-xs-12 footer-adv-widget footer-adv-widget-1">
					<div class="site_name" ><?php bloginfo( 'name' ); ?></div>
					<div class="site-identifier" ><?php bloginfo( 'description' ); ?></div>
				</div>

				<div class="ast-col-lg-4 ast-col-md-4 ast-col-sm-12 ast-col-xs-12 footer-adv-widget footer-adv-widget-1">

				</div>

				<div class="ast-col-lg-4 ast-col-md-6 ast-col-sm-4 ast-col-xs-12 footer-adv-widget footer-adv-widget-2">
					<?php if ( get_theme_mod( 'ugs_email' ) ) : ?> <div class="ugs_email ugs"> <?php echo '<a herf="mailto:' . get_theme_mod( 'ugs_email' ) . '">' . get_theme_mod( 'ugs_email' ) . '</a>' ?> </div> <?php endif; ?>
					<?php if ( get_theme_mod( 'ugs_email' ) ) : ?> <div class="ugs_phone ugs"> <?php echo  '<a herf="tel:' . get_theme_mod( 'ugs_phone_number' ) . '">' . get_theme_mod( 'ugs_phone_number' ) . '</a>' ?> </div> <?php endif; ?>
					<?php if ( get_theme_mod( 'ugs_address' ) ) : ?> <div class="ugs_address ugs">  <?php echo get_theme_mod( 'ugs_address' ); ?> </div> <?php endif; ?>
					<?php //astra_get_footer_widget( 'advanced-footer-widget-2' ); ?>
				</div>
			</div><!-- .ast-row -->
			<?php do_action( 'astra_footer_inside_container_bottom' ); ?>
		</div><!-- .ast-container -->
	</div><!-- .footer-adv-overlay-->
</div><!-- .ast-theme-footer .footer-adv-layout-2 -->

<div class="dtl-ugs-footer">
	<div class="ast-container">
		<div class="ast-row">
			<div class="ast-col-xs-12">
				<p class="tagline"> Excellence, Innovation, and Distinction</p>
			</div>
		</div>  <!-- close row -->
	</div>  <!-- close container -->
</div> <!-- close footer bottom -->

<?php
};

// adds the custom footer
add_action( 'astra_footer_before', 'add_script_before_footer' );
