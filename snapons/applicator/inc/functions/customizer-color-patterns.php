<?php // Applicator Customizer Color Patterns
// From twentyseventeen

function applicator_customizer_color_patterns() {
    
    $hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );

	$saturation = absint( apply_filters( 'applicator_func_custom_colors_saturation', 50 ) );
	$reduced_saturation = ( .8 * $saturation ) . '%';
	$saturation = $saturation . '%';
	
    $css = '
    
    :root
    {
        --main-header--bg-color: hsl( ' . $hue . ', ' . $saturation . ', 50% );
    }
    
    .main-header---cr
    {
        background-color: var(--main-header--bg-color);
    }
    
    ';

	return apply_filters( 'applicator_customizer_color_patterns', $css, $hue, $saturation );
}