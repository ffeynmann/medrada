<?php
add_filter( 'vc_iconpicker-type-fontawesome', 'vc_iconpicker_type_gt3icons' );
function vc_iconpicker_type_gt3icons( $icons ) {
	$gt3icons = array(
		'GT3 Icons' => array(
			array( 'theme_icon-arrows-left' => 'Arrow(left, gt3)' ),
			array( 'theme_icon-arrows-right' => 'Arrow(right, gt3)' ),
		),
	);

	return array_merge( $icons, $gt3icons );
}
