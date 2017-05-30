<?php // Applicator HTML_OK (Overkill)

// Component Structure

function htmlok_cp( $args = array() ) {
    
    //------------ Requirements
    
    // Require Array
	if ( empty( $args ) ) {
		return esc_html_e( 'Please define default parameters in the form of an array.', $GLOBALS['applicator_td'] );
	}
    
    // Require Name
	if ( empty( $args['name'] ) ) {
		return esc_html_e( 'Please define Name.', $GLOBALS['applicator_td'] );
	}
    
    // Require Content
	if ( empty( $args['content'] ) ) {
		return esc_html_e( 'Please define Content.', $GLOBALS['applicator_td'] );
	}
    
    //------------ Defaults
    
    $defaults = array(
        'name'          => '',
        'type'          => 'component', // Type: module | component | nav
        'elem'          => '', // Element: div | nav as <nav>
        'sub_type'       => '', // Sub-Type: header | content | footer
        
        'cp_css'        => '', // Component CSS: custom css at the root level
        'css'           => '',
        
        'attr'          => array(
            'id'        => '', // Component ID Attribute: id=""
        ),
        
        'content'       => '', // Content
        'hr_content'    => '', // Header Content
        'fr_content'    => '', // Footer Content
        
        'version'       => '', // Version
        'echo'          => false, // Echo
    );
    
    // Parse Arguments
    $r = wp_parse_args( $args, $defaults );
    
    //------------ Initialize Variables
    $r_name = '';
    $r_type = '';
    $r_elem = '';
    $r_sub_type = '';
    $r_cp_css = '';
    $r_css = '';
    $r_attr_id = '';
    $r_content = '';
    $r_hr_content = '';
    $r_fr_content = '';
    $r_version = '';
    $r_echo = '';
    
    $name = '';
    $css = '';
    $cp_css = '';
    $dynamic_css = '';
    $cp_dynamic_css = '';
    $cp_type_trailing_css = '';
    
    //------------ Default Variable Assignments
    $r_name = $r['name'];
    $r_type = $r['type'];
    $r_elem = $r['elem'];
    $r_sub_type = $r['sub_type'];
    
    $r_cp_css = $r['cp_css'];
    $r_css = $r['css'];
        
    $r_attr_id = $r['attr']['id'];
    
    $r_content = $r['content'];
    $r_hr_content = $r['hr_content'];
    $r_fr_content = $r['fr_content'];
    
    $r_version = $r['version'];
    $r_echo = $r['echo'];
    
    //------------ Output Variables
    $cp_tag = '';
    $attr_id = '';
    $cp_type_css = '';
    $cp_css = '';
    $cp_dynamic_css = '';
    $name = '';
    $css = '';
    
    //------------ Variables with Default Values
    $cp_tag = 'div';
    $cp_type_css = 'cp';
    $heading_tag = 'div';
    
    //------------ Term Variations
    $type_module_term_variations = array( 'module', 'md', 'm', );
    $type_component_term_variations = array( 'component', 'cp', 'c', );
    $type_nav_term_variations = array( 'navigation', 'nav', 'n', );
    
    $sub_type_header_term_variations = array( 'header', 'hr', );
    
    //------------ Regex Pattern and Replacement
    $pat_space = '/\s\s+/';
    $rep_space = ' ';
    
    //------------ Trimmed and Sanitize Variables
    $trimmed_name = preg_replace( $pat_space, $rep_space, trim( $r_name ) );
    $sanitized_name = sanitize_title( $trimmed_name );
    
    $content = preg_replace( $pat_space, $rep_space, trim( $r_content ) );
    
    // Type: Component
    if ( in_array( $r_type, $type_component_term_variations, true ) ) {
        $name = $trimmed_name;
        $cp_type_css = 'cp';
        $cp_type_trailing_css = '';
        $dynamic_css = ' ' . $sanitized_name;
    
    // Type: Nav
    } elseif ( in_array( $r_type, $type_nav_term_variations, true ) ) {
        $name = $trimmed_name . ' ' . 'Nav';
        $cp_type_css = 'nav';
        $cp_type_trailing_css = '-' . $cp_type_css;
        $dynamic_css = $sanitized_name . $cp_type_trailing_css;
        
    // Type: Module
    } elseif ( in_array( $r_type, $type_module_term_variations, true ) ) {
        $name = $trimmed_name . ' ' . 'Module';
        $cp_type_css = 'md';
        $cp_type_trailing_css = '-' . $cp_type_css;
        $dynamic_css = $sanitized_name . $cp_type_trailing_css;
    }
    
    // Element: Nav
    if ( in_array( $r_elem, $type_nav_term_variations, true ) ) {
        $cp_tag = 'nav';
    }
    
    // Component-Level Dynamic CSS
    $cp_dynamic_css = ' ' . $dynamic_css;
    
    // CSS
    if ( ! empty( $r_css ) ) {
        $css = ' ' . preg_replace( '/\s\s+/', ' ', trim( $r_css ) ) . $cp_type_trailing_css;
    } else {
        $css = ' ' . $dynamic_css;
    }
    
    // Component-Level CSS
    if ( ! empty( $r_cp_css ) ) {
        $cp_css = ' ' . preg_replace( '/\s\s+/', ' ', trim( $r_cp_css ) );
    }
        
        
    
    // id Attribute
    if ( ! empty( $r_attr_id ) ) {
        $attr_id = 'id="' . preg_replace('/\s\s+/', ' ', trim( $r_attr_id ) ) . '"';
    } else {
        $attr_id = '';
    }
    
    //------------ New Version
    if ( '0.1' == $r_version ) {
        
        // Initialize
        $output = '';
    
    //------------ Original Version    
    } else {
        
        // Initialize
        $output = '';
        
        //------------ Header Markup
        $hr_mu = '';
        $hr_mu .= '<div class="hr' . $css . '---hr">';
            $hr_mu .= '<div class="hr_cr' . $css . '---hr_cr">';
                $hr_mu .= '<' . $heading_tag . ' class="h' . $css . '---h"><span class="h_l' . $css . '---h_l">' . $name . '</span></'. $heading_tag .'>';
                $hr_mu .= $r_hr_content;
            $hr_mu .= '</div>';
        $hr_mu .= '</div>';
        
        //------------ Footer Markup
        $fr_mu = '';
        $fr_mu .= '<div class="fr ' . $css . '---fr">';
            $fr_mu .= '<div class="fr_cr' . $css . '---fr_cr">';
                $fr_mu .= $r_fr_content;
            $fr_mu .= '</div>';
        $fr_mu .= '</div>';
        
        //------------ Default Output
        if ( ! in_array( $r_sub_type, $sub_type_header_term_variations, true ) ) {
        
            $output .= '<' . $cp_tag . ' ' . $attr_id . 'class="' . $cp_type_css . $cp_css . $cp_dynamic_css . '" data-name="' . $name . '">';
            $output .= '<div class="cr' . $css . '---cr">';

            // Header
            $output .= $hr_mu;

            // Content
            $output .= '<div class="ct' . $css . '---ct">';
            $output .= '<div class="ct_cr' . $css . '---ct_cr">';
            $output .= $r_content;
            $output .= '</div>';
            $output .= '</div>';
            
            // Footer
            if ( ! empty( $r_fr_content ) ) {
                $output .= $fr_mu;
            }

            $output .= '</div>';
            $output .= '</' . $cp_tag . '><!-- ' . $name . ' -->';
        
        //------------ Sub-Type: Header
        } elseif ( in_array( $r_sub_type, $sub_type_header_term_variations, true ) ) {
            $output .= $hr_mu;
        }
    
    }
    
    $html = apply_filters( 'htmlok_cp', $output, $args );
    
    if ( $r_echo ) {
        echo $html;
    } else {
        return $html;
    }
    
}