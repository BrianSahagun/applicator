<?php
// Template Name: Tester

?>

<style>
    
    *
    {
        box-sizing: border-box;
        max-width: 100%;
        height: auto;
    }
    
    body
    {
        margin: 0;
        font-family: sans-serif;
    }

    .cn,
    .cp,
    .obj
    {
        margin: .5rem;
        padding: .5rem;
        border: 2px solid black;
        border-radius: .25rem;
    }
    
    .cn
    {
        border-color: red;
    }
    
    .cp
    {
        border-color: green;
    }
    
    .obj
    {
        border-color: blue;
    }
    
    .cn::before,
    .cp::before,
    .obj::before
    {
        content: attr( data-name );
        display: inline-block;
        margin-left: -.5rem;
        margin-top: -.5rem;
        padding: .25rem;
        width: calc( 100% + .5rem );
        background-color: black;
        color: white;
    }
    
    .cn::before
    {
        background-color: red;
    }
    
    .cp::before
    {
        background-color: green;
    }
    
    .obj::before
    {
        background-color: blue;
    }
    
    .obj
    {
        display: inline-block;
        
    }
    
</style>

<?php

//------------------------ Web Product Main Name OBJ
$web_product_main_name_obj = htmlok( array(
    'name'      => 'Web Product Main Name',
    'structure' => array(
        'type'      => 'object',
        'elem'      => 'h1',
        'linked'    => true,
        'attr'      => array(
            'h_level'   => 'h1',
            'title'     => get_bloginfo( 'name' ),
        ),
        'a_attr'    => array(
            'href'      => 'index.html',
        ),
    ),
    'css'           => 'wbp-main-name',
    'content'   => array(
        'object'    => array(
            array(
                'txt'   => get_bloginfo( 'name' ),
                'css'   => 'wbp-name',
            ),
        ),
    ),
) );

//------------------------ Web Product Main Logo OBJ | inc > settings.php | Customizer > Site Identity
$web_product_main_logo_obj = '';

if ( has_custom_logo() ) {
    $web_product_main_logo_obj = htmlok( array(
        'name'      => 'Web Product Main Logo',
        'structure' => array(
            'type'      => 'object',
            'subtype'   => 'wordpress generated content',
            'attr'      => array(
                'title'     => get_bloginfo( 'name' ),
            ),
        ),
        'css'           => 'wbp-main-logo',
        'content'   => array(
            'object'    => array(
                get_custom_logo(),
            ),
        ),
    ) );
}

//------------------------ Web Product Main Description OBJ
$web_product_main_desc_obj = '';
$description = get_bloginfo( 'description', 'display' );

if ( $description || is_customize_preview() ) {
    $web_product_main_desc_obj = htmlok( array(
        'name'      => 'Web Product Main Description',
        'structure' => array(
            'type'      => 'object',
            'attr'      => array(
                'linked'    => true,
                'href'      => esc_url( home_url( '/' ) ),
                'title'     => $description,
            ),
        ),
        'css'           => 'wbp-main-desc',
        'obj_content'   => array(
            array(
                'txt'   => $description,
                'css'   => 'wbp-desc',
            ),
        ),
    ) );
}


//------------------------ Web Product Main Media Banner OBJ | Custom Header | Customizer > Custom Header | inc > functions > custom-header.php
$web_product_main_media_banner_obj = '';

if ( has_header_image() ) {
    $web_product_main_media_banner_obj = htmlok( array(
        'name'          => 'Web Product Main Media Banner',
        'structure'     => array(
            'type'      => 'object',
            'subtype'   => 'wordpress generated content',
        ),
        'css'           => 'wbp-main-media-banner',
        'obj_content'   => get_custom_header_markup(),
    ) );
}



//------------------------ Web Product Main Info CP
$main_product_main_info_cp = htmlok( array(
    'name'              => 'Web Product Main Info',
    'structure'         => array(
        'type'          => 'component',
        'hr_structure'  => true,
    ),
    'css'               => 'wbp-main-info',
    'content'           => array(
        'component'     => array(
            $web_product_main_name_obj,
            $web_product_main_logo_obj,
            $web_product_main_desc_obj,
        ),
    ),
) );

//------------------------ Main Header CN
$main_header_cn = htmlok( array(
    'name'              => 'Main Header',
    'structure'         => array(
        'type'          => 'constructor',
        'subtype'       => 'main header',
    ),
    'id'                => 'main-header',
    'root_css'          => 'site-header',
    'content'           => array(
        'constructor'   => array(
            $main_product_main_info_cp,
            applicator_func_main_navx(),
            applicator_hook_after_main_nav(),
<<<<<<< HEAD
<<<<<<< HEAD
            // get_search_form(),
=======
            get_search_form(),
>>>>>>> origin/master
=======
            get_search_form(),
>>>>>>> origin/master
            $web_product_main_media_banner_obj,
            applicator_func_main_header_aside(),
        ),
    ),
    'echo'              => true,
) );

$main_content_header_sub_heading_obj = htmlok( array(
    'name'              => 'Main Header Sub-Heading',
    'structure'         => array(
        'type'          => 'object',
        'subtype'       => 'wordpress generated content',
        'layout'        => 'inline',
    ),
    'obj_content'       => array(
        array(
            'txt'       => 'Entries: Post',
        ),
    ),
) );

$main_content_header_meta_cp = htmlok( array(
    'name'              => 'Main Header Meta',
    'structure'         => array(
        'type'          => 'component',
        'subtype'       => 'meta data',
    ),
    'content'           =>  array(
<<<<<<< HEAD
<<<<<<< HEAD
        'component'     => '$main_content_header_sub_heading_obj',
=======
        'component'     => $main_content_header_sub_heading_obj,
>>>>>>> origin/master
=======
        'component'     => $main_content_header_sub_heading_obj,
>>>>>>> origin/master
    ),
) );

$main_content_cn = htmlok( array(
    'name'              => 'Main Content',
    'structure'         => array(
        'type'          => 'constructor',
        'subtype'       => 'main content',
    ),
    'id'                => 'content',
    'root_css'          => 'site-content',
    'hr_content'        => $main_content_header_meta_cp,
    'content'           =>  array(
        'constructor'   => 'Super Main Content',
    ),
    'echo'              => true,
) );

$main_footer_cn = htmlok( array(
    'name'          => 'Main Footer',
    'structure'     => array(
        'type'      => 'constructor',
        'subtype'   => 'main footer',
    ),
    'id'            => 'main-footer',
    'root_css'      => 'site-footer',
    'content'       => array(
        'constructor'   => 'Footer Content',
    ),
    'echo'          => true,
) );

$main_header_aside_cn = htmlok( array(
    'name'              => 'Main Header',
    'structure'         => array(
        'type'          => 'constructor',
        'subtype'       => 'Aside',
        'elem'          => 'aside',
        'hr_structure'  => true,
        'h_elem'        => 'h2',
    ),
    'id'                => 'main-header-aside',
    'css'               => 'main-hr',
    'content'           => array(
        'constructor'   => 'Aside',
    ),
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
    'echo'              => true,
) );

$form_element_cp = htmlok( array(
    'name'              => 'Form Element Test',
    'structure'         => array(
        'type'          => 'Component',
        'subtype'       => 'Form Elements',
    ),
    'content'           => array(
        'component'     => array(
            'object'    => array(
                'name'  => '',
                'css'   => '',
                'id'    => '',
                'form_label'    => array(
                    'txt'   => 'Shet',
                ),
                'form_input'    => array(
                    'elem'      => '',
                    'id'        => '',
                    'title'     => '',
                    'attr'      => array(
                        'type'          => '',
                        'placeholder'   => '',
                        'value'         => '',
                        'maxchar'       => '',
                    ),
                ),
            ),
        ),
        
        
        
        
        
        
        
        'form_label'    => array(
            'name'      => 'Username Creation',
            'label'     => array(
                'txt'   => 'Yep she\'s gone',
                'attr'  => array(
                    'for'   => 'ID',
                ),
            ),
            'id'        => 'Object ID',
            'css'       => '',
            'title'     => 'Day',
        ),
        'form_input'         => array(
            'input'     => array(
                'elem'  => 'input',
                'attr'      => array(
                    'type'          => 'text',
                    'value'         => '',
                    'placeholder'   => '',
                ),
            ),
            'id'        => 'ID',
            'css'       => '',
            'title'     => 'Day',
        ),
    ),
    'content'           => 'Content',
>>>>>>> origin/master
    'echo'              => true,
) );

$form_element_cp = htmlok( array(
    'name'              => 'Form Element Test',
    'structure'         => array(
        'type'          => 'Component',
        'subtype'       => 'Form Elements',
    ),
    'content'           => array(
        'component'     => array(
            'object'    => array(
                'name'  => '',
                'css'   => '',
                'id'    => '',
                'form_label'    => array(
                    'txt'   => 'Shet',
                ),
                'form_input'    => array(
                    'elem'      => '',
                    'id'        => '',
                    'title'     => '',
                    'attr'      => array(
                        'type'          => '',
                        'placeholder'   => '',
                        'value'         => '',
                        'maxchar'       => '',
                    ),
                ),
            ),
        ),
        
        
        
        
        
        
        
        'form_label'    => array(
            'name'      => 'Username Creation',
            'label'     => array(
                'txt'   => 'Yep she\'s gone',
                'attr'  => array(
                    'for'   => 'ID',
                ),
            ),
            'id'        => 'Object ID',
            'css'       => '',
            'title'     => 'Day',
        ),
        'form_input'         => array(
            'input'     => array(
                'elem'  => 'input',
                'attr'      => array(
                    'type'          => 'text',
                    'value'         => '',
                    'placeholder'   => '',
                ),
            ),
            'id'        => 'ID',
            'css'       => '',
            'title'     => 'Day',
        ),
    ),
    'content'           => 'Content',
>>>>>>> origin/master
    'echo'              => true,
) );

/*
$form_element_cp = htmlok( array(
    'name'              => 'Form Element Test',
    'structure'         => array(
        'type'          => 'Component',
        'subtype'       => 'Form Elements',
    ),
    'content'           => array(
        'compound'      => array(
            'name'      => '',
            'css'       => '',
            'id'        => '',
            'form_label'    => array(
                'txt'       => 'Shet',
            ),
            'form_input'    => array(
                'elem'      => '',
                'id'        => '',
                'title'     => '',
                'attr'      => array(
                    'type'          => '',
                    'placeholder'   => '',
                    'value'         => '',
                    'maxchar'       => '',
                ),
            ),
        ),
    ),
    'echo'              => true,
) );
*/