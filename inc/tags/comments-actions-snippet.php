<?php // Comments Actions Snippet | content.php


if ( ! function_exists( 'applicator_comments_actions_snippet' ) ) {

    function applicator_comments_actions_snippet() {
        
        $comments_population_pri_css = 'comments';
        $comment_creation_ability_pri_css = 'comment-creation';
        
        $comments_count_axn_css = 'comments-count-axn';
        $comments_count_css = 'comments-count';
        
        $comments_count_single_text = '&#49;';
        $comments_count_multi_text = '%';
        $comments_count_zero_text = '&#48;';
        
        $comments_count_num_css = 'comments-count';
        
        $comments_label_text = 'comments-label';
        
        $comment_singular_text = 'Comment';
        $comment_plural_text = 'Comments';
        
        
        // Comments Count Template Markup
        $comments_count_mu = '';
        $comments_count_mu .= '<span class="a_l %5$s---a_l">';
            $comments_count_mu .= '<span class="l %5$s---l">';
                $comments_count_mu .= '<span class="txt num %3$s---txt">';
                    $comments_count_mu .= '%1$s';
                $comments_count_mu .= '</span>';
                $comments_count_mu .= ' <span class="txt %6$s---txt %4$s---txt">';
                    $comments_count_mu .= '%2$s';
                $comments_count_mu .= '</span>';
            $comments_count_mu .= '</span>';
        $comments_count_mu .= '</span>';
        
        
        // Comments Count Zero Template Markup
        $comments_count_zero_mu = '';
        $comments_count_zero_mu .= '<span class="txt num %3$s---txt">';
            $comments_count_zero_mu .= '%1$s';
        $comments_count_zero_mu .= '</span>';
        $comments_count_zero_mu .= ' <span class="txt %5$s---txt %4$s---txt">';
            $comments_count_zero_mu .= '%2$s';
        $comments_count_zero_mu .= '</span>';
        
        
        // Comments Count Single Text
        $comments_count_single_txt = sprintf( $comments_count_mu,
            $comments_count_single_text,
            $comment_singular_text,
            $comments_count_num_css,
            sanitize_title( $comment_singular_text ),
            $comments_count_axn_css,
            $comments_label_text
        );
        
        // Comments Count Multiple Text
        $comments_count_multi_txt = sprintf( $comments_count_mu,
            $comments_count_multi_text,
            $comment_plural_text,
            $comments_count_num_css,
            sanitize_title( $comment_plural_text ),
            $comments_count_axn_css,
            $comments_label_text
        );
        
        // Comments Count Zero Text
        $comments_count_zero_txt = sprintf( $comments_count_zero_mu,
            $comments_count_zero_text,
            $comment_singular_text,
            $comments_count_num_css,
            sanitize_title( $comment_singular_text ),
            $comments_label_text
        );
        
        
        $comments_count_int = (int) get_comments_number( get_the_ID() );
        
        // Comments Populated
        if ( $comments_count_int >= 1 ) {
            
            $comments_count_obj_a_link = '';
            
            // OB: Comments Popup Link
            ob_start();
            sprintf( comments_popup_link(
                // Comments Count: Zero
                '',

                // Comments Count: Single
                $comments_count_single_txt,

                // Comments Count: Multiple
                $comments_count_multi_txt,

                // Class Name for <a> (WP-Generated or WPG)
                'a'. ' '. $comments_count_axn_css. '---a',

                // Comment Creation Disabled
                ''
            ) );
            $comments_count_obj_a = ob_get_clean();
            
            $wpg_setting = true;
            
            $a_attr_setting = '';

        // Comments Empty
        } else {
            
            /* If there are no Comments, make the text a link like get_comments_popup_link(). */
            
            /* If Comments Actions Snippet is in index, use permalink. */
            if ( ! is_singular() ) {
                $comments_count_obj_a_link = esc_url( get_permalink() );
            }
            
            else {
                $comments_count_obj_a_link = '';
            }
            
            $comments_count_obj_a = $comments_count_zero_txt;
            
            $wpg_setting = false;
            
            $a_attr_setting = array(
                'a' => array(
                    'href'  => $comments_count_obj_a_link . '#comments',
                ),
            );
        
        }
        
        // R: Comments Count
        $comments_count_obj = applicator_htmlok( array(
            'name'      => 'Comments Count',
            'structure' => array(
                'type'      => 'object',
                'subtype'   => 'action item',
                'linked'    => true,
                'wpg'       => $wpg_setting,
                'attr'      => $a_attr_setting,
            ),
            'content'   => array(
                'object'    => $comments_count_obj_a,

            ),
        ) );
        
        // R: Comments Population
        $comments_population_cp = applicator_htmlok( array(
            'name'      => 'Comments Population',
            'structure' => array(
                'type'      => 'component',
            ),
            'content'   => array(
                'component' => $comments_count_obj,
            ),
        ) );
        
        
        // Comment Creation Enabled
        if ( comments_open() ) {
            
            $respond_hash = '#respond';
            $comment_hash = '#comment';

            // Add Comment Action Anchor Href
            if ( ! is_user_logged_in() && get_option( 'comment_registration' ) )
            {   
                $add_comment_axn_a_href = esc_url( wp_login_url( get_permalink(). $comment_hash ) );
            }
            else
            {
                if ( is_singular() )
                {
                    $add_comment_axn_a_href = $comment_hash;
                }
                else
                {
                    $add_comment_axn_a_href = esc_url( get_permalink(). $comment_hash );
                }
            }
                
            // R: Add Comment
            $add_comment_axn_obj = applicator_htmlok( array(
                'name'      => 'Add Comment',
                'structure' => array(
                    'type'      => 'object',
                    'subtype'   => 'action item',
                    'linked'    => true,
                    'attr'      => array(
                        'a'         => array(
                            'href'      => $add_comment_axn_a_href,
                            'title'     => esc_html__( 'Add Comment', 'applicator' ),
                        ),
                    ),
                ),
                'css'       => 'add-com',
                'content'   => array(
                    'object'    => array(
                        array(
                            'txt' => esc_html__( 'Add', 'applicator' ),
                        ),
                        array(
                            'sep' => ' ',
                            'txt' => esc_html__( 'Comment', 'applicator' ),
                        ),
                    ),
                    'before'    => ' ',
                ),
            ) );

            
            if ( ! is_user_logged_in() && get_option( 'comment_registration' ) ) {
                
                // R: Sign In Required
                $sign_in_required_label_obj = applicator_htmlok( array(
                    'name'      => 'Sign In Required',
                    'structure' => array(
                        'type'      => 'object',
                        'subtype'   => 'note',
                        'layout'    => 'inline',
                    ),
                    'content'   => array(
                        'object'    => esc_html__( '(requires Sign In)', 'applicator' ),
                        'before'    => ' ',
                        
                    ),
                ) );
            
            } else {
                $sign_in_required_label_obj = '';
            }

            $comment_creation_content = $add_comment_axn_obj. $sign_in_required_label_obj;

        // Comment Creation Disabled
        } else {
        
            // R: Commenting Disabled Note
            $commenting_disabled_note_obj = applicator_htmlok( array(
                'name'      => 'Commenting Disabled',
                'structure' => array(
                    'type'      => 'object',
                    'subtype'   => 'note',
                ),
                'content'   => array(
                    'object' => '<p>' . esc_html__( 'Commenting is disabled.', 'applicator' ) . '</p>',
                ),
            ) );
            
            $comment_creation_content = $commenting_disabled_note_obj;
            
        }
        
        
        // R: Comment Creation
        $comment_creation_cp = applicator_htmlok( array(
            'name'      => 'Comment Creation',
            'structure' => array(
                'type'      => 'component',
            ),
            'css'       => 'comment-crt',
            'content'   => array(
                'component' => $comment_creation_content,
            ),
        ) );
        
        
        /*
        We have two statuses of Comments Population: Populated and Empty.
        Under Populated: Single and Multi.
        Under Empty: Zero
        */
        // Comments Population Status Class Names
        $comments_population_populated_css = 'populated';
        $comments_population_populated_single_css = 'single';
        $comments_population_populated_multiple_css = 'multiple';
        
        $comments_population_empty_css = 'empty';
        $comments_population_empty_zero_css = 'zero';
        
        // Comment Creation Ability Status Class Names
        $comment_creation_ability_enabled_css = 'enabled';
        $comment_creation_ability_disabled_css = 'disabled';
        
        
        // Conditionals for Comments Population Class Names
        if ( $comments_count_int == 1 ) {
            
            $comments_population_status_css = $comments_population_pri_css . '--' . $comments_population_populated_css . ' ' . $comments_population_pri_css . '--' . $comments_population_populated_css . '--' . $comments_population_populated_single_css;
        
        } elseif ( $comments_count_int > 1 ) {
            
            $comments_population_status_css = $comments_population_pri_css . '--' . $comments_population_populated_css . ' ' . $comments_population_pri_css . '--' . $comments_population_populated_css . '--' . $comments_population_populated_multiple_css;
        
        } elseif ( $comments_count_int == 0 ) {
            
            $comments_population_status_css = $comments_population_pri_css . '--' . $comments_population_empty_css . ' ' . $comments_population_pri_css . '--' . $comments_population_empty_css . '--' . $comments_population_empty_zero_css;
        }
        
        /* Conditionals for Comment Creation Ability Class Names */
        if ( comments_open() ) {
            $comment_creation_ability_status_css = $comment_creation_ability_pri_css . '--' . $comment_creation_ability_enabled_css;
        } else {
            $comment_creation_ability_status_css = $comment_creation_ability_pri_css . '--' . $comment_creation_ability_disabled_css;
        }
        
        
        // R: Comments Actions Snippet
        $comments_actions_snippet_cp = applicator_htmlok( array(
            'name'      => 'Comments Actions Snippet',
            'structure' => array(
                'type'      => 'component',
            ),
            'root_css'  => $comments_population_status_css. ' '. $comment_creation_ability_status_css,
            'css'       => 'comments-axns-snip',
            'content'   => array(
                'component' => array(
                    $comments_population_cp,
                    $comment_creation_cp,
                ),
            ),
        ) );
        
        return $comments_actions_snippet_cp;
    }

}