<?php

define( 'ACF_LITE', true );

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_dish-options',
        'title' => 'Dish Options',
        'fields' => array (
            array (
                'key' => 'field_5485936f69938',
                'label' => 'Price',
                'name' => '_lg_dish_price',
                'type' => 'number',
                'instructions' => 'Enter the price.',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '0.01',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'highgrove_dish',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_tag-options',
        'title' => 'Tag Options',
        'fields' => array (
            array (
                'key' => 'field_54c0edb763612',
                'label' => 'Icon',
                'name' => '_lg_post_tag_icon',
                'type' => 'text',
                'instructions' => 'The tag icon is used for menu filters.',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => 'fa-',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'ef_taxonomy',
                    'operator' => '==',
                    'value' => 'post_tag',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_section-options',
        'title' => 'Section Options',
        'fields' => array (
            array (
                'key' => 'field_547ca120db484',
                'label' => 'Section Style',
                'name' => '_lg_section_style',
                'type' => 'radio',
                'instructions' => 'Choose a style for the section.',
                'required' => 1,
                'choices' => array (
                    'default' => 'Default',
                    'alter' => 'Alter',
                    'primary' => 'Primary',
                    'secondary' => 'Secondary',
                    'image' => 'Image',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'default',
                'layout' => 'horizontal',
            ),
            array (
                'key' => 'field_547dbe1225774',
                'label' => 'Section Image',
                'name' => '_lg_section_image',
                'type' => 'image',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_547ca120db484',
                            'operator' => '==',
                            'value' => 'image',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'save_format' => 'id',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_547ca57d91cc7',
                'label' => 'Is It Dark?',
                'name' => '_lg_section_dark',
                'type' => 'true_false',
                'message' => 'Is the section dark?',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_547dd6dbfdcb3',
                'label' => 'Show Overlay?',
                'name' => '_lg_overlay',
                'type' => 'true_false',
                'message' => 'Show the overlay over the section?',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_547ca5afcc3ef',
                'label' => 'Section Class',
                'name' => '_lg_section_class',
                'type' => 'text',
                'instructions' => 'The class that is applied to the section element which encloses the other elements. Multiple classes can be separated with spaces.',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'highgrove_section',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 1,
    ));
    register_field_group(array (
        'id' => 'acf_container-options',
        'title' => 'Container Options',
        'fields' => array (
            array (
                'key' => 'field_549026487186b',
                'label' => 'Include Container?',
                'name' => '_lg_container',
                'type' => 'true_false',
                'message' => 'Is the container included?',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_546cbabd22aa2',
                'label' => 'Container Type',
                'name' => '_lg_container_type',
                'type' => 'radio',
                'instructions' => 'Turn a fixed-width section into a full-width section by changing your default container to fluid.',
                'required' => 1,
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_549026487186b',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'choices' => array (
                    'default' => 'Default',
                    'fluid' => 'Fluid',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'default',
                'layout' => 'horizontal',
            ),
            array (
                'key' => 'field_5470883f286d1',
                'label' => 'Container Class',
                'name' => '_lg_container_class',
                'type' => 'text',
                'instructions' => 'The class that is applied to the container element of the section. Multiple classes can be separated with spaces.',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_549026487186b',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'highgrove_section',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 2,
    ));
    register_field_group(array (
        'id' => 'acf_header-options',
        'title' => 'Header Options',
        'fields' => array (
            array (
                'key' => 'field_547ca7e7107a7',
                'label' => 'Show Header?',
                'name' => '_lg_header',
                'type' => 'true_false',
                'message' => 'Is the header visible?',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_549033cb9a1b4',
                'label' => 'Title Text',
                'name' => '_lg_title_text',
                'type' => 'text',
                'instructions' => 'Enter the title of your choice.',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_547ca7e7107a7',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_545a2afba33fb',
                'label' => 'Header Style',
                'name' => '_lg_header_style',
                'type' => 'radio',
                'instructions' => 'Choose a style for the section.',
                'required' => 1,
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_547ca7e7107a7',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'choices' => array (
                    'default' => 'Default',
                    'alter' => 'Alter',
                    'primary' => 'Primary',
                    'secondary' => 'Secondary',
                    'image' => 'Image',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'default',
                'layout' => 'horizontal',
            ),
            array (
                'key' => 'field_548aee6d5e25c',
                'label' => 'Header Image',
                'name' => '_lg_header_image',
                'type' => 'image',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_545a2afba33fb',
                            'operator' => '==',
                            'value' => 'image',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'save_format' => 'id',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_545a33c211d14',
                'label' => 'Is It Dark?',
                'name' => '_lg_header_dark',
                'type' => 'true_false',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_547ca7e7107a7',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'message' => 'Is the header dark?',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_545a26d1b6b69',
                'label' => 'Show Overlay?',
                'name' => '_lg_header_overlay',
                'type' => 'true_false',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_547ca7e7107a7',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'message' => 'Show the overlay over the section?',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_547dd0a871196',
                'label' => 'Show Break?',
                'name' => '_lg_header_break',
                'type' => 'true_false',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_547ca7e7107a7',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'message' => 'Show the break on the bottom of the header?',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_545a36791276a',
                'label' => 'Header Class',
                'name' => '_lg_header_class',
                'type' => 'text',
                'instructions' => 'The class that is applied to the header element of the post. Multiple classes can be separated with spaces.',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_547ca7e7107a7',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_545a4257833b2',
                'label' => 'Title Class',
                'name' => '_lg_title_class',
                'type' => 'text',
                'instructions' => 'The class that is applied to the title of the post. Multiple classes can be separated with spaces.',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_547ca7e7107a7',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'highgrove_section',
                    'order_no' => 0,
                    'group_no' => 1,
                ),
            ),
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'highgrove_event',
                    'order_no' => 0,
                    'group_no' => 2,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 3,
    ));
}