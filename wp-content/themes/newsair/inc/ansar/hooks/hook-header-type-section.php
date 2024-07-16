<?php
if (!function_exists('newsair_header_type_section')) :
/**
 *  Header
 *
 * @since newsair
 *
 */
function newsair_header_type_section()
{
    do_action('newsair_action_side_menu_section');
    
$header_menu_layout = get_theme_mod('header_menu_layout','default');

if($header_menu_layout == 'default')
{ 
    newsair_header_default_section();
}

}
endif;
add_action('newsair_action_newsair_header_type_section', 'newsair_header_type_section', 6);