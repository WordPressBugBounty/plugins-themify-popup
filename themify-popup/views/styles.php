<?php
/**
 * Template to render popups on frontend
 *
 * @var $id
 * @var $style
 */

$id = isset( $id ) ? (int) $id : 0;
$style = ( isset( $style ) && is_string( $style ) ) ? $style : '';
$styles = array();

if ( themify_popup_check( 'popup_width' ) ) {
	$width = themify_popup_css_number( themify_popup_get( 'popup_width' ) );
	$width_unit = themify_popup_css_unit( themify_popup_get( 'popup_width_unit', 'px' ), array( 'px', '%', 'em' ) );
	if ( '' === $width_unit ) {
		$width_unit = 'px';
	}
	if ( '' !== $width ) {
		$size = $width . $width_unit;
		if ( 'classic' === $style ) {
			$styles[] = "body.themify-popup-showing-{$id} .mfp-wrap .mfp-inline-holder .mfp-content{width:{$size}!important}";
		} elseif ( 'slide-out' === $style ) {
			$styles[] = "#themify-popup-{$id}{width:{$size}!important}";
		}
	}
}
if ( themify_popup_check( 'popup_height' ) && ! themify_popup_check( 'popup_auto_height' ) ) {
	$height = themify_popup_css_number( themify_popup_get( 'popup_height' ) );
	$height_unit = themify_popup_css_unit( themify_popup_get( 'popup_height_unit', 'px' ), array( 'px', '%' ) );
	if ( '' === $height_unit ) {
		$height_unit = 'px';
	}
	if ( '' !== $height ) {
		$size = $height . $height_unit;
		if ( 'classic' === $style ) {
			$styles[] = "body.themify-popup-showing-{$id} .mfp-wrap .mfp-inline-holder .mfp-content{height:{$size}!important}";
		} elseif ( 'slide-out' === $style ) {
			$styles[] = "#themify-popup-{$id}{height:{$size}!important}";
		}
	}
}
$overlay = themify_popup_sanitize_css_color( themify_popup_get( 'popup_overlay_color' ) );
if ( '' !== $overlay ) {
	$styles[] = "body.themify-popup-showing-{$id} .mfp-bg{background-color:{$overlay}}";
}
$custom_css = themify_popup_get_custom_css();
if ( '' !== $custom_css ) {
	$styles[] = $custom_css;
}

if ( ! empty( $styles ) ) {
	printf( '<style>%s</style>', themify_popup_escape_inline_style( implode( "\n", $styles ) ) );
}
