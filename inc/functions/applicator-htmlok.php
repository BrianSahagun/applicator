<?php // Applicator HTML_OK (Overkill) Constructor-Component Structure

function htmlok( $args = array() ) {
    
    //------------ Requirements
    
    // Require Array
	if ( empty( $args ) ) {
		esc_html_e( 'Please define default parameters in the form of an array.', $GLOBALS['applicator_td'] );
	}
    
    // Require Name
	if ( empty( $args['name'] ) ) {
        esc_html_e( 'Name is required.', $GLOBALS['applicator_td'] );
	}
    
    //------------ Defaults
    
    $defaults = array(
        'name'          => '', // Name: Used in data-name="" and generating the parent-level CSS class name
        'root_css'      => '', // There's a generated parent css based on the 'name' and one can also add a custom
        'css'           => '', // This is a custom CSS that will apply to all structure elements
        'id'            => '', // Parent ID Attribute
        'mod'           => '', // Modifications: Special adjustments based on WordPress Generated Content
        'content'       => '', // Content
        /*
        'content'       => array(
            'Content 1',
            'Content 2',
            array(
                'form label'    => '',
                'form element'  => '',
            ),
        ),
        */
        'hr_content'    => '', // Header Content
        'fr_content'    => '', // Footer Content
        'obj_content'   => '',
        /*
        'obj_content'   => array(
            array(
                'txt'           => '',
                'form_label'    => '',
                'css'           => '',
                'sep'           => '',
                'line'          => array(
                    array(
                        array(
                            'txt'   => '',
                            'css'   => '',
                            'sep'   => '',
                        ),
                        'css'   => '',
                    ),
                ),
            ),
        ),
        */
        'structure'    => array(
            'type'      => '', // Constructor[Web Product, Web Product Start, Main Header, Main Content, Main Footer, Web Product End, Aside] | Module | Component[Generic, Navigation, Actions, Controls] | Object[Information, Label, Note, Form Label, Navigation Item, Action Item, Control Item]
            'subtype'       => '', // For Objects with specific subtypes like Heading | Navigation Item | Action Item | Generic | Anchor
            'elem'          => '', //
            'h_elem'        => '',
            'layout'        => '', // For Objects
            'hr_structure'  => false, //
            'attr'          => array(
                'title'     => '',
                'role'      => '', // Parent Role Attribute - required for main header, main content, main footer, <nav>, <aside>
                'datetime'  => '',
                'href'      => '',
                'h_level'   => '', // h1 | h2 | h3 | h4 | h5 | h6
                'linked'    => false,
            ),
        ),
        'mod'           => '', // Modification: Markup for special cases
        'version'       => '', // Version: to be able to supply new code in the same function
        'echo'          => false, // Echo: defaults to return
    );
    
    
    //------------ WordPress Parse Arguments
    $r = wp_parse_args( $args, $defaults );
    
    
    //------------ Regex Pattern and Replacement
    // Convert multiple spaces to single space
    $pat_space = '/\s\s+/';
    $rep_space = ' ';
    $pat_no_space = '/\s+/';
    $rep_no_space = '';
    
    
    //------------ Substring Count
    $substr_start = 0;
    $substr_end = 64;
    
    
    //------------ Term Variations
    $structure_constructor_terms = array( 'constructor', 'cn', );
    $structure_component_terms = array( 'component', 'cp', );
    $structure_object_terms = array( 'object', 'obj', );
    
    $structure_type_object_term_variations = array( 'object', 'obj', );
    
    $layout_block_terms = array( 'block', 'div', 'b', 'd', );
    $layout_inline_terms = array( 'inline', 'span', 'i', 's', );
    
    // Constructor Elements
    $structure_elem_header_term_variations = array( 'Header', 'header', 'hr', );
    $structure_elem_footer_term_variations = array( 'Footer', 'footer', 'fr', );
    $structure_elem_aside_term_variations = array( 'Aside', 'aside', 'as', );
    
    
    
    
    
    // Component Element
    $elem_nav_terms = array( 'Navigation', 'Nav', 'nav', 'n', );
    $structure_elem_form_term_variations = array( 'Form', 'form', 'f', );
    
    // Constructor Subtypes
    $subtype_fieldsets_terms = array( 'fieldsets', 'fsets', );
    
    
    
    
    
    
    $subtype_form_terms = array( 'form', 'f', );
    
    $subtype_nav_terms = array( 'navigation', 'nav', 'n', );
    
    
    
    
    
    // Constructor Subtypes
    $subtype_main_header_terms = array( 'main header', 'mh', );
    $subtype_main_content_terms = array( 'main content', 'mc', );
    $subtype_main_footer_terms = array( 'main footer', 'mf', );
    $subtype_aside_terms = array( 'aside', 'as', );
    
    
    // Component Subtypes
    $subtype_fieldset_item_terms = array( 'fieldset item', 'fs-item', );
    
    
    // Object Subtypes
    $subtype_form_label_terms = array( 'form label', 'flabel', 'fl', );
    $subtype_form_element_terms = array( 'form element', 'felem', 'fe', );
    $subtype_heading_terms = array( 'heading', 'h', );
    $subtype_wpg_terms = array( 'wordpress generated content', 'wpg', 'wp', );
    
    
    
    
    
    
    
    
    
    
    
    
    // Object Subtypes
    $structure_subtype_glabel_term_variations = array( 'Generic Label', 'generic label', 'glabel', 'gl', );
    $structure_subtype_link_term_variations = array( 'Link', 'link', );
    
    $structure_subtype_wpg_term_variations = array( 'WordPress Generated Content', 'wordpress generated content', 'wpg', );
    $structure_subtype_flabel_term_variations = array( 'Form Label', 'form label', 'flabel', 'fl', );
    $structure_subtype_felem_term_variations = array( 'Form Element', 'form element', 'felem', 'fe', );
    
    $structure_obj_elem_generic_term_variations = array( 'Generic', 'generic', 'g', );
    $structure_obj_elem_anchor_term_variations = array( 'Anchor', 'anchor', 'a', );
    $structure_obj_elem_heading_term_variations = array( 'Heading', 'heading', 'h', );
    $structure_obj_elem_label_term_variations = array( 'Label', 'label', 'l', );
    
    $mod_main_nav_term_variations = array( 'main navigation', 'main nav', );
    
    $heading_level_terms = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', );
    
    $obj_content_form_elem_input_term_variations = array( 'Input', 'input', 'i', );
    
    
    
    // Require Content
	if ( empty( $args['content'] ) && ! in_array( $args['structure']['type'], $structure_type_object_term_variations, true ) ) {
        esc_html_e( 'Content is required.', $GLOBALS['applicator_td'] );
	}
    
    
    
    //------------ Initialized Variables
    $name = '';
    
    
    $r_name = '';
    $r_structure = '';
    $r_elem = '';
    $r_obj_layout = '';
    $r_href = '';
    
    // X
    $r_subtype = '';
    
    $r_hr_structure = '';
    $sanitized_name = '';
    $structure_type = '';
    $structure_subtype = '';
    $structure_type_css = '';
    $structure_subtype_css = '';
    $structure_subtype_abbr = '';
    $css = '';
    $id_attr = '';
    $sanitized_id = '';
    $id = '';
    $role_attr = '';
    $title_attr = '';
    $sanitized_structure_type = '';
    $sanitized_structure_subtype = '';
    $structure_type_css = '';
    $structure_subtype_css = '';
    $r_structure_attr_linked = '';
    $h_level_tag = '';
    $hr_content_val = '';
    $content_val = '';
    $fr_content_val = '';
    $obj_content_val = '';
    $structure_attr_linked = '';
    $structure_elem = '';
    
    $layout_tag = 'div';
    $root_tag = $layout_tag;
    $branch_tag = $layout_tag;
    
    $structure_name = '';
    $heading_name = '';
    $structure_css = '';
    $href_attr = '';
    $for_attr = '';
    
    $href_attr = '';
    $target_attr = '';
    
    $structure_type = '';
    $structure_type_abbr = '';
    $branch_css = 'g';
    $h_level_tag = 'h2';
    
    $elem_label_tag = 'span';
    
    $name = '';
    $r_root_css = '';
    $css_val = '';
    
    $r_obj_content_txt = '';
    $sanitized_obj_content_txt = '';
    
    $txt = '';
    $txt_css = '';
    $r_obj_content_css = '';
    
    $mod = '';
    $root_tag_css = '';
    
    $r_version = '';
    $r_echo = '';
    
    $structure_subtype_name = '';
    $structure_subtype_postfix = '';
    $structure_subtype_name_postfix = '';
    $name_css = '';
    
    $p_h_elem = 'div';
    
    $o_obj_elem = '';
    
    
    $structure_object_termsx = array();
    
    
    // X
    // Output
    $o_cssx = '';
    $o_structure_namex = '';
    $o_heading_name = '';
    $o_id_attrx = '';
    $o_content = '';
    
    // Root Element by default is div
    // It can be changed depending on the Subtype of Element involved
    // In Object, it can be div or span depending on the Layout
    $p_root_elem = 'div';
    $layout_elemx = 'div';
    
    $subtype_name = '';
    
    // X
    // Processed
    $p_subtype_namex = '';
    $p_structure_name_abbrx = '';
    $p_structure_cssx = '';
    $p_id_attrx = '';
    $p_role_attrx = '';
    $p_method_attrx = '';
    $p_action_attrx = '';
    $p_subtype_cssx = '';
    
    // X
    $p_root_elem_cssx = '';
    $role_attrx = '';
    $p_attrx = '';
    
    $structure_namex = '';
    $structure_name_abbrx = '';
    $p_subtype_postfix_cssx = '';
    
    $string_sepx = '';
    $subtype_name_abbr = '';
    $p_cssx = '';
    $r_cssx = '';
    
    $o_branch_elemx = '';
    $o_branch_css = '';
    $o_branch_attrx = '';
    
    $p_root_cssx = '';
    
    
    // X
    // Defaults
    $subtype_elemx = 'div';
    
    $obj_elem = 'div';
    
    $obj_attr = '';
    $obj_layout_elem = 'div';
    
    $o_obj_content = '';
        
        
    
    // Name
    if ( ! empty( $r['name'] ) ) {
        $r_name = preg_replace( $pat_space, $rep_space, trim( $r['name'] ) );
        $name = $r_name;
        $sanitized_name = substr( sanitize_title( $r_name ), $substr_start, $substr_end );
    }
    
    // Root CSS or Custom CSS placed at the root
    if ( ! empty( $r['root_css'] ) ) {
        $r_root_css = preg_replace( $pat_space, $rep_space, trim( $r['root_css'] ) );
        $p_root_cssx = ' '.$r_root_css;
    }
    
    // CSS or Custom CSS that will apply to all elements | If blank, use Sanitized Name
    if ( ! empty( $r['css'] ) ) {
        $r_css = $r['css'];
        $r_cssx = sanitize_title( preg_replace( $pat_space, $rep_space, trim( $r['css'] ) ) );
        $css = $r_css;
    
        $css_val = '';
        foreach ( (array) $css as $val ) {
            $css_val .= preg_replace( $pat_space, $rep_space, trim( $val ) );
        }
    }
    
    
    
    
    
    
    
    
    
    
    // ID Attribute
    if ( ! empty( $r['id'] ) ) {
        $r_id = preg_replace( $pat_space, $rep_space, trim( $r['id'] ) );
        $id = $r_id;
        $sanitized_id = substr( sanitize_title( $id ), $substr_start, $substr_end );
        
        // Default
        $id_attr = ' '.'id="'.$sanitized_id.'"';
        
        // Auto
        if ( 'AUTO' == $id ) {
            $id_attr = ' '.'id="'.$sanitized_name.'"';
        }
        
        // X
        $id_attrx = 'id="'.$sanitized_id.'"';
        $p_id_attrx = ' '.$id_attrx;
    }
    
    // Mod
    if ( ! empty( $r['mod'] ) ) {
        $r_mod = strtolower( preg_replace( $pat_space, $rep_space, trim( $r['mod'] ) ) );
        $mod = $r_mod;
    }
    
    
    
    // X
    // Structure Subtype
    if ( ! empty( $r['structure']['subtype'] ) ) {
        $r_subtype = substr( strtolower( preg_replace( $pat_space, $rep_space, trim( $r['structure']['subtype'] ) ) ), $substr_start, $substr_end );
    }
    
    
    
    
    
    // Header Structure
    if ( ! empty( $r['structure']['hr_structure'] ) ) {
        $r_hr_structure = substr( preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['hr_structure'] ) ), $substr_start, $substr_end );
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // Structure Type
    if ( ! empty( $r['structure']['type'] ) ) {
        $r_structure = substr( strtolower( preg_replace( $pat_space, $rep_space, trim( $r['structure']['type'] ) ) ), $substr_start, $substr_end );
        
        //------------------------ Constructor
        if ( in_array( $r_structure, $structure_constructor_terms, true ) ) {
            
            $structure_namex = 'Constructor';
            $structure_name_abbrx = 'CN';
            
            
            //------------------------ Subtypes
            
            // Main Header Subtype
            if ( in_array( $r_subtype, $subtype_main_header_terms, true ) ) {
                
                $subtype_elemx = 'header';
                $p_role_attrx = ' '.'role="banner"';
                
            }
            
            // Main Content Subtype
            elseif ( in_array( $r_subtype, $subtype_main_content_terms, true ) ) {
                
                $subtype_elemx = 'section';
                $r_hr_structure = true;
                $p_h_elem = 'h2';
                
            }
            
            // Main Header Subtype
            elseif ( in_array( $r_subtype, $subtype_main_footer_terms, true ) ) {
                
                $subtype_name = 'Main Footer';
                $subtype_name_abbr = 'main-footer';
                
                $subtype_elemx = 'footer';
                $p_role_attrx = ' '.'role="contentinfo"';
                
            }
            
            // Aside Subtype
            elseif ( in_array( $r_subtype, $subtype_aside_terms, true ) ) {
                
                $subtype_name = 'Aside';
                $subtype_name_abbr = 'aside';
                
                $p_role_attrx = ' '.'role="complementary"';
                
                $p_subtype_namex = ' '.$subtype_name;
                $p_subtype_postfix_cssx = '-'.$subtype_name_abbr;
                
            }
        }
        
        
        //------------------------ Component
        elseif ( in_array( $r_structure, $structure_component_terms, true ) ) {
            
            $structure_namex = 'Component';
            $structure_name_abbrx = 'CP';
            
            
            //------------------------ Subtypes
            
            // Fieldset Item Subtype
            if ( in_array( $r_subtype, $subtype_fieldset_item_terms, true ) ) {
                
                $subtype_name = 'Fieldset Item';
                $subtype_name_abbr = 'fs-item';
                
                $p_subtype_namex = ' '.$subtype_name;
                $p_subtype_postfix_cssx = '-'.$subtype_name_abbr;
            
            }
            
            // Form Subtype
            elseif ( in_array( $r_subtype, $subtype_form_terms, true ) ) {
                
                $subtype_name = 'Form';
                $subtype_name_abbr = 'form';
                $subtype_elemx = 'form';
                
                $p_subtype_namex = ' '.$subtype_name;
                $p_subtype_postfix_cssx = '-'.$subtype_name_abbr;
                
            }
            
            
            // X
            // Navigation Subtype
            elseif ( in_array( $r_subtype, $subtype_nav_terms, true ) ) {
                
                //------------------------ X
                // Metadata
                $subtype_name = 'Navigation';
                $subtype_name_abbr = 'nav';
                $subtype_elemx = 'nav';
                //------------------------ X
                
                //------------------------ X
                // Processed
                $p_subtype_namex = ' '.$subtype_name;
                $p_subtype_postfix_cssx = '-'.$subtype_name_abbr;
                
                if ( empty( $r['structure']['attr']['role'] ) ) {
                    $p_role_attrx = ' '.'role="navigation"';
                }
                
            
            
            
                
                //------------------------ X
                
            }
            
        }
            
        //------------------------ Object
        elseif ( in_array( $r_structure, $structure_type_object_term_variations, true ) ) {
            
            $structure_namex = 'Object';
            $structure_name_abbrx = 'OBJ';
            
            
            // Layout
            if ( ! empty( $r['structure']['layout'] ) ) {
                $r_obj_layout = substr( strtolower( preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['layout'] ) ) ), $substr_start, $substr_end );
                
                if ( in_array( $r_obj_layout, $layout_inline_terms, true ) ) {
                    $layout_elemx = 'span';
                }
                
                $subtype_elemx = $layout_elemx;
                $obj_elem = $layout_elemx;
                $obj_layout_elem = $layout_elemx;
            }
            
            
            //------------------------ Subtypes
            
            // WordPress Generated Content Subtype
            if ( in_array( $r_subtype, $subtype_wpg_terms, true ) ) {
                
                $subtype_name = 'WordPress Generated Content';
                $subtype_name_abbr = 'wpg';
                
                $p_subtype_namex = ' '.$subtype_name;
                $p_subtype_postfix_cssx = '-'.$subtype_name_abbr;
                
            }
            
            // Heading Subtype
            elseif ( in_array( $r_subtype, $subtype_heading_terms, true ) ) {
               
                $subtype_name = 'Heading';
                $subtype_name_abbr = 'h';
                
                $p_subtype_namex = ' '.$subtype_name;
                $p_subtype_postfix_cssx = '-'.$subtype_name_abbr;
                
            }
            
            // Form Label Subtype
            elseif ( in_array( $r_subtype, $subtype_form_label_terms, true ) ) {
                
                $subtype_name = 'Form Label';
                $subtype_name_abbr = 'flabel';
                
                $obj_elem = 'label';
                
                $p_subtype_namex = ' '.$subtype_name;
                $p_subtype_postfix_cssx = '-'.$subtype_name_abbr;
                
            }
            
            // Form Element Subtype
            elseif ( in_array( $r_subtype, $subtype_form_element_terms, true ) ) {
                
                $subtype_name = 'Form Element';
                $subtype_name_abbr = 'felem';
                
                $obj_elem = 'input';
                
                $p_subtype_namex = ' '.$subtype_name;
                $p_subtype_postfix_cssx = '-'.$subtype_name_abbr;
                
            }

            // Href Attribute
            if ( ! empty( $r['structure']['attr']['href'] ) ) {
                $r_href = esc_url( preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['attr']['href'] ) ) );

                $href_attr = ' '.'href="'.$r_href.'"';
            }

            // Target Attribute
            if ( ! empty( $r['structure']['attr']['target'] ) ) {
                $r_structure_attr_target = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['attr']['target'] ) );

                // Default
                $target_attr = ' '.'target="'.$r_structure_attr_target.'"';
            }
            
            // Linked Attribute
            if ( ! empty( $r['structure']['attr']['linked'] ) ) {
                $r_structure_attr_linked = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['attr']['linked'] ) );
                $structure_attr_linked = $r_structure_attr_linked;
            }
            
            
            //------------------------ Object Subtypes
            
            // Subtype: Generic Label
            if ( in_array( $r_subtype, $structure_subtype_glabel_term_variations, true ) ) {
                $structure_subtype_name = 'Generic Label';
                $structure_subtype_abbr = 'glabel';
                $branch_css = 'g';
            }
            
            // Subtype: Link
            elseif ( in_array( $r_subtype, $structure_subtype_link_term_variations, true ) ) {
                $structure_subtype_name = 'Link';
                $structure_subtype_abbr = 'link';
            }
            
            /*
            // Subtype: Heading
            elseif ( in_array( $r_subtype, $structure_subtype_heading_term_variations, true ) ) {
                $structure_subtype_name = 'Heading';
                $structure_subtype_abbr = 'heading';
                $branch_css = 'h';
            }
            */
            
            // Subtype: WordPress Generated Content
            elseif ( in_array( $r_subtype, $structure_subtype_wpg_term_variations, true ) ) {
                $structure_subtype_name = 'WordPress Generated';
                $structure_subtype_abbr = 'wpg';
                $branch_css = $structure_subtype_abbr;
            }
            
            // Subtype: Form Label
            elseif ( in_array( $r_subtype, $structure_subtype_flabel_term_variations, true ) ) {
                $structure_subtype_name = 'Label';
                $structure_subtype_abbr = 'flabel';
                $branch_css = $structure_subtype_abbr;
            }
            
            // Subtype: Form Element
            elseif ( in_array( $r_subtype, $structure_subtype_felem_term_variations, true ) ) {
                $structure_subtype_name = 'Input';
                $structure_subtype_abbr = 'felem';
            }
            
            
            //------------------------ Object Elements
            
            // Element: Anchor Element
            if ( in_array( $r_elem, $structure_obj_elem_anchor_term_variations, true ) ) {
                $branch_tag = 'a';
                $branch_css = $branch_tag;
            }
            
            // Element: Heading Element
            elseif ( in_array( $r_elem, $structure_obj_elem_heading_term_variations, true ) ) {
                $branch_tag = $h_level_tag;
                $branch_css = 'h';

                // Heading Level Attribute
                if ( ! empty( $r['structure']['attr']['h_level'] ) ) {
                    $r_structure_attr_h_level = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['attr']['h_level'] ) );
                    $sanitized_h_level = substr( sanitize_title( $r_structure_attr_h_level ), $substr_start, $substr_end );
                    $h_level_tag = $sanitized_h_level;

                    if ( in_array( $r_structure_attr_h_level, $heading_level_terms, true ) ) {
                        $layout_tag = 'div';

                        $root_tag = $layout_tag;
                        $branch_tag = $h_level_tag;
                    }
                }
            }
            
            // Element: Label Element
            elseif ( in_array( $r_elem, $structure_obj_elem_label_term_variations, true ) ) {
                $branch_tag = 'label';
                $branch_css = $branch_tag;
            }
            
            
                
            
            
        }
            
        
    }
    
    
    
    
    
    
    
    
    
    
    
    // Structure Elem
    if ( ! empty( $r['structure']['elem'] ) ) {
        $r_elem = substr( strtolower( preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['elem'] ) ) ), $substr_start, $substr_end );
        
        $subtype_elemx = $r_elem;
        
        $obj_elem = $r_elem;
    }
    
    
    // Heading Element
    if ( ! empty( $r['structure']['h_elem'] ) ) {
        $r_h_elem = substr( sanitize_title( preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['h_elem'] ) ) ), $substr_start, $substr_end );
        
        if ( in_array( $r_h_elem, $heading_level_terms, true ) ) {
            $p_h_elem = $r_h_elem;
        }
    
    }
    
    // X
    // Structure Role
    if ( ! empty( $r['structure']['attr']['role'] ) ) {
        $r_role_attr = esc_attr( substr( preg_replace( $pat_space, $rep_space, trim( $r['structure']['attr']['role'] ) ), $substr_start, $substr_end ) );
        
        // X
        $role_attrx = 'role="'.$r_role_attr.'"';
        $p_role_attrx = ' '.$role_attrx;
        
    }
    
    // X
    // Action Attribute
    if ( ! empty( $r['structure']['attr']['action'] ) ) {
        $r_action_attr = esc_url( preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['attr']['action'] ) ) );
        
        // X
        $action_attrx = 'action="'.$r_action_attr.'"';
        $p_action_attrx = ' '.$action_attrx;
        
    }
    
    // X
    // Method Attribute
    if ( ! empty( $r['structure']['attr']['method'] ) ) {
        $r_method_attr = esc_attr( substr( sanitize_title( preg_replace( $pat_space, $rep_space, trim( $r['structure']['attr']['method'] ) ) ), $substr_start, $substr_end ) );
        
        // X
        $method_attrx = 'method="'.$r_method_attr.'"';
        $p_method_attrx = ' '.$method_attrx;
        
    }
    
    // Custom Attribute
    if ( ! empty( $r['structure']['attr']['custom'] ) ) {
        $r_custom_attr = $r['structure']['attr']['custom'];
            
        $p_attrx = ''; 
        $p_obj_attr = ''; 
        
        foreach ( ( array ) $r_custom_attr as $key => $val ) {
            
            $clean_key = '';
            $clean_val = '';
            
            $clean_key = substr( strtolower( preg_replace( $pat_no_space, $rep_no_space, trim( $key ) ) ), $substr_start, $substr_end );
            
            $clean_val = preg_replace( $pat_space, $rep_space, trim( $val ) );
            
            $p_attrx .= ' '.$clean_key.'="'.$clean_val.'"';
            
            $p_obj_attr .= ' '.$clean_key.'="'.$clean_val.'"';
        }
    }
    
    
    
    
    // Variable Definitions
    if ( empty( $r['name'] ) ) {
        $name = $structure_type;
    }

    $heading_name = $name.' '.$structure_subtype_name;





    // X - Generic Variables
    // Processed

    // Root Element


    // Root Element CSS
    $p_root_elem_cssx = $subtype_elemx;
    
    if ( $subtype_elemx == $subtype_name_abbr || 'div' == $subtype_elemx || 'span' == $subtype_elemx ) {
        $p_root_elem_cssx = '';
        $string_sep = '';
    } else {
        $string_sep = ' ';
    }

    // Structure CSS
    $p_structure_cssx = $string_sep. strtolower( $structure_name_abbrx );

    // Subtype
    $p_subtype_cssx = ' '.$subtype_name_abbr;


    // Name
    $p_name = $r_name;

    // Structure Name
    $p_structure_name_abbrx = ' '.$structure_name_abbrx;

    // Name CSS
    $p_name_cssx = ' '.$sanitized_name. $p_subtype_postfix_cssx;

    // Root CSS
    if ( ! empty( $r['css'] ) ) {
        $p_cssx = ' ' .$r_cssx .$p_subtype_postfix_cssx;
    }

    // Branch CSS
    if ( ! empty( $r['css'] ) ) {
        $p_branch_name_cssx = ' '.$r_cssx. $p_subtype_postfix_cssx;
    } else {
        $p_branch_name_cssx = ' '.$sanitized_name. $p_subtype_postfix_cssx;
    }


    


    // All class names in root
    // class="nav cp main-nav custom-css-nav custom-root-css"
    $o_cssx = $p_root_elem_cssx. $p_structure_cssx. $p_subtype_cssx. $p_name_cssx. $p_cssx. $p_root_cssx;

    // Displayed in data-name
    $o_structure_namex = $p_name. $p_subtype_namex. $p_structure_name_abbrx;

    // Displayed in headings
    $o_heading_name = esc_html__( $p_name. $p_subtype_namex, $GLOBALS['applicator_td'] );

    $o_h_elem = $p_h_elem;

    $o_id_attrx = $p_id_attrx;

    $o_attrx = $p_attrx;

    $o_branch_css = $p_branch_name_cssx;
    
    
    
    
    
    
    
    
    
    
    /*
    $o_root_elemx = '';
    $o_id_attrx = '';
    $o_cssx = '';
    $o_attrx = '';
    $o_custom_attr = '';
    $o_structure_namex = '';
    */
    
    // Processed
    $p_root_elem = $subtype_elemx;
    
    // Output
    $o_root_elemx = $p_root_elem;
    
    
    
    $p_obj_elem = $obj_elem;
    $p_obj_attr = $obj_attr;
    $p_obj_layout_elem = $obj_layout_elem;
    
    $o_obj_elem = $p_obj_elem;
    $o_obj_attr = $p_obj_attr;
    $o_obj_layout_elem = $p_obj_layout_elem;
    
    
    
    
    
    // Structure Title
    if ( ! empty( $r['structure']['attr']['title'] ) ) {
        $r_structure_attr_title = preg_replace( $pat_space, $rep_space, trim( $r['structure']['attr']['title'] ) );
        
        // Default
        $title_attr = ' '.'title="'.$r_structure_attr_title.'"';
        
        // Auto
        if ( 'AUTO' == $r_structure_attr_title ) {
            $title_attr = ' '.'title="'.$structure_name.'"';
        }
    }
    
    
    // Version
    if ( ! empty( $r['version'] ) ) {
        $r_version = preg_replace( $pat_space, $rep_space, trim( $r['version'] ) );
    }
    
    
    // Echo
    if ( ! empty( $r['echo'] ) ) {
        $r_echo = preg_replace( $pat_space, $rep_space, trim( $r['echo'] ) );
    }
    
    
    //------------------------ Header Content
    if ( $r['hr_content'] ) {
        $r_hr_content = $r['hr_content'];
        
        $hr_content_val = '';
        foreach ( ( array ) $r_hr_content as $val ) {
            $hr_content_val .= preg_replace( $pat_space, $rep_space, trim( $val ) );
        }
    }
    
    //------------------------ Footer Content
    if ( ! empty( $r['fr_content'] ) ) {
        $r_fr_content = $r['fr_content'];
        
        $fr_content_val = '';
        foreach ( ( array ) $r_fr_content as $val ) {
            $fr_content_val .= preg_replace( $pat_space, $rep_space, trim( $val ) );
        }
    }
    
    //------------------------ Content
    if ( ! empty( $r['content'] ) ) {
        $r_content = $r['content'];
        
        $content_val = '';
        foreach ( ( array ) $r_content as $val ) {
            $content_val .= preg_replace( $pat_space, $rep_space, trim( $val ) );
        }
    }
    
    
    
    //------------------------ Object Content
    if ( ! empty( $r['obj_content'] ) ) {
        $r_obj_content = $r['obj_content'];
        
        $obj_content_val = '';
        foreach ( ( array ) $r_obj_content as $val ) {
                
            $txt = '';
            $txt_auto_css = '';
            $txt_css = '';
            $txt_sep = '';
            $obj_content_val = '';
            
                
            // Array Input: CSS
            if ( ! empty( $val['css'] ) ) {
                $r_obj_content_css = preg_replace( $pat_space, $rep_space, trim( $val['css'] ) );
            }
            
            // Array Input: Text Content
            if ( ! empty( $val['txt'] ) ) {
                $r_obj_content_txt = preg_replace( $pat_space, $rep_space, trim( $val['txt'] ) );
                $sanitized_txt = substr( sanitize_title( $r_obj_content_txt ), $substr_start, $substr_end );
                
                $txt = $r_obj_content_txt;
                $txt_auto_css = ' '.$sanitized_txt.'---txt';
                
                // If Text Content is numeric
                if ( is_numeric( $r_obj_content_txt[0] ) ) {
                    $txt_auto_css = ' '.'num'.' '.'n-'.$sanitized_txt.'---txt';
                }
                
                // Array Input: CSS
                if ( ! empty( $val['css'] ) ) {
                    $txt_css = ' '.$r_obj_content_css.'---txt';
                }
                
                // Array Input: Separator
                if ( ! empty( $val['sep'] ) ) {
                    $r_obj_content_sep = preg_replace( $pat_space, $rep_space, $val['sep'] );
                    $obj_content_sep = $r_obj_content_sep;
                    $txt_sep = $obj_content_sep;
                }
                
                // For Attribute
                if ( ! empty( $r['structure']['attr']['for'] ) ) {
                    $r_structure_attr_for = preg_replace( $pat_space, $rep_space, trim( $r['structure']['attr']['for'] ) );
                    $structure_attr_for = $r_structure_attr_for;

                    $for_attr = ' '.'for="'.$structure_attr_for.'"';
                }
                
                $obj_content_val .= $txt_sep.'<span class="txt'.$txt_css.$txt_auto_css.'">'.$txt.'</span>';
                
                if ( ! empty( $val['line'] ) ) {
                    
                    $r_obj_content_line = $val['line'];
                    $obj_content_line = $r_obj_content_line;
                    
                    foreach ( (array) $val['line'] as $line_val ) {
                        
                        $line_val_css = '';
                        $line_val_auto_css = '';
                        
                        if ( ! empty( $line_val[0]['txt'] ) ) {
                            $r_line_val_txt = preg_replace( $pat_space, $rep_space, trim( $line_val[0]['txt'] ) );
                            $line_val_txt = $r_line_val_txt;
                            $sanitized_line_val_txt = substr( sanitize_title( $line_val_txt ), $substr_start, $substr_end );
                            
                            $line_val_auto_css = ' ' . $sanitized_line_val_txt.'---line';
                            
                            if ( is_numeric( $line_val_txt[0] ) ) {
                                $line_val_auto_css = ' '.'n-'.$sanitized_line_val_txt.'---line';
                            }
                            
                            if ( ! empty( $line_val['css'] ) ) {
                                $r_line_val_css = preg_replace( $pat_space, $rep_space, trim( $line_val['css'] ) );
                                $line_val_css = ' '.$r_line_val_css;
                            }
                        }

                        $obj_content_val .= '<span class="line'.$line_val_css.$line_val_auto_css.'">';
                        
                        foreach ( (array) $line_val as $line_txt_val ) {
                        
                            $txt = '';
                            $txt_auto_css = '';
                            $txt_css = '';
                            $txt_sep = '';

                            // Array Input: Text Content
                            if ( ! empty( $line_txt_val['txt'] ) ) {
                                $r_obj_content_line_txt = preg_replace( $pat_space, $rep_space, trim( $line_txt_val['txt'] ) );
                                $obj_content_line_txt = $r_obj_content_line_txt;
                                $sanitized_line_txt = substr( sanitize_title( $obj_content_line_txt ), $substr_start, $substr_end );

                                $txt = $obj_content_line_txt;
                                $txt_auto_css = ' '.$sanitized_line_txt.'---txt';

                                // If Text Content is numeric
                                if ( is_numeric( $obj_content_line_txt[0] ) ) {
                                    $txt_auto_css = ' '.'num'.' '.'n-'.$sanitized_line_txt.'---txt';
                                }

                                // Array Input: CSS
                                if ( ! empty( $line_txt_val['css'] ) ) {
                                    $r_obj_content_line_css = preg_replace( $pat_space, $rep_space, trim( $line_txt_val['css'] ) );
                                    $obj_content_line_css = $r_obj_content_line_css;
                                    $txt_css = ' '.$obj_content_line_css;
                                }

                                // Array Input: Separator
                                if ( ! empty( $line_txt_val['sep'] ) ) {
                                    $r_obj_content_line_sep = preg_replace( $pat_space, $rep_space, $line_txt_val['sep'] );
                                    $obj_content_line_sep = $r_obj_content_line_sep;
                                    $txt_sep = $obj_content_line_sep;
                                }

                                $obj_content_val .= $txt_sep.'<span class="txt'.$txt_auto_css.$txt_css.'">'.$txt.'</span>';

                            }
                            
                        }
                        
                        $obj_content_val .= '</span>';
                    }
                }
            }
            
            elseif ( ! empty( $val['form_elem'] ) ) {
                $r_obj_content_felem = preg_replace( $pat_space, $rep_space, trim( $val['form_elem'] ) );
                $obj_content_felem = $r_obj_content_felem;
                
                if ( in_array( $obj_content_felem, $obj_content_form_elem_input_term_variations, true ) ) {
                    
                    $form_elem_id = '';
                    $form_elem_css = '';
                    $form_elem_name = '';
                    $form_elem_placeholder = '';
                    $form_elem_value = '';
                    $form_elem_type = '';
                    $form_elem_required = '';
                    
                    // Array Input: ID
                    if ( ! empty( $val['id'] ) ) {
                        $r_obj_content_id = preg_replace( $pat_space, $rep_space, trim( $val['id'] ) );
                        $obj_content_id = $r_obj_content_id;
                        $form_elem_id = ' '.'id="'.$obj_content_id.'"';
                    }
                    
                    // Array Input: CSS
                    if ( ! empty( $val['css'] ) ) {
                        $r_obj_content_css = preg_replace( $pat_space, $rep_space, trim( $val['css'] ) );
                        $r_obj_content_css = $r_obj_content_css;
                    }
                    
                    // Name Attribute
                    if ( ! empty( $val['attr']['name'] ) ) {
                        $r_form_elem_attr_name = preg_replace( $pat_space, $rep_space, trim( $val['attr']['name'] ) );
                        $form_elem_attr_name = $r_form_elem_attr_name;

                        $form_elem_name = ' '.'name="'.$form_elem_attr_name.'"';
                    }
                    
                    // Type Attribute
                    if ( ! empty( $val['attr']['type'] ) ) {
                        $r_form_elem_attr_type = preg_replace( $pat_space, $rep_space, trim( $val['attr']['type'] ) );
                        $form_elem_attr_type = $r_form_elem_attr_type;
                        
                        $sanitized_form_elem_attr_type = sanitize_title( $form_elem_attr_type );

                        $form_elem_type = ' '.'type="'.$sanitized_form_elem_attr_type.'"';
                    }
                    
                    // Placeholder Attribute
                    if ( ! empty( $val['attr']['placeholder'] ) ) {
                        $r_form_elem_attr_placeholder = preg_replace( $pat_space, $rep_space, trim( $val['attr']['placeholder'] ) );
                        $form_elem_attr_placeholder = $r_form_elem_attr_placeholder;

                        $form_elem_placeholder = ' '.'placeholder="'.$form_elem_attr_placeholder.'"';
                    }
                    
                    // Value Attribute
                    if ( ! empty( $val['attr']['value'] ) ) {
                        $r_form_elem_attr_value = preg_replace( $pat_space, $rep_space, trim( $val['attr']['value'] ) );
                        $form_elem_attr_value = $r_form_elem_attr_value;

                        $form_elem_value = ' '.'value="'.$form_elem_attr_value.'"';
                    }
                    
                    // Required Attribute
                    if ( ! empty( $val['attr']['required'] ) ) {
                        $r_form_elem_attr_required = preg_replace( $pat_space, $rep_space, trim( $val['attr']['required'] ) );
                        $form_elem_attr_required = $r_form_elem_attr_required;

                        if ( $form_elem_attr_required ) {
                            $form_elem_required = ' '.'required';
                        }
                    }
                    
                    if ( ! empty( $val['css'] ) ) {
                        $form_elem_css = ' '.'input-'.$sanitized_form_elem_attr_type.' '.$r_obj_content_css.'---input-'.$sanitized_form_elem_attr_type;
                    } else {
                        $form_elem_css = ' '.'input-'.$sanitized_form_elem_attr_type.' '.$sanitized_name.'---input-'.$sanitized_form_elem_attr_type;
                    }
                    
                    $obj_content_val = '';
                    $obj_content_val .= '<input'.$form_elem_id.' class="input'.$form_elem_css.'"'.$form_elem_name .$form_elem_placeholder .$form_elem_value .$form_elem_type .$form_elem_required.'>';
                }
            }
            
            else {
                $obj_content_val = '';
                $obj_content_val .= $val;
            }
        }
    }
    
    
    
    
    //------------------------ Container Structure Markup
    
    // Generic Container Structure Markup
    $cr_start_mu = '';
    $cr_start_mu .= '<div class="%1$s'.$o_branch_css.'---%1$s">';
    $cr_start_mu .= '<div class="%1$s_cr'.$o_branch_css.'---%1$s_cr">';
    
    $cr_end_mu = '';
    $cr_end_mu .= '</div>';
    $cr_end_mu .= '</div>';
    
    // Main Nav Mod
    $main_nav_cr_start_mu = '';
    $main_nav_cr_start_mu   .= '<div class="%1$s'.$o_branch_css.'---%1$s">';
    
    $main_nav_cr_end_mu = '';
    $main_nav_cr_end_mu     .= '</div>';
    
    // Form Subtype
    $subtype_form_cr_start_mu = '';
    $subtype_form_cr_start_mu .= '<div class="grp %1$s'.$o_branch_css.'-%1$s">';
    $subtype_form_cr_start_mu .= '<div class="cr'.$o_branch_css.'-%1$s---cr">';
    
    $subtype_form_cr_end_mu = '';
    $subtype_form_cr_end_mu .= '</div>';
    $subtype_form_cr_end_mu .= '</div>';
    
    
    // Object Container Markup
    $obj_cr_start_mu = '';
    $obj_cr_start_mu .= '<'.$o_obj_elem.' class="'.$o_obj_elem.' '.$o_branch_css.'---'.$o_obj_elem.'" '.$o_obj_attr.'>';
    $obj_cr_start_mu .= '<'.$o_obj_layout_elem.' class="'.$o_obj_elem.'_l'.' '.$o_branch_css.'---'.$o_obj_elem.'_l">';
    
    $obj_cr_end_mu = '';
    $obj_cr_end_mu .= '</'.$o_obj_layout_elem.'>';
    $obj_cr_end_mu .= '</'.$o_obj_elem.'>';
    
    
    $subtype_form_element_cr_start_mu = '';
    $subtype_form_element_cr_start_mu .= '<div class="ee">';
    
    $subtype_form_element_cr_end_mu = '';
    $subtype_form_element_cr_end_mu .= '</div>';
    
    
    
    
    
    
    
    //------------------------ Header Markup
    $hr_mu = '';
    $hr_mu .= sprintf( $cr_start_mu,
        'hr'
    );
    $hr_mu .= '<'.$o_h_elem.' class="h'.$o_branch_css.'---h"><span class="h_l'.$o_branch_css.'---h_l">'.$o_heading_name.'</span></'.$o_h_elem.'>';
    $hr_mu .= $hr_content_val;
    $hr_mu .= $cr_end_mu;
    
    //------------------------ Constructor, Object Content Markup
    if ( in_array( $r_structure, $structure_constructor_terms, true ) || in_array( $r_structure, $structure_object_terms, true ) ) {
        $ct_mu = '';
        $ct_mu .= $content_val;
    }
    
    //------------------------ Component Content Markup
    if ( in_array( $r_structure, $structure_component_terms, true ) || in_array( $r_subtype, $subtype_aside_terms, true ) ) {
        $ct_mu = '';
        $ct_mu .= sprintf( $cr_start_mu,
            'ct'
        );
        $ct_mu .= $content_val;
        $ct_mu .= $cr_end_mu;
    }
    
    //------------------------ Main Nav Mod Content Markup
    if ( in_array( $mod, $mod_main_nav_term_variations, true ) ) {
        $ct_mu = '';
        $ct_mu .= sprintf( $main_nav_cr_start_mu,
            'ct'
        );
        $ct_mu .= $content_val;
        $ct_mu .= $main_nav_cr_end_mu;
    }
    
    //------------------------ Form Content Markup
    if ( in_array( $r_subtype, $subtype_form_terms, true ) ) {
        $ct_mu = '';
        $ct_mu .= sprintf( $subtype_form_cr_start_mu,
            'fieldsets'
        );
        $ct_mu .= $content_val;
        $ct_mu .= $subtype_form_cr_end_mu;
    }
    
    //------------------------ Basic Object Content Markup
    if ( in_array( $r_structure, $structure_object_terms, true ) ) {
        $obj_ct_mu = '';
        $obj_ct_mu .= $obj_cr_start_mu;
        $obj_ct_mu .= $obj_content_val;
        $obj_ct_mu .= $obj_cr_end_mu;
    }
    
    //------------------------ Form Element
    if ( in_array( $r_subtype, $structure_subtype_felem_term_variations, true ) ) {
        $obj_ct_mu = '';
        $obj_ct_mu .= $subtype_form_element_cr_start_mu;
        $obj_ct_mu .= $obj_content_val;
        $obj_ct_mu .= $subtype_form_element_cr_end_mu;
    }

    //------------------------ Footer Markup
    $fr_mu = '';
    $fr_mu .= sprintf( $cr_start_mu,
        'fr'
    );
    $fr_mu .= $fr_content_val;
    $fr_mu .= $cr_end_mu;
    
    
    
    if ( ! empty( $r['content'] ) ) {
        $ct_mu = $ct_mu;
    } else {
        $ct_mu = '';
    }
    
    if ( ! empty( $r['fr_content'] ) ) {
        $fr_mu = $fr_mu;
    } else {
        $fr_mu = '';
    }
    
    if ( ! empty( $r['obj_content'] ) ) {
        $obj_ct_mu = $obj_ct_mu;
    } else {
        $obj_ct_mu = '';
    }
    
    
    
    //------------------------ Content Output
    if ( in_array( $r_structure, $structure_constructor_terms, true ) || in_array( $r_subtype, $subtype_form_terms, true ) ) {
        
        if ( $r_hr_structure ) {
            $hr_mu = $hr_mu;
        } else {
            $hr_mu = '';
        }
        
        $o_content = $hr_mu. $ct_mu. $fr_mu;
    }
    
    if ( in_array( $r_structure, $structure_component_terms, true ) ) {
        $o_content = $hr_mu. $ct_mu. $fr_mu;
    }
    
    if ( in_array( $r_structure, $structure_object_terms, true ) ) {
        $o_obj_content = $obj_ct_mu;
    }
    
    
    
    
    
    
    
    
    
    //------------ New Version
    if ( '0.1' == $r_version ) {
        
        // Initialize
        $output = '';
    
    //------------ Original Version    
    } else {
        
        // Initialize
        $output = '';
        
        $output .= '<'.$o_root_elemx .$o_id_attrx.' class="'.$o_cssx.'"'.$o_attrx.' data-name="'.$o_structure_namex.'">';
        
        /*
        $output .= '<'.$root_tag.$id_attr.' class="'.$root_tag_css.$structure_type_css.$structure_subtype_css.$name_css.$css.$root_css.'" '.$role_attr.$title_attr.' data-name="'.$structure_name.'">';
        */
        
        
        //------------------------ Constructor, Component Structure
        if ( in_array( $r_structure, $structure_constructor_terms, true ) || in_array( $r_structure, $structure_component_terms, true ) ) {
            
            $output .= '<div class="cr'.$o_branch_css.'---cr">';
            
            /*
            $output .= '<'.$branch_tag.' class="cr'.$css.'---cr" '.$href_attr.'>';
            */
            
            /*
            // Header Content
            if ( ! in_array( $r_structure, $structure_constructor_terms, true ) || $r_hr_structure || in_array( $r_elem, $elem_nav_terms, true ) || in_array( $r_subtype, $subtype_fieldset_item_terms, true ) ) {
                $output .= $hr_mu;
            }
            
            // Main Content
            if ( ! empty( $content ) ) {
                $output .= $ct_mu;
            }
            
            // Footer Content
            if ( ! empty( $fr_content ) ) {
                $output .= $fr_mu;
            }
            */
            
            // Content Output
            $output .= $o_content;
            
            /*
            $output .= '</'.$branch_tag.'>';
            */
            
            $output .= '</div>';
            
        }
        
        //------------------------ Object Structure
        elseif ( in_array( $r_structure, $structure_object_termsx, true ) ) {
            
            if ( ! in_array( $r_subtype, $structure_subtype_wpg_term_variations, true ) ) {
            
                // Anchor Markup
                $a_mu = '';
                $a_mu .= '<a class="a'.$css.'---a" '.$href_attr.$target_attr.'>';
                $a_mu .= '<span class="a_l'.$css.'---a_l">';
                $a_mu .= $obj_content_val;
                $a_mu .= '</span>';
                $a_mu .= '</a>';

                if ( ! in_array( $r_subtype, $structure_subtype_link_term_variations, true ) ) {
                    $output .= '<'.$branch_tag.' class="'.$branch_css.$css.'---'.$branch_css.'"'.$for_attr.'>';
                }

                if ( $structure_attr_linked || in_array( $r_subtype, $structure_subtype_link_term_variations, true ) ) {
                    $output .= $a_mu;
                } else {
                    
                    if ( ! in_array( $r_subtype, $structure_subtype_felem_term_variations, true ) ) {
                        $output .= '<'.$elem_label_tag.' class="'.$branch_css.'l'.$css.'---'.$branch_css.'_l">';
                    }

                    // Text Content
                    if ( ! empty( $obj_content ) ) {
                        $output .= $obj_content_val;
                    }

                    $output .= '</'.$elem_label_tag.'>';
                }

                if ( !in_array( $r_subtype, $structure_subtype_link_term_variations, true ) ) {
                    $output .= '</'.$branch_tag.'>';
                }
            }
            
            else {
                $output .= $obj_content_val;
            }
        }
        
        else {
            
            /*
            $output .= '<'.$o_obj_elem.' class="'.$o_obj_elem.' '.$o_branch_css.'---'.$o_obj_elem.'" '.$o_obj_attr.'>';
            $output .= '<'.$o_obj_layout_elem.' class="'.$o_obj_elem.'_l'.' '.$o_branch_css.'---'.$o_obj_elem.'_l">';
            $output .= $obj_content_val;
            $output .= '</'.$o_obj_layout_elem.'>';
            $output .= '</'.$o_obj_elem.'>';
            */
            
            $output .= $o_obj_content;
        }
        
        /*
        $output .= '</'.$root_tag.'><!-- '.$structure_name.' -->';
        */
        
        $output .= '</'.$o_root_elemx.'><!-- '.$o_structure_namex.' -->';
    
    }
    
    $html = apply_filters( 'htmlok', $output, $args );
    
    if ( $r_echo ) {
        echo $html;
    } else {
        return $html;
    }
    
}