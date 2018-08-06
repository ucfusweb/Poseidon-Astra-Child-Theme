<?php

/**
* Added customizer fields
*/
function your_theme_new_customizer_settings($wp_customize) {
// add a setting for the unit phone number
$wp_customize->add_setting('ugs_phone_number');
// Add a control to upload the unit phone number
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ugs_phone_number',
array(
'label' => 'Unit Phone Number',
//'capability'     => 'edit_theme_options',
'section' => 'title_tagline',
'settings' => 'ugs_phone_number',
'type'     => 'text',
'priority' => 6.5,
		)
	)
);



// add a setting for the unit phone number
$wp_customize->add_setting('ugs_email');
// Add a control to upload the unit phone number
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ugs_email',
array(
'label' => 'Unit Email',
//'capability'     => 'edit_theme_options',
'section' => 'title_tagline',
'settings' => 'ugs_email',
'type'     => 'email',
'priority' => 6.51,
		)
	)
);

// add a setting for the unit address
$wp_customize->add_setting('ugs_address');
// Add a control to upload the unit address
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ugs_address',
array(
'label' => 'Unit Address',
//'capability'     => 'edit_theme_options',
'section' => 'title_tagline',
'settings' => 'ugs_address',
'type'     => 'textarea',
'priority' => 6.52,
		)
	)
);


//$wp_customize->get_section('title_tagline')->title = __( 'Name & Logo' );


$collegeurl = ['http://undergrad.dev.ucf.edu',
'https://undergrad.dev.ucf.edu',
'http://academicservices.dev.ugs.ucf.edu',
'https://academicservices.dev.ugs.ucf.edu'
];

if( in_array(get_site_url(), $collegeurl)){
				$DivisionorCollege = "College of Undergraduate Studies";
			return $DivisionorCollege;
}else{
		$DivisionorCollege = "Division of teaching and Learning2 fhdsfh ";
		return $DivisionorCollege;

}


}
add_action('customize_register', 'your_theme_new_customizer_settings');

//echo get_site_url();
