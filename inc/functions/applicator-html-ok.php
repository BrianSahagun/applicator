<?php // Applicator HTML OK (Overkill)

/*
Applicator HTML OK utilizes a particular HTML markup structure that builds Elements needed in the Interface.

CN: Constructor
MCO: Module - Component - Object
E: Element
T: Text

*/

/*
References:
https://developer.wordpress.org/reference/functions/wp_list_categories/
https://codex.wordpress.org/Function_Reference/wp_parse_args
https://developer.wordpress.org/reference/functions/apply_filters/
https://nacin.com/2010/05/11/in-wordpress-prefix-everything/
https://codex.wordpress.org/Function_Reference/sanitize_title

/**
 * Return Applicator HTML markup.
 *
 * @param array $args {
 *     Parameters needed to display HTML markup.
 *
 *     @type string $type       Module | Component | Object
 *     @type string $layout     Block | Inline
 *     @type string $name       Element Name
 *     @type string $css    Primary CSS Class Name
 *     @type string $sec_css    Secondary CSS Class Name
 *     @type string $content    Markup Content
 *     @type string $title      Title Attribute (title="")
 *     @type string $content    Actual Content
 *     @type string $version    For Updates
 *     @type string $echo       Echo or Return
 * }
 * @return string HTML markup.
 */

function htmlok_cn( $args = array() ) {
    
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
    
    $defaults = array(
        'elem'      => '', // header | main | footer | aside
        'name'      => '',
        'cn_css'    => '',
        'css'       => '',
        'content'   => '',
        'echo'      => false,
    );
    
    $r = wp_parse_args( $args, $defaults );
    
    // Variables
    $r_elem = $r['elem'];
    $r_name = $r['name'];
    $r_cn_css = $r['cn_css'];
    $r_css = $r['css'];
    $r_content = $r['content'];
    $r_echo = $r['echo'];
    
    // Initialize Trimmed Keys
    $trimmed_name = '';
    $sanitized_name = '';
    $trimmed_cn_css = '';
    $trimmed_css = '';
    $trimmed_content = '';
    
    // Initialize Keys
    $name = '';
    $dynamic_css = '';
    $cn_css = '';
    $css = '';
    
    // preg_replace
    $pat_trim = '/\s\s+/';
    $rep_trim = ' ';
    
    // Trimmed Keys
    $trimmed_name = preg_replace( $pat_trim, $rep_trim, trim( $r_name ) );
    $sanitized_name = sanitize_title( $trimmed_name );
    $trimmed_cn_css = preg_replace( $pat_trim, $rep_trim, trim( $r_cn_css ) );
    $trimmed_css = preg_replace( $pat_trim, $rep_trim, trim( $r_css ) );
    $trimmed_content = preg_replace( $pat_trim, $rep_trim, trim( $r_content ) );
    
    // Keys
    $name = $trimmed_name;
    $dynamic_css = ' ' . $sanitized_name;
    $cn_css = ' ' . $trimmed_cn_css;
    $css = ' ' . $trimmed_css;
    $content = $trimmed_content;
    
    if ( empty( $r_cn_css ) ) {
        $cn_css = '';
    }
    
    if ( empty( $r_css ) ) {
        $css = $dynamic_css;
    }
    
    // Output
    $output = '';
    
    $output .= '<div id="" class="cn' . $dynamic_css . $cn_css . '" data-name="' . $name . '">';
    $output .= '<div class="cr' . $css . '---cr">';
    $output .= $content;
    $output .= '</div>';
    $output .= '</div><!-- ' . $name . ' -->';
    
    // Apply Filters
    $html = apply_filters( 'htmlok_cn', $output, $args );
    
    // Echo or Return
    if ( $r_echo ) {
        echo $html;
    } else {
        return $html;
    }
    
}


function htmlok_obj( $args = array() ) {
    
    // Require Array
	if ( empty( $args ) ) {
		return esc_html_e( 'Please define default parameters in the form of an array.', $GLOBALS['applicator_td'] );
	}
    
    // Require Element
	if ( false === array_key_exists( 'elem', $args ) ) {
		return esc_html_e( 'Please define Element.', $GLOBALS['applicator_td'] );
	}
    
    // Require Content
	if ( false === array_key_exists( 'content', $args ) ) {
		return esc_html_e( 'Please define Content.', $GLOBALS['applicator_td'] );
	}
    
    $defaults = array(
        'elem'      => '', // generic | heading | time | anchor | wordpress | note | label | anchor_label | navi | list
        'name'      => '',
        'layout'    => '', // block | inline
        'obj_css'   => '',
        'elem_css'  => '',
        'css'       => '',
        'linked'    => false,
        'attr'      => array(
            'id'        => '',
            'title'     => '',
            'datetime'  => '',
            'href'      => '',
            'htag'      => '', // h1 | h2 | h3 | h4 | h5 | h6
        ),
        'content'   => '',
        'ct_before' => '',
        'ct_after'  => '',
        'version'   => '',
        'echo'      => false,
    );
    
    // Parse Arguments
    $r = wp_parse_args( $args, $defaults );
    
    $r_name = $r['name'];
    $r_layout = $r['layout'];
    $r_elem = $r['elem'];
    
    $r_obj_css = $r['obj_css'];
    $r_elem_css = $r['elem_css'];
    $r_css = $r['css'];
    
    $r_linked = $r['linked'];
    
    if ( ! empty( $r['attr']['id'] ) ) {
        $r_attr_id = $r['attr']['id'];
    }
    
    if ( ! empty( $r['attr']['title'] ) ) {
        $r_attr_title = $r['attr']['title'];
    }
    
    if ( ! empty( $r['attr']['datetime'] ) ) {
        $r_attr_datetime = $r['attr']['datetime'];
    }
    
    if ( ! empty( $r['attr']['href'] ) ) {
        $r_attr_href = $r['attr']['href'];
    }
    
    if ( ! empty( $r['attr']['htag'] ) ) {
        $r_attr_htag = $r['attr']['htag'];
    }
    
    $r_content = $r['content'];
    $r_ct_before = $r['ct_before'];
    $r_ct_after = $r['ct_after'];
    $r_version = $r['version'];
    $r_echo = $r['echo'];
    
    $name = '';
    $tag = '';
    $spacer = '';
    
    $dynamic_css = '';
    $obj_css = '';
    $elem_css = '';
    $css = '';
    $obj_type_css = '';
    
    $ct_before = '';
    $ct_after = '';
    
    $attr_title = '';
    $attr_datetime = '';
    $attr_href = '';
    $attr_htag = '';
    $attr_id = '';
    
    $layout_inline_term_variations = array( 'inline', 'i', );
    $layout_block_term_variations = array( 'block', 'b', );
    
    $heading_term_variations = array( 'heading', 'h', );
    $heading_tag_term_variations = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', );
    
    $generic_term_variations = array( 'generic', 'g', );
    $time_term_variations = array( 'time', 't', );
    $label_term_variations = array( 'label', 'l', );
    
    $list_term_variations = array( 'list', 'li', );
    
    $anchor_term_variations = array( 'anchor', 'a', );
    $navi_term_variations = array( 'nav_item', 'navi', );
    
    $anchor_label_term_variations = array( 'anchor label', 'al', );
    
    $wordpress_term_variations = array( 'wordpress', 'wp', );
    $note_term_variations = array( 'note', 'n', );
    
    $ct_before = preg_replace( '/\s\s+/', ' ', trim( $r_ct_before ) );
    $ct_after = preg_replace( '/\s\s+/', ' ', trim( $r_ct_after ) );
    
    
    // Name
    if ( ! empty( $r_name ) ) {
        $name = preg_replace( '/\s\s+/', ' ', trim( $r_name ) ) . ' ' . 'Object';
        $dynamic_css = ' ' . sanitize_title( preg_replace( '/\s\s+/', ' ', trim( $r_name ) ) ) . '-obj';
    } else {
        $name = 'Object';
        $dynamic_css = ' ' . preg_replace( '/\s\s+/', ' ', trim( $r_elem ) ) . '-obj';
    }
    
    // Layout
    if ( ! empty( $r_layout ) ) {
        if ( in_array( $r_layout, $layout_inline_term_variations, true ) ) {
            $tag = 'span';
            $spacer = ' ';

            // Heading Element is block-level
            if ( in_array( $r_elem, $heading_term_variations, true ) ) {
                $tag = 'div';
            }
        } else {
            $tag = 'div';
        }
    } else {
        $tag = 'div';
    }
    
    if ( in_array( $r_elem, $anchor_label_term_variations, true ) ) {
        $tag = 'span';
    }
    
    // Object CSS
    if ( ! empty( $r_obj_css ) ) {
        $obj_css = ' ' . preg_replace( '/\s\s+/', ' ', trim( $r_obj_css ) );
    } else {
        $obj_css = '';
    }
    
    // Element CSS
    if ( ! empty( $r_elem_css ) ) {
        $elem_css = ' ' . preg_replace( '/\s\s+/', ' ', trim( $r_elem_css ) );
    } else {
        $elem_css = '';
    }
    
    // CSS
    if ( ! empty( $r_css ) ) {
        $css = ' ' . preg_replace( '/\s\s+/', ' ', trim( $r_css ) ) . '-obj';
    } else {
        $css = $dynamic_css;
    }
    
    // id Attribute
    if ( ! empty( $r_attr_id ) ) {
        $attr_id = 'id="' . preg_replace('/\s\s+/', ' ', trim( $r_attr_id ) ) . '"';
    } else {
        $attr_id = '';
    }
    
    // title Attribute
    if ( ! empty( $r_attr_title ) ) {
        $trimmed_title_attr = preg_replace('/\s\s+/', ' ', trim( $r_attr_title ) );
        $attr_title = 'title="' . esc_attr__( $trimmed_title_attr, $GLOBALS['applicator_td'] ) . '"';
    } else {
        $attr_title = '';
    }
    
    // datetime Attribute
    if ( ! empty( $r_attr_datetime ) ) {
        $attr_datetime = 'datetime="' . preg_replace('/\s\s+/', ' ', trim( $r_attr_datetime ) ) . '"';
    } else {
        $attr_datetime = '';
    }
    
    // href Attribute
    if ( ! empty( $r_attr_href ) ) {
        $attr_href = 'href="' . preg_replace('/\s\s+/', ' ', trim( $r_attr_href ) ) . '"';
    }
    
    // htag Attribute
    if ( ! empty( $r_attr_htag ) ) {
        if ( in_array( $r_attr_htag, $heading_tag_term_variations, true ) ) {
            $attr_htag = $r_attr_htag;
        } else {
            $attr_htag = 'div';
        }
    } else {
        $attr_htag = 'div';
    }
    
    // Element: Nav Item
    if ( in_array( $r_elem, $navi_term_variations, true ) ) {
        $obj_type_css = ' ' . 'navi';
        $name = preg_replace( '/\s\s+/', ' ', trim( $r_name ) ) . ' ' . 'Nav Item';
        $dynamic_css = ' ' . sanitize_title( preg_replace( '/\s\s+/', ' ', trim( $r_name ) ) ) . '-navi';
        $css = ' ' . preg_replace( '/\s\s+/', ' ', trim( $r_css ) ) . '-navi';
        
        if ( ! empty( $r_attr_href ) ) {
            $attr_href = 'href="' . preg_replace('/\s\s+/', ' ', trim( $r_attr_href ) ) . '"';
        } else {
            $attr_href = 'href="#"';
        }
    }
    
    // Element: Note
    if ( in_array( $r_elem, $note_term_variations, true ) ) {
        $obj_type_css = ' ' . 'note';
        $name = preg_replace( '/\s\s+/', ' ', trim( $r_name ) ) . ' ' . 'Note';
        $dynamic_css = ' ' . sanitize_title( preg_replace( '/\s\s+/', ' ', trim( $r_name ) ) ) . '-note';
        $css = ' ' . preg_replace( '/\s\s+/', ' ', trim( $r_css ) ) . '-note';
    }
    
    // Element: Note
    if ( in_array( $r_elem, $list_term_variations, true ) ) {
        $tag = 'li';
        $obj_type_css = ' ' . 'item';
        // $name = preg_replace( '/\s\s+/', ' ', trim( $r_name ) ) . ' ' . 'Note';
        // $dynamic_css = ' ' . sanitize_title( preg_replace( '/\s\s+/', ' ', trim( $r_name ) ) ) . '-note';
        // $css = ' ' . preg_replace( '/\s\s+/', ' ', trim( $r_css ) ) . '-note';
    }
    
    
    // New Version
    if ( '0.1' == $r_version ) {
        
        $output = '';
    
    // Original Version
    } else {
        
        // Anchor Markup
        $anchor_mu = '<a class="a' . $css . '---a" ' . $attr_href . '>';
            $anchor_mu .= '<span class="a_l' . $css . '---a_l">';
                $anchor_mu .= $r_content;
            $anchor_mu .= '</span>';
        $anchor_mu .= '</a>';
        
        $output = '';
        
        $output .= $ct_before;
        
        if ( ! in_array( $r_elem, $anchor_label_term_variations, true ) ) {
            $output .= $spacer . '<' . $tag . ' class="obj' . $obj_type_css . $dynamic_css . $obj_css . '"' . $attr_title . ' data-name="' . $name . '">';
        }
        
        // Generic
        if ( in_array( $r_elem, $generic_term_variations, true ) ) {
            
            $output .= '<' . $tag . ' class="g' . $css . '---g' . $elem_css . '">';
            
            if ( true == $r_linked ) {
                $output .= $anchor_mu;
            } else {
                $output .= '<span class="g_l' . $css . '---g_l">';
                    $output .= $r_content;
                $output .= '</span>';
            }
            
            $output .= '</' . $tag . '>';
            
        }
        
        // Time
        if ( in_array( $r_elem, $time_term_variations, true ) ) {
            
            $output .= '<time class="time' . $css . '---time' . $elem_css . '" ' . $attr_datetime . '>';
            
            if ( true == $r_linked ) {
                $output .= $anchor_mu;
            } else {
                $output .= '<span class="time_l' . $css . '---time_l">';
                    $output .= $r_content;
                $output .= '</span>';
            }
                
            $output .= '</time>';
            
        }
        
        // Label
        if ( in_array( $r_elem, $label_term_variations, true ) ) {
            
            $output .= '<label class="label' . $css . '---label' . $elem_css . '">';
                $output .= '<span class="label_l' . $css . '---label_l">';
                    $output .= $r_content;
                $output .= '</span>';
            $output .= '</label>';
            
        }
        
        // Heading
        if ( in_array( $r_elem, $heading_term_variations, true ) ) {
            
            $output .= '<' . $attr_htag . ' class="h' . $css . '---h' . $elem_css . '">';
            
            if ( true == $r_linked ) {
                $output .= $anchor_mu;
            } else {
                $output .= '<span class="h_l' . $css . '---h_l">';
                    $output .= $r_content;
                $output .= '</span>';
            }
                
            $output .= '</' . $attr_htag . '>';
            
        }
        
        // Anchor
        if ( in_array( $r_elem, $anchor_term_variations, true ) ) {
            
            $output .= '<a ' . $attr_id . ' class="a' . $css . '---a' . $elem_css . '"' . $attr_href . '>';
                $output .= '<span class="a_l' . $css . '---a_l">';
                    $output .= $r_content;
                $output .= '</span>';
            $output .= '</a>';
            
        }
        
        // Element: Nav Item
        if ( in_array( $r_elem, $navi_term_variations, true ) ) {
            
            $output .= '<a ' . $attr_id . ' class="a' . $css . '---a' . $elem_css . '"' . $attr_href . '>';
                $output .= '<span class="a_l' . $css . '---a_l">';
                    $output .= $r_content;
                $output .= '</span>';
            $output .= '</a>';
            
        }
        
        // Anchor Label
        if ( in_array( $r_elem, $anchor_label_term_variations, true ) ) {
            
            $output .= '<span class="a_l' . $css . '---a_l">';
                $output .= $r_content;
            $output .= '</span>';
            
        }
        
        // WordPress
        if ( in_array( $r_elem, $wordpress_term_variations, true ) ) {
            $output .= $r_content;
        }
        
        // Note
        if ( in_array( $r_elem, $note_term_variations, true ) ) {
            
            $output .= '<div class="g' . $css . '---g' . $elem_css . '">';
                $output .= $r_content;
            $output .= '</div>';
            
        }
        
        // List
        if ( in_array( $r_elem, $list_term_variations, true ) ) {
            
            $output .= $r_content;
            
        }
        
        if ( ! in_array( $r_elem, $anchor_label_term_variations, true ) ) {
            $output .= '</' . $tag . '><!-- ' . $name . ' -->';
        }
        
        $output .= $ct_after;
        
    }
    
    $html = apply_filters( 'htmlok_obj', $output, $args );
    
    if ( $r_echo ) {
        echo $html;
    } else {
        return $html;
    }
}


function htmlok_txt( $args = array() ) {
    
    // Require Array
	if ( empty( $args ) ) {
		return esc_html_e( 'Please define default parameters in the form of an array.', $GLOBALS['applicator_td'] );
	}
    
    // Require Content
	if ( false === array_key_exists( 'content', $args ) ) {
		return esc_html_e( 'Please define Content.', $GLOBALS['applicator_td'] );
	}
    
    // Defaults
    $defaults = array(
        'content'   => array(
            array(
                'txt'   => '',
                'css'   => '',
                'sep'   => '',
                'line'      => array(
                    array(
                        array(
                            'sep' => '',
                            'txt' => '',
                            'css' => '',
                            'esc' => true,
                        ),
                    ),
                ),
            ),
        ),
        'version'   => '',
        'echo'      => false,
    );
    
    // Parse Arguments
    $r = wp_parse_args( $args, $defaults );
    
    $r_content = $r['content'];
    $r_version = $r['version'];
    $r_echo = $r['echo'];
    
    // Unset Variables
    $txt = '';
    $css = '';
    $sep = '';
    $num_txt_css = '';
    $dynamic_txt_css = '';
    
    // New Version
    if ( '0.1' == $r_version ) {
        
        $output = '';
    
    // Original Version
    } else {
        
        $output = '';
        
        foreach ( (array) $r_content as $val ) {
            
            $txt = '';
            $sep = '';
            $css = '';
            $num_txt_css = '';
            $dynamic_txt_css = '';
            
            $val_txt = '';
            $val_esc = '';
            
            if ( ! empty( $val['txt'] ) ) {
                $val_txt = $val['txt'];
            }
            
            if ( ! empty( $val['esc'] ) ) {
                $val_esc = $val['esc'];
            }
            
            // Text
            if ( ! empty( $val_txt ) || '0' === $val_txt ) {
                $trimmed_txt = preg_replace('/\s\s+/', ' ', trim( $val['txt'] ) );
                $txt = $trimmed_txt;
                
                if ( is_numeric( $txt ) ) {
                    
                    $num_txt_css = ' ' . 'num';
                    $dynamic_txt_css = ' ' . 'n' . '-' . sanitize_title( $txt ) . '---txt';
                
                } else {
                    
                    if ( '' == sanitize_title( $txt ) ) {
                        $dynamic_txt_css = '';
                    } else {
                        $dynamic_txt_css = ' ' . sanitize_title( $txt ) . '---txt';
                    }
                }
                
            }
            
            // CSS
            if ( ! empty( $val['css'] ) ) {
                $css = ' ' . sanitize_title( preg_replace('/\s\s+/', ' ', trim( $val['css'] ) ) ) . '---txt';
            }
            
            // Separator
            if ( ! empty( $val['sep'] ) ) {
                $sep = preg_replace('/\s\s+/', ' ', $val['sep'] );
            }
            
            // Text
            if ( empty( $val['line'] ) ) {
                
                $output .= $sep . '<span class="txt' . $num_txt_css . $css . $dynamic_txt_css . '">' . $txt . '</span>';
            
            // Lines
            } else {
                
                foreach ( (array) $val['line'] as $line_item ) {
                    
                    $line_css = '';
                    
                    if ( ! empty( $line_item[0]['txt'] ) ) {
                        $txt = preg_replace('/\s\s+/', ' ', trim( $line_item[0]['txt'] ) );
                        $line_css = ' ' . sanitize_title( $txt );
                    }
                    
                    $output .= '<span class="line' . $line_css . '---line">';
                    
                    foreach ( (array) $line_item as $line_txt_item ) {
                        
                        $sep = '';
                        $txt = '';
                        $css = '';
                        $num_txt_css = '';
                        $dynamic_txt_css = '';
                        
                        $line_txt_item_esc = '';
                        
                        if ( ! empty( $line_txt_item['esc'] ) ) {
                            $line_txt_item_esc = $line_txt_item['esc'];
                        }
                        
                        
                        if ( ! empty( $line_txt_item['sep'] ) ) {
                            $sep = preg_replace('/\s\s+/', ' ', trim( $line_txt_item['sep'] ) );
                        }
                        
                        // Text
                        if ( ! empty( $line_txt_item['txt'] ) || '0' === $line_txt_item['txt'] ) {
                            $trimmed_txt = preg_replace('/\s\s+/', ' ', trim( $line_txt_item['txt'] ) );
                            
                            // Escaping
                            if ( $line_txt_item_esc ) {
                                $txt = esc_html__( $trimmed_txt, $GLOBALS['applicator_td'] );
                            } else {
                                $txt = $trimmed_txt;
                            }
                            

                            if ( is_numeric( $txt ) ) {

                                $num_txt_css = ' ' . 'num';
                                $dynamic_txt_css = ' ' . 'n' . '-' . sanitize_title( $txt ) . '---txt';

                            } else {
                                
                                if ( '' == sanitize_title( $txt ) ) {
                                    $dynamic_txt_css = '';
                                } else {
                                    $dynamic_txt_css = ' ' . sanitize_title( $txt ) . '---txt';
                                }
                            }
                        }
                        
                        if ( ! empty( $line_txt_item['css'] ) ) {
                            $css = ' ' . preg_replace('/\s\s+/', ' ', trim( $line_txt_item['css'] ) ) . '---txt';
                        }
                    
                        $output .= $sep . '<span class="txt' . $num_txt_css . $css . $dynamic_txt_css . '">' . $txt . '</span>';

                    }
                    
                    $output .= '</span>';
                }
                
            }
            
        }
    }
    
    $html = apply_filters( 'htmlok_txt', $output, $args );
    
    if ( $r_echo ) {
        echo $html;
    } else {
        return $html;
    }
}