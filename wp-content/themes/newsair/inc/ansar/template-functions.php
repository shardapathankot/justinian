<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Newsair
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function newsair_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }


    $global_site_mode_setting = newsair_get_option('global_site_mode_setting');
    $classes[] = $global_site_mode_setting;


    $single_post_featured_image_view = newsair_get_option('single_post_featured_image_view');
    if ($single_post_featured_image_view == 'full') {
        $classes[] = 'ta-single-full-header';
    }

    $global_hide_post_date_author_in_list = newsair_get_option('global_hide_post_date_author_in_list');
    if ($global_hide_post_date_author_in_list == true) {
        $classes[] = 'ta-hide-date-author-in-list';
    }

    global $post;

    $global_alignment = newsair_get_option('newsair_content_layout');
    $page_layout = $global_alignment;
    $disable_class = '';
    $frontpage_content_status = newsair_get_option('frontpage_content_status');
    if (1 != $frontpage_content_status) {
        $disable_class = 'disable-default-home-content';
    }

    // Check if single.
    if ($post && is_singular()) {
        $post_options = get_post_meta($post->ID, 'newsair-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_alignment;
        }
    }


    return $classes;


}

add_filter('body_class', 'newsair_body_classes');


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function newsair_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'newsair_pingback_header');


/**
 * Returns posts.
 *
 * @since newsair 1.0.0
 */
if (!function_exists('newsair_get_posts')):
    function newsair_get_posts($number_of_posts, $category = '0', $order = '') 
    {   
        
       
        $ins_args = array(
            'post_type' => 'post',
            'posts_per_page' => absint($number_of_posts),
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'ignore_sticky_posts' => true
        );
        
        $category = isset($category) ? $category : '0';
        if (absint($category) > 0) {
            $ins_args['cat'] = absint($category);
        }

        $all_posts = new WP_Query($ins_args);

        return $all_posts;
    }

endif;


/**
 * Returns no image url.
 *
 * @since  newsair 1.0.0
 */
if (!function_exists('newsair_post_format')):
    function newsair_post_format($post_id)
    {
        $post_format = get_post_format($post_id);
        switch ($post_format) {
            case "image":
                $post_format = "<div class='af-post-format em-post-format'></div>";
                break;
            case "video":
                $post_format = "<div class='af-post-format em-post-format'></div>";

                break;
            case "gallery":
                $post_format = "<div class='af-post-format em-post-format'></div>";
                break;
            default:
                $post_format = "";
        }

        echo $post_format;
    }

endif;


if (!function_exists('newsair_get_block')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since newsair 1.0.0
     *
     */
    function newsair_get_block($block = 'grid', $section = 'post')
    {

        get_template_part('inc/ansar/hooks/blocks/block-' . $section, $block);

    }
endif;

if (!function_exists('newsair_archive_title')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since newsair 1.0.0
     *
     */

    function newsair_archive_title($title)
    {
        if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_author()) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        } elseif (is_tax()) {
            $title = single_term_title('', false);
        }

        return $title;
    }

endif;
add_filter('get_the_archive_title', 'newsair_archive_title');


/**
 * Check if given term has child terms
 *
 * @param Integer $term_id
 * @param String $taxonomy
 *
 * @return Boolean
 */
function newsair_list_popular_taxonomies($taxonomy = 'post_tag', $title = "Top Tags", $number = 5)
{
    

    $show_popular_tags_section = esc_attr(get_theme_mod('show_popular_tags_section',true));
    $show_popular_tags_title = get_theme_mod('show_popular_tags_title', esc_html('Top Tags'));
    if($show_popular_tags_section == true){
        $popular_taxonomies = get_terms(array(
            'taxonomy' => $taxonomy,
            'number' => absint($number),
            'orderby' => 'count',
            'order' => 'DESC',
            'hide_empty' => true,
        ));

        $html = '';

        if (isset($popular_taxonomies) && !empty($popular_taxonomies)):
            $html .= '<section class="mg-tpt-tag-area mb-n4"><div class="container"><div class="mg-tpt-txnlst clearfix text-xs">';
            if (!empty($title)):
                $html .= '<h6 class="mg-tpt-txnlst-title">';
                $html .= esc_html($title);
                $html .= '</h6>';
            endif;
            $html .= '<ul>';
            foreach ($popular_taxonomies as $tax_term):
                $html .= '<li>';
                $html .= '<a href="' . esc_url(get_term_link($tax_term)) . '">';
                $html .= $tax_term->name;
                $html .= '</a>';
                $html .= '</li>';
            endforeach;
            $html .= '</ul></div>';
            $html .= '</div></section>';
        endif;
        echo $html;
    }
}


/**
 * @param $post_id
 * @param string $size
 *
 * @return mixed|string
 */
function newsair_get_freatured_image_url($post_id, $size = 'newsair-featured')
{
    if (has_post_thumbnail($post_id)) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
        $url = $thumb !== false ? '' . $thumb[0] . '' : '""';

    } else {
        $url = '';
    }


    return $url;
}

if (!function_exists('newsair_categories_show')):
    function newsair_categories_show()
{ ?>
<div class="bs-blog-category"> 
        <?php   $cat_list = get_the_category_list();
        if(!empty($cat_list)) { ?>
        <?php } ?>
</div>
<?php } endif; 

if (!function_exists('newsair_archive_page_title')) :
        
        function newsair_archive_page_title($title)
        {
            if (is_category()) {
                $title = single_cat_title('', false);
            } elseif (is_tag()) {
                $title = single_tag_title('', false);
            } elseif (is_author()) {
                $title =  get_the_author();
            } elseif (is_post_type_archive()) {
                $title = post_type_archive_title('', false);
            } elseif (is_tax()) {
                $title = single_term_title('', false);
            }
            
            return $title;
        }
    
    endif;
    add_filter('get_the_archive_title', 'newsair_archive_page_title');


if (!function_exists('newsair_edit_link')) :

    function newsair_edit_link($view = 'default')
    {
        global $post;
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'newsair'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link"><i class="fas fa-edit"></i>',
                '</span>'
            );

    } 
endif;

function newsair_date_display_type() {
    // Return if date display option is not enabled
    $header_data_enable = esc_attr(get_theme_mod('header_data_enable','true'));
    $header_time_enable = esc_attr(get_theme_mod('header_time_enable','true'));
    $newsair_date_time_show_type = get_theme_mod('newsair_date_time_show_type','newsair_default');
    if($header_data_enable == true) {
    if ( $newsair_date_time_show_type == 'newsair_default' ) { ?>
        <div class="top-date ms-1">
            <span class="day">
         <?php
            echo date_i18n('D. M jS, Y ', strtotime(current_time("Y-m-d"))); ?>
            </span>
        </div>
    <?php } elseif( $newsair_date_time_show_type == 'wordpress_date_setting')
    { ?>
        <div class="top-date ms-1">
            <span class="day">
             <?php echo date_i18n( get_option( 'date_format' ) ); ?>
            </span>
        </div>
   <?php }
} }

add_filter( 'woocommerce_show_page_title', 'newsair_hide_shop_page_title' );

function newsair_hide_shop_page_title( $title ) {
    if ( is_shop() ) $title = false;
    return $title;
}

function newsair_footer_logo_size()
{
    ?>
    <style>
        footer .bs-footer-bottom-area .custom-logo{
            width:<?php echo esc_attr(get_theme_mod('desktop_newsair_footer_logo_width','210').'px'); ?>;
            height:<?php echo esc_attr(get_theme_mod('desktop_newsair_footer_logo_height','70').'px'); ?>;
        }

        @media (max-width: 991.98px)  {
            footer .bs-footer-bottom-area .custom-logo{
                width:<?php echo esc_attr(get_theme_mod('tablet_newsair_footer_logo_width','170').'px'); ?>; 
                height:<?php echo esc_attr(get_theme_mod('tablet_newsair_footer_logo_height','50').'px'); ?>;
            }
        }
        @media (max-width: 575.98px) {
            footer .bs-footer-bottom-area .custom-logo{
                width:<?php echo esc_attr(get_theme_mod('mobile_newsair_footer_logo_width','130').'px'); ?>; 
                height:<?php echo esc_attr(get_theme_mod('mobile_newsair_footer_logo_height','40').'px'); ?>;
            }
        }
    </style>
<?php } 
add_action('wp_footer','newsair_footer_logo_size');

function newsair_social_share_post($post) {

    $newsair_blog_post_icon_enable = esc_attr(get_theme_mod('newsair_blog_post_icon_enable',true));
    if($newsair_blog_post_icon_enable == true) {
    $post_link  = esc_url( get_the_permalink() );
    $post_title = get_the_title();

    $facebook_url = add_query_arg(
    array(
    'u' => $post_link,
    ),
    'https://www.facebook.com/sharer.php'
    );

    $twitter_url = add_query_arg(
    array(
    'url'  => $post_link,
    'text' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) ),
        ),
        'http://twitter.com/share'
        );

    $email_title = str_replace( '&', '%26', $post_title );

    $email_url = add_query_arg(
    array(
    'subject' => wp_strip_all_tags( $email_title ),
    'body'    => $post_link,
        ),
    'mailto:'
        ); 

    $linkedin_url = add_query_arg(
    array('url'  => $post_link,
    'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
        ),
    'https://www.linkedin.com/sharing/share-offsite/?url'
    );

    $pinterest_url = add_query_arg(
    array('url'  => $post_link,
        'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
    ),
    'http://pinterest.com/pin/create/link/?url='
    );

    $reddit_url = add_query_arg(
    array('url' => $post_link,
    'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
    ),
    'https://www.reddit.com/submit'
    );

    $telegram_url = add_query_arg(
    array('url' => $post_link,
    'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
    ),
    'https://t.me/share/url?url='
    );

    $whatsapp_url = add_query_arg(
    array('text' => $post_link,
    'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
    ),
    'https://api.whatsapp.com/send?text='
    );
            ?>
            <script>
    function pinIt()
    {
      var e = document.createElement('script');
      e.setAttribute('type','text/javascript');
      e.setAttribute('charset','UTF-8');
      e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
      document.body.appendChild(e);
    }
    </script>
    <div class="post-share">
        <div class="post-share-icons cf"> 
            <a class="facebook" href="<?php echo esc_url("$facebook_url"); ?>" class="link " target="_blank" >
                <i class="fab fa-facebook"></i>
            </a>
            <a class="x-twitter" href="<?php echo esc_url("$twitter_url"); ?>" class="link " target="_blank">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
            <a class="envelope" href="<?php echo esc_url("$email_url"); ?>" class="link " target="_blank" >
                <i class="fas fa-envelope-open"></i>
            </a>
            <a class="linkedin" href="<?php echo esc_url("$linkedin_url"); ?>" class="link " target="_blank" >
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="javascript:pinIt();" class="pinterest">
                <i class="fab fa-pinterest"></i>
            </a>
            <a class="telegram" href="<?php echo esc_url("$telegram_url"); ?>" target="_blank" >
                <i class="fab fa-telegram"></i>
            </a>
            <a class="whatsapp" href="<?php echo esc_url("$whatsapp_url"); ?>" target="_blank" >
                <i class="fab fa-whatsapp"></i>
            </a>
            <a class="reddit" href="<?php echo esc_url("$reddit_url"); ?>" target="_blank" >
                <i class="fab fa-reddit"></i>
            </a>
            <a class="print-r" href="javascript:window.print()"> 
                <i class="fas fa-print"></i>
            </a>
        </div>
    </div>

<?php } } 

function newsair_post_image_display_type($post){

    $post_image_type = get_theme_mod('post_image_type','newsair_post_img_hei');
    $url = newsair_get_freatured_image_url($post->ID, 'newsair-medium');
    if ( $post_image_type == 'newsair_post_img_hei' ) {
    if($url) { ?>
        <div class="bs-blog-thumb lg back-img" style="background-image: url('<?php echo esc_url($url); ?>');">
            <a href="<?php the_permalink(); ?>" class="link-div"></a>
        </div> 
    <?php } 
    }
    elseif ( $post_image_type == 'newsair_post_img_acc' ) {
        if(has_post_thumbnail()) { 
            $layout = get_theme_mod('newsair_content_layout','grid-right-sidebar');
            if($layout == 'grid-right-sidebar' || $layout == 'grid-left-sidebar' || $layout == 'grid-fullwidth'){ ?>
                <div class="bs-post-thumb img">
                    <?php echo '<a href="'.esc_url(get_the_permalink()).'">';
                        the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
                        echo '</a>'; ?> 
                </div>
            <?php } else { ?>
                <div class="col-12 col-md-6">
                    <div class="bs-post-thumb img">
                    <?php echo '<a href="'.esc_url(get_the_permalink()).'">';
                        the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
                        echo '</a>'; ?> 
                    </div>
                </div> 
            <?php }
        } 
    }
}
function newsair_custom_header_background() { 
$color = get_theme_mod( 'background_color','' );
?>
<style type="text/css" id="custom-background-css">
    .wrapper { background-color: #<?php echo esc_attr($color); ?>}
</style>
<?php }
add_action('wp_head','newsair_custom_header_background');


/* Typography Fonts */
if (!function_exists('newsair_typo_fonts')) {

    function newsair_typo_fonts() {
        return array('ABeeZee' => 'ABeeZee', 'Abel' => 'Abel', 'Abril Fatface' => 'Abril Fatface', 'Aclonica' => 'Aclonica', 'Acme' => 'Acme', 'Actor' => 'Actor', 'Adamina' => 'Adamina', 'Advent Pro' => 'Advent Pro', 'Aguafina Script' => 'Aguafina Script', 'Akronim' => 'Akronim', 'Aladin' => 'Aladin', 'Aldrich' => 'Aldrich', 'Alef' => 'Alef', 'Alegreya' => 'Alegreya', 'Alegreya SC' => 'Alegreya SC', 'Alegreya Sans' => 'Alegreya Sans', 'Alegreya Sans SC' => 'Alegreya Sans SC', 'Alex Brush' => 'Alex Brush', 'Alfa Slab One' => 'Alfa Slab One', 'Alice' => 'Alice', 'Alike' => 'Alike', 'Alike Angular' => 'Alike Angular', 'Allan' => 'Allan', 'Allerta' => 'Allerta', 'Allerta Stencil' => 'Allerta Stencil', 'Allura' => 'Allura', 'Almendra' => 'Almendra', 'Almendra Display' => 'Almendra Display', 'Almendra SC' => 'Almendra SC', 'Amarante' => 'Amarante', 'Amaranth' => 'Amaranth', 'Amatic SC' => 'Amatic SC', 'Amatica SC' => 'Amatica SC', 'Amethysta' => 'Amethysta', 'Amiko' => 'Amiko', 'Amiri' => 'Amiri', 'Amita' => 'Amita', 'Anaheim' => 'Anaheim', 'Andada' => 'Andada', 'Andika' => 'Andika', 'Angkor' => 'Angkor', 'Annie Use Your Telescope' => 'Annie Use Your Telescope', 'Anonymous Pro' => 'Anonymous Pro', 'Antic' => 'Antic', 'Antic Didone' => 'Antic Didone', 'Antic Slab' => 'Antic Slab', 'Anton' => 'Anton', 'Arapey' => 'Arapey', 'Arbutus' => 'Arbutus', 'Arbutus Slab' => 'Arbutus Slab', 'Architects Daughter' => 'Architects Daughter', 'Archivo Black' => 'Archivo Black', 'Archivo Narrow' => 'Archivo Narrow', 'Aref Ruqaa' => 'Aref Ruqaa', 'Arima Madurai' => 'Arima Madurai', 'Arimo' => 'Arimo', 'Arizonia' => 'Arizonia', 'Armata' => 'Armata', 'Artifika' => 'Artifika', 'Arvo' => 'Arvo', 'Arya' => 'Arya', 'Asap' => 'Asap', 'Asar' => 'Asar', 'Asset' => 'Asset', 'Assistant' => 'Assistant', 'Astloch' => 'Astloch', 'Asul' => 'Asul', 'Athiti' => 'Athiti', 'Atma' => 'Atma', 'Atomic Age' => 'Atomic Age', 'Aubrey' => 'Aubrey', 'Audiowide' => 'Audiowide', 'Autour One' => 'Autour One', 'Average' => 'Average', 'Average Sans' => 'Average Sans', 'Averia Gruesa Libre' => 'Averia Gruesa Libre', 'Averia Libre' => 'Averia Libre', 'Averia Sans Libre' => 'Averia Sans Libre', 'Averia Serif Libre' => 'Averia Serif Libre', 'Bad Script' => 'Bad Script', 'Baloo' => 'Baloo', 'Baloo Bhai' => 'Baloo Bhai', 'Baloo Da' => 'Baloo Da', 'Baloo Thambi' => 'Baloo Thambi', 'Balthazar' => 'Balthazar', 'Bangers' => 'Bangers', 'Basic' => 'Basic', 'Battambang' => 'Battambang', 'Baumans' => 'Baumans', 'Bayon' => 'Bayon', 'Belgrano' => 'Belgrano', 'Belleza' => 'Belleza', 'BenchNine' => 'BenchNine', 'Bentham' => 'Bentham', 'Berkshire Swash' => 'Berkshire Swash', 'Bevan' => 'Bevan', 'Bigelow Rules' => 'Bigelow Rules', 'Bigshot One' => 'Bigshot One', 'Bilbo' => 'Bilbo', 'Bilbo Swash Caps' => 'Bilbo Swash Caps', 'BioRhyme' => 'BioRhyme', 'BioRhyme Expanded' => 'BioRhyme Expanded', 'Biryani' => 'Biryani', 'Bitter' => 'Bitter', 'Black Ops One' => 'Black Ops One', 'Bokor' => 'Bokor', 'Bonbon' => 'Bonbon', 'Boogaloo' => 'Boogaloo', 'Bowlby One' => 'Bowlby One', 'Bowlby One SC' => 'Bowlby One SC', 'Brawler' => 'Brawler', 'Bree Serif' => 'Bree Serif', 'Bubblegum Sans' => 'Bubblegum Sans', 'Bubbler One' => 'Bubbler One', 'Buda' => 'Buda', 'Buenard' => 'Buenard', 'Bungee' => 'Bungee', 'Bungee Hairline' => 'Bungee Hairline', 'Bungee Inline' => 'Bungee Inline', 'Bungee Outline' => 'Bungee Outline', 'Bungee Shade' => 'Bungee Shade', 'Butcherman' => 'Butcherman', 'Butterfly Kids' => 'Butterfly Kids', 'Cabin' => 'Cabin', 'Cabin Condensed' => 'Cabin Condensed', 'Cabin Sketch' => 'Cabin Sketch', 'Caesar Dressing' => 'Caesar Dressing', 'Cagliostro' => 'Cagliostro', 'Cairo' => 'Cairo', 'Calligraffitti' => 'Calligraffitti', 'Cambay' => 'Cambay', 'Cambo' => 'Cambo', 'Candal' => 'Candal', 'Cantarell' => 'Cantarell', 'Cantata One' => 'Cantata One', 'Cantora One' => 'Cantora One', 'Capriola' => 'Capriola', 'Cardo' => 'Cardo', 'Carme' => 'Carme', 'Carrois Gothic' => 'Carrois Gothic', 'Carrois Gothic SC' => 'Carrois Gothic SC', 'Carter One' => 'Carter One', 'Catamaran' => 'Catamaran', 'Caudex' => 'Caudex', 'Caveat' => 'Caveat', 'Caveat Brush' => 'Caveat Brush', 'Cedarville Cursive' => 'Cedarville Cursive', 'Ceviche One' => 'Ceviche One', 'Changa' => 'Changa', 'Changa One' => 'Changa One', 'Chango' => 'Chango', 'Chathura' => 'Chathura', 'Chau Philomene One' => 'Chau Philomene One', 'Chela One' => 'Chela One', 'Chelsea Market' => 'Chelsea Market', 'Chenla' => 'Chenla', 'Cherry Cream Soda' => 'Cherry Cream Soda', 'Cherry Swash' => 'Cherry Swash', 'Chewy' => 'Chewy', 'Chicle' => 'Chicle', 'Chivo' => 'Chivo', 'Chonburi' => 'Chonburi', 'Cinzel' => 'Cinzel', 'Cinzel Decorative' => 'Cinzel Decorative', 'Clicker Script' => 'Clicker Script', 'Coda' => 'Coda', 'Coda Caption' => 'Coda Caption', 'Codystar' => 'Codystar', 'Coiny' => 'Coiny', 'Combo' => 'Combo', 'Comfortaa' => 'Comfortaa', 'Coming Soon' => 'Coming Soon', 'Concert One' => 'Concert One', 'Condiment' => 'Condiment', 'Content' => 'Content', 'Contrail One' => 'Contrail One', 'Convergence' => 'Convergence', 'Cookie' => 'Cookie', 'Copse' => 'Copse', 'Corben' => 'Corben', 'Cormorant' => 'Cormorant', 'Cormorant Garamond' => 'Cormorant Garamond', 'Cormorant Infant' => 'Cormorant Infant', 'Cormorant SC' => 'Cormorant SC', 'Cormorant Unicase' => 'Cormorant Unicase', 'Cormorant Upright' => 'Cormorant Upright', 'Courgette' => 'Courgette', 'Cousine' => 'Cousine', 'Coustard' => 'Coustard', 'Covered By Your Grace' => 'Covered By Your Grace', 'Crafty Girls' => 'Crafty Girls', 'Creepster' => 'Creepster', 'Crete Round' => 'Crete Round', 'Crimson Text' => 'Crimson Text', 'Croissant One' => 'Croissant One', 'Crushed' => 'Crushed', 'Cuprum' => 'Cuprum', 'Cutive' => 'Cutive', 'Cutive Mono' => 'Cutive Mono', 'Damion' => 'Damion', 'Dancing Script' => 'Dancing Script', 'Dangrek' => 'Dangrek', 'David Libre' => 'David Libre', 'Dawning of a New Day' => 'Dawning of a New Day', 'Days One' => 'Days One', 'Dekko' => 'Dekko', 'Delius' => 'Delius', 'Delius Swash Caps' => 'Delius Swash Caps', 'Delius Unicase' => 'Delius Unicase', 'Della Respira' => 'Della Respira', 'Denk One' => 'Denk One', 'Devonshire' => 'Devonshire', 'Dhurjati' => 'Dhurjati', 'Didact Gothic' => 'Didact Gothic', 'Diplomata' => 'Diplomata', 'Diplomata SC' => 'Diplomata SC', 'Domine' => 'Domine', 'Donegal One' => 'Donegal One', 'Doppio One' => 'Doppio One', 'Dorsa' => 'Dorsa', 'Dosis' => 'Dosis', 'Dr Sugiyama' => 'Dr Sugiyama', 'Droid Sans' => 'Droid Sans', 'Droid Sans Mono' => 'Droid Sans Mono', 'Droid Serif' => 'Droid Serif', 'Duru Sans' => 'Duru Sans', 'Dynalight' => 'Dynalight', 'EB Garamond' => 'EB Garamond', 'Eagle Lake' => 'Eagle Lake', 'Eater' => 'Eater', 'Economica' => 'Economica', 'Eczar' => 'Eczar', 'Ek Mukta' => 'Ek Mukta', 'El Messiri' => 'El Messiri', 'Electrolize' => 'Electrolize', 'Elsie' => 'Elsie', 'Elsie Swash Caps' => 'Elsie Swash Caps', 'Emblema One' => 'Emblema One', 'Emilys Candy' => 'Emilys Candy', 'Engagement' => 'Engagement', 'Englebert' => 'Englebert', 'Enriqueta' => 'Enriqueta', 'Erica One' => 'Erica One', 'Esteban' => 'Esteban', 'Euphoria Script' => 'Euphoria Script', 'Ewert' => 'Ewert', 'Exo' => 'Exo', 'Exo 2' => 'Exo 2', 'Expletus Sans' => 'Expletus Sans', 'Fanwood Text' => 'Fanwood Text', 'Farsan' => 'Farsan', 'Fascinate' => 'Fascinate', 'Fascinate Inline' => 'Fascinate Inline', 'Faster One' => 'Faster One', 'Fasthand' => 'Fasthand', 'Fauna One' => 'Fauna One', 'Federant' => 'Federant', 'Federo' => 'Federo', 'Felipa' => 'Felipa', 'Fenix' => 'Fenix', 'Finger Paint' => 'Finger Paint', 'Fira Mono' => 'Fira Mono', 'Fira Sans' => 'Fira Sans', 'Fjalla One' => 'Fjalla One', 'Fjord One' => 'Fjord One', 'Flamenco' => 'Flamenco', 'Flavors' => 'Flavors', 'Fondamento' => 'Fondamento', 'Fontdiner Swanky' => 'Fontdiner Swanky', 'Forum' => 'Forum', 'Francois One' => 'Francois One', 'Frank Ruhl Libre' => 'Frank Ruhl Libre', 'Freckle Face' => 'Freckle Face', 'Fredericka the Great' => 'Fredericka the Great', 'Fredoka One' => 'Fredoka One', 'Freehand' => 'Freehand', 'Fresca' => 'Fresca', 'Frijole' => 'Frijole', 'Fruktur' => 'Fruktur', 'Fugaz One' => 'Fugaz One', 'GFS Didot' => 'GFS Didot', 'GFS Neohellenic' => 'GFS Neohellenic', 'Gabriela' => 'Gabriela', 'Gafata' => 'Gafata', 'Galada' => 'Galada', 'Galdeano' => 'Galdeano', 'Galindo' => 'Galindo', 'Gentium Basic' => 'Gentium Basic', 'Gentium Book Basic' => 'Gentium Book Basic', 'Geo' => 'Geo', 'Geostar' => 'Geostar', 'Geostar Fill' => 'Geostar Fill', 'Germania One' => 'Germania One', 'Gidugu' => 'Gidugu', 'Gilda Display' => 'Gilda Display', 'Give You Glory' => 'Give You Glory', 'Glass Antiqua' => 'Glass Antiqua', 'Glegoo' => 'Glegoo', 'Gloria Hallelujah' => 'Gloria Hallelujah', 'Goblin One' => 'Goblin One', 'Gochi Hand' => 'Gochi Hand', 'Gorditas' => 'Gorditas', 'Goudy Bookletter 1911' => 'Goudy Bookletter 1911', 'Graduate' => 'Graduate', 'Grand Hotel' => 'Grand Hotel', 'Gravitas One' => 'Gravitas One', 'Great Vibes' => 'Great Vibes', 'Griffy' => 'Griffy', 'Gruppo' => 'Gruppo', 'Gudea' => 'Gudea', 'Gurajada' => 'Gurajada', 'Habibi' => 'Habibi', 'Halant' => 'Halant', 'Hammersmith One' => 'Hammersmith One', 'Hanalei' => 'Hanalei', 'Hanalei Fill' => 'Hanalei Fill', 'Handlee' => 'Handlee', 'Hanuman' => 'Hanuman', 'Happy Monkey' => 'Happy Monkey', 'Harmattan' => 'Harmattan', 'Headland One' => 'Headland One', 'Heebo' => 'Heebo', 'Henny Penny' => 'Henny Penny', 'Herr Von Muellerhoff' => 'Herr Von Muellerhoff', 'Hind' => 'Hind', 'Hind Guntur' => 'Hind Guntur', 'Hind Madurai' => 'Hind Madurai', 'Hind Siliguri' => 'Hind Siliguri', 'Hind Vadodara' => 'Hind Vadodara', 'Holtwood One SC' => 'Holtwood One SC', 'Homemade Apple' => 'Homemade Apple', 'Homenaje' => 'Homenaje', 'IM Fell DW Pica' => 'IM Fell DW Pica', 'IM Fell DW Pica SC' => 'IM Fell DW Pica SC', 'IM Fell Double Pica' => 'IM Fell Double Pica', 'IM Fell Double Pica SC' => 'IM Fell Double Pica SC', 'IM Fell English' => 'IM Fell English', 'IM Fell English SC' => 'IM Fell English SC', 'IM Fell French Canon' => 'IM Fell French Canon', 'IM Fell French Canon SC' => 'IM Fell French Canon SC', 'IM Fell Great Primer' => 'IM Fell Great Primer', 'IM Fell Great Primer SC' => 'IM Fell Great Primer SC', 'Iceberg' => 'Iceberg', 'Iceland' => 'Iceland', 'Imprima' => 'Imprima', 'Inconsolata' => 'Inconsolata', 'Inder' => 'Inder', 'Indie Flower' => 'Indie Flower', 'Inika' => 'Inika', 'Inknut Antiqua' => 'Inknut Antiqua', 'Irish Grover' => 'Irish Grover', 'Istok Web' => 'Istok Web', 'Italiana' => 'Italiana', 'Italianno' => 'Italianno', 'Itim' => 'Itim', 'Jacques Francois' => 'Jacques Francois', 'Jacques Francois Shadow' => 'Jacques Francois Shadow', 'Jaldi' => 'Jaldi', 'Jim Nightshade' => 'Jim Nightshade', 'Jockey One' => 'Jockey One', 'Jolly Lodger' => 'Jolly Lodger', 'Jomhuria' => 'Jomhuria', 'Josefin Sans' => 'Josefin Sans', 'Josefin Slab' => 'Josefin Slab', 'Joti One' => 'Joti One', 'Judson' => 'Judson', 'Julee' => 'Julee', 'Julius Sans One' => 'Julius Sans One', 'Junge' => 'Junge', 'Jura' => 'Jura', 'Just Another Hand' => 'Just Another Hand', 'Just Me Again Down Here' => 'Just Me Again Down Here', 'Kadwa' => 'Kadwa', 'Kalam' => 'Kalam', 'Kameron' => 'Kameron', 'Kanit' => 'Kanit', 'Kantumruy' => 'Kantumruy', 'Karla' => 'Karla', 'Karma' => 'Karma', 'Katibeh' => 'Katibeh', 'Kaushan Script' => 'Kaushan Script', 'Kavivanar' => 'Kavivanar', 'Kavoon' => 'Kavoon', 'Kdam Thmor' => 'Kdam Thmor', 'Keania One' => 'Keania One', 'Kelly Slab' => 'Kelly Slab', 'Kenia' => 'Kenia', 'Khand' => 'Khand', 'Khmer' => 'Khmer', 'Khula' => 'Khula', 'Kite One' => 'Kite One', 'Knewave' => 'Knewave', 'Kotta One' => 'Kotta One', 'Koulen' => 'Koulen', 'Kranky' => 'Kranky', 'Kreon' => 'Kreon', 'Kristi' => 'Kristi', 'Krona One' => 'Krona One', 'Kumar One' => 'Kumar One', 'Kumar One Outline' => 'Kumar One Outline', 'Kurale' => 'Kurale', 'La Belle Aurore' => 'La Belle Aurore', 'Laila' => 'Laila', 'Lakki Reddy' => 'Lakki Reddy', 'Lalezar' => 'Lalezar', 'Lancelot' => 'Lancelot', 'Lateef' => 'Lateef', 'Lato' => 'Lato', 'League Script' => 'League Script', 'Leckerli One' => 'Leckerli One', 'Ledger' => 'Ledger', 'Lekton' => 'Lekton', 'Lemon' => 'Lemon', 'Lemonada' => 'Lemonada', 'Libre Baskerville' => 'Libre Baskerville', 'Libre Franklin' => 'Libre Franklin', 'Life Savers' => 'Life Savers', 'Lilita One' => 'Lilita One', 'Lily Script One' => 'Lily Script One', 'Limelight' => 'Limelight', 'Linden Hill' => 'Linden Hill', 'Lobster' => 'Lobster', 'Lobster Two' => 'Lobster Two', 'Londrina Outline' => 'Londrina Outline', 'Londrina Shadow' => 'Londrina Shadow', 'Londrina Sketch' => 'Londrina Sketch', 'Londrina Solid' => 'Londrina Solid', 'Lora' => 'Lora', 'Love Ya Like A Sister' => 'Love Ya Like A Sister', 'Loved by the King' => 'Loved by the King', 'Lovers Quarrel' => 'Lovers Quarrel', 'Luckiest Guy' => 'Luckiest Guy', 'Lusitana' => 'Lusitana', 'Lustria' => 'Lustria', 'Macondo' => 'Macondo', 'Macondo Swash Caps' => 'Macondo Swash Caps', 'Mada' => 'Mada', 'Magra' => 'Magra', 'Maiden Orange' => 'Maiden Orange', 'Maitree' => 'Maitree', 'Mako' => 'Mako', 'Mallanna' => 'Mallanna', 'Mandali' => 'Mandali', 'Marcellus' => 'Marcellus', 'Marcellus SC' => 'Marcellus SC', 'Marck Script' => 'Marck Script', 'Margarine' => 'Margarine', 'Marko One' => 'Marko One', 'Marmelad' => 'Marmelad', 'Martel' => 'Martel', 'Martel Sans' => 'Martel Sans', 'Marvel' => 'Marvel', 'Mate' => 'Mate', 'Mate SC' => 'Mate SC', 'Maven Pro' => 'Maven Pro', 'McLaren' => 'McLaren', 'Meddon' => 'Meddon', 'MedievalSharp' => 'MedievalSharp', 'Medula One' => 'Medula One', 'Meera Inimai' => 'Meera Inimai', 'Megrim' => 'Megrim', 'Meie Script' => 'Meie Script', 'Merienda' => 'Merienda', 'Merienda One' => 'Merienda One', 'Merriweather' => 'Merriweather', 'Merriweather Sans' => 'Merriweather Sans', 'Metal' => 'Metal', 'Metal Mania' => 'Metal Mania', 'Metamorphous', 'Metrophobic' => 'Metrophobic', 'Michroma' => 'Michroma', 'Milonga' => 'Milonga', 'Miltonian' => 'Miltonian', 'Miltonian Tattoo' => 'Miltonian Tattoo', 'Miniver' => 'Miniver', 'Miriam Libre' => 'Miriam Libre', 'Mirza' => 'Mirza', 'Miss Fajardose' => 'Miss Fajardose', 'Mitr' => 'Mitr', 'Modak' => 'Modak', 'Modern Antiqua' => 'Modern Antiqua', 'Mogra' => 'Mogra', 'Molengo' => 'Molengo', 'Molle' => 'Molle', 'Monda' => 'Monda', 'Monofett' => 'Monofett', 'Monoton' => 'Monoton', 'Monsieur La Doulaise' => 'Monsieur La Doulaise', 'Montaga' => 'Montaga', 'Montez' => 'Montez', 'Montserrat' => 'Montserrat', 'Montserrat Alternates' => 'Montserrat Alternates', 'Montserrat Subrayada' => 'Montserrat Subrayada', 'Moul' => 'Moul', 'Moulpali' => 'Moulpali', 'Mountains of Christmas' => 'Mountains of Christmas', 'Mouse Memoirs' => 'Mouse Memoirs', 'Mr Bedfort' => 'Mr Bedfort', 'Mr Dafoe' => 'Mr Dafoe', 'Mr De Haviland' => 'Mr De Haviland', 'Mrs Saint Delafield' => 'Mrs Saint Delafield', 'Mrs Sheppards' => 'Mrs Sheppards', 'Mukta Vaani' => 'Mukta Vaani', 'Muli' => 'Muli', 'Mystery Quest' => 'Mystery Quest', 'NTR' => 'NTR', 'Neucha' => 'Neucha', 'Neuton' => 'Neuton', 'New Rocker' => 'New Rocker', 'News Cycle' => 'News Cycle', 'Niconne' => 'Niconne', 'Nixie One' => 'Nixie One', 'Nobile' => 'Nobile', 'Nokora' => 'Nokora', 'Norican' => 'Norican', 'Nosifer' => 'Nosifer', 'Nothing You Could Do' => 'Nothing You Could Do', 'Noticia Text' => 'Noticia Text', 'Noto Sans' => 'Noto Sans', 'Noto Serif' => 'Noto Serif', 'Nova Cut' => 'Nova Cut', 'Nova Flat' => 'Nova Flat', 'Nova Mono' => 'Nova Mono', 'Nova Oval' => 'Nova Oval', 'Nova Round' => 'Nova Round', 'Nova Script' => 'Nova Script', 'Nova Slim' => 'Nova Slim', 'Nova Square' => 'Nova Square', 'Numans' => 'Numans', 'Nunito' => 'Nunito', 'Odor Mean Chey' => 'Odor Mean Chey', 'Offside' => 'Offside', 'Old Standard TT' => 'Old Standard TT', 'Oldenburg' => 'Oldenburg', 'Oleo Script' => 'Oleo Script', 'Oleo Script Swash Caps' => 'Oleo Script Swash Caps', 'Open Sans' => 'Open Sans', 'Open Sans Condensed' => 'Open Sans Condensed', 'Oranienbaum' => 'Oranienbaum', 'Orbitron' => 'Orbitron', 'Oregano' => 'Oregano', 'Orienta' => 'Orienta', 'Original Surfer' => 'Original Surfer', 'Oswald' => 'Oswald', 'Over the Rainbow' => 'Over the Rainbow', 'Overlock' => 'Overlock', 'Overlock SC' => 'Overlock SC', 'Ovo' => 'Ovo', 'Oxygen' => 'Oxygen', 'Oxygen Mono' => 'Oxygen Mono', 'PT Mono' => 'PT Mono', 'PT Sans' => 'PT Sans', 'PT Sans Caption' => 'PT Sans Caption', 'PT Sans Narrow' => 'PT Sans Narrow', 'PT Serif' => 'PT Serif', 'PT Serif Caption' => 'PT Serif Caption', 'Pacifico' => 'Pacifico', 'Palanquin' => 'Palanquin', 'Palanquin Dark' => 'Palanquin Dark', 'Paprika' => 'Paprika', 'Parisienne' => 'Parisienne', 'Passero One' => 'Passero One', 'Passion One' => 'Passion One', 'Pathway Gothic One' => 'Pathway Gothic One', 'Patrick Hand' => 'Patrick Hand', 'Patrick Hand SC' => 'Patrick Hand SC', 'Pattaya' => 'Pattaya', 'Patua One' => 'Patua One', 'Pavanam' => 'Pavanam', 'Paytone One' => 'Paytone One', 'Peddana' => 'Peddana', 'Peralta' => 'Peralta', 'Permanent Marker' => 'Permanent Marker', 'Petit Formal Script' => 'Petit Formal Script', 'Petrona' => 'Petrona', 'Philosopher' => 'Philosopher', 'Piedra' => 'Piedra', 'Pinyon Script' => 'Pinyon Script', 'Pirata One' => 'Pirata One', 'Plaster' => 'Plaster', 'Play' => 'Play', 'Playball' => 'Playball', 'Playfair Display' => 'Playfair Display', 'Playfair Display SC' => 'Playfair Display SC', 'Podkova' => 'Podkova', 'Poiret One' => 'Poiret One', 'Poller One' => 'Poller One', 'Poly' => 'Poly', 'Pompiere' => 'Pompiere', 'Pontano Sans' => 'Pontano Sans', 'Poppins' => 'Poppins', 'Port Lligat Sans' => 'Port Lligat Sans', 'Port Lligat Slab' => 'Port Lligat Slab', 'Pragati Narrow' => 'Pragati Narrow', 'Prata' => 'Prata', 'Preahvihear' => 'Preahvihear', 'Press Start 2P' => 'Press Start 2P', 'Pridi' => 'Pridi', 'Princess Sofia' => 'Princess Sofia', 'Prociono' => 'Prociono', 'Prompt' => 'Prompt', 'Prosto One' => 'Prosto One', 'Proza Libre' => 'Proza Libre', 'Puritan' => 'Puritan', 'Purple Purse' => 'Purple Purse', 'Quando' => 'Quando', 'Quantico' => 'Quantico', 'Quattrocento' => 'Quattrocento', 'Quattrocento Sans' => 'Quattrocento Sans', 'Questrial' => 'Questrial', 'Quicksand' => 'Quicksand', 'Quintessential' => 'Quintessential', 'Qwigley' => 'Qwigley', 'Racing Sans One' => 'Racing Sans One', 'Radley' => 'Radley', 'Rajdhani' => 'Rajdhani', 'Rakkas' => 'Rakkas', 'Raleway' => 'Raleway', 'Raleway Dots' => 'Raleway Dots', 'Ramabhadra' => 'Ramabhadra', 'Ramaraja' => 'Ramaraja', 'Rambla' => 'Rambla', 'Rammetto One' => 'Rammetto One', 'Ranchers' => 'Ranchers', 'Rancho' => 'Rancho', 'Ranga' => 'Ranga', 'Rasa' => 'Rasa', 'Rationale' => 'Rationale', 'Redressed' => 'Redressed', 'Reem Kufi' => 'Reem Kufi', 'Reenie Beanie' => 'Reenie Beanie', 'Revalia' => 'Revalia', 'Rhodium Libre' => 'Rhodium Libre', 'Ribeye' => 'Ribeye', 'Ribeye Marrow' => 'Ribeye Marrow', 'Righteous' => 'Righteous', 'Risque' => 'Risque', 'Roboto' => 'Roboto', 'Roboto Condensed' => 'Roboto Condensed', 'Roboto Mono' => 'Roboto Mono', 'Roboto Slab' => 'Roboto Slab', 'Rochester' => 'Rochester', 'Rock Salt' => 'Rock Salt', 'Rokkitt' => 'Rokkitt', 'Romanesco' => 'Romanesco', 'Ropa Sans' => 'Ropa Sans', 'Rosario' => 'Rosario', 'Rosarivo' => 'Rosarivo', 'Rouge Script' => 'Rouge Script', 'Rozha One' => 'Rozha One', 'Rubik' => 'Rubik', 'Rubik Mono One' => 'Rubik Mono One', 'Rubik One' => 'Rubik One', 'Ruda' => 'Ruda', 'Rufina' => 'Rufina', 'Ruge Boogie' => 'Ruge Boogie', 'Ruluko' => 'Ruluko', 'Rum Raisin' => 'Rum Raisin', 'Ruslan Display' => 'Ruslan Display', 'Russo One => Russo One', 'Ruthie' => 'Ruthie', 'Rye' => 'Rye', 'Sacramento' => 'Sacramento', 'Sahitya' => 'Sahitya', 'Sail' => 'Sail', 'Salsa' => 'Salsa', 'Sanchez' => 'Sanchez', 'Sancreek' => 'Sancreek', 'Sansita One' => 'Sansita One', 'Sarala' => 'Sarala', 'Sarina' => 'Sarina', 'Sarpanch' => 'Sarpanch', 'Satisfy' => 'Satisfy', 'Scada' => 'Scada', 'Scheherazade' => 'Scheherazade', 'Schoolbell' => 'Schoolbell', 'Scope One' => 'Scope One', 'Seaweed Script' => 'Seaweed Script', 'Secular One' => 'Secular One', 'Sevillana' => 'Sevillana', 'Seymour One' => 'Seymour One', 'Shadows Into Light' => 'Shadows Into Light', 'Shadows Into Light Two' => 'Shadows Into Light Two', 'Shanti' => 'Shanti', 'Share' => 'Share', 'Share Tech' => 'Share Tech', 'Share Tech Mono' => 'Share Tech Mono', 'Shojumaru' => 'Shojumaru', 'Short Stack' => 'Short Stack', 'Shrikhand' => 'Shrikhand', 'Siemreap' => 'Siemreap', 'Sigmar One' => 'Sigmar One', 'Signika' => 'Signika', 'Signika Negative' => 'Signika Negative', 'Simonetta' => 'Simonetta', 'Sintony' => 'Sintony', 'Sirin Stencil' => 'Sirin Stencil', 'Six Caps' => 'Six Caps', 'Skranji' => 'Skranji', 'Slabo 13px' => 'Slabo 13px', 'Slabo 27px' => 'Slabo 27px', 'Slackey' => 'Slackey', 'Smokum' => 'Smokum', 'Smythe' => 'Smythe', 'Sniglet' => 'Sniglet', 'Snippet' => 'Snippet', 'Snowburst One' => 'Snowburst One', 'Sofadi One' => 'Sofadi One', 'Sofia' => 'Sofia', 'Sonsie One' => 'Sonsie One', 'Sorts Mill Goudy' => 'Sorts Mill Goudy', 'Source Code Pro' => 'Source Code Pro', 'Source Sans Pro' => 'Source Sans Pro', 'Source Serif Pro' => 'Source Serif Pro', 'Space Mono' => 'Space Mono', 'Special Elite' => 'Special Elite', 'Spicy Rice' => 'Spicy Rice', 'Spinnaker' => 'Spinnaker', 'Spirax' => 'Spirax', 'Squada One' => 'Squada One', 'Sree Krushnadevaraya' => 'Sree Krushnadevaraya', 'Sriracha' => 'Sriracha', 'Stalemate' => 'Stalemate', 'Stalinist One' => 'Stalinist One', 'Stardos Stencil' => 'Stardos Stencil', 'Stint Ultra Condensed' => 'Stint Ultra Condensed', 'Stint Ultra Expanded' => 'Stint Ultra Expanded', 'Stoke' => 'Stoke', 'Strait' => 'Strait', 'Sue Ellen Francisco' => 'Sue Ellen Francisco', 'Suez One' => 'Suez One', 'Sumana' => 'Sumana', 'Sunshiney' => 'Sunshiney', 'Supermercado One' => 'Supermercado One', 'Sura' => 'Sura', 'Suranna' => 'Suranna', 'Suravaram' => 'Suravaram', 'Suwannaphum' => 'Suwannaphum', 'Swanky and Moo Moo' => 'Swanky and Moo Moo', 'Syncopate' => 'Syncopate', 'Tangerine' => 'Tangerine', 'Taprom' => 'Taprom', 'Tauri' => 'Tauri', 'Taviraj' => 'Taviraj', 'Teko' => 'Teko', 'Telex' => 'Telex', 'Tenali Ramakrishna' => 'Tenali Ramakrishna', 'Tenor Sans' => 'Tenor Sans', 'Text Me One' => 'Text Me One', 'The Girl Next Door' => 'The Girl Next Door', 'Tienne' => 'Tienne', 'Tillana' => 'Tillana', 'Timmana' => 'Timmana', 'Tinos' => 'Tinos', 'Titan One' => 'Titan One', 'Titillium Web' => 'Titillium Web', 'Trade Winds' => 'Trade Winds', 'Trirong' => 'Trirong', 'Trocchi' => 'Trocchi', 'Trochut' => 'Trochut', 'Trykker' => 'Trykker', 'Tulpen One' => 'Tulpen One', 'Ubuntu' => 'Ubuntu', 'Ubuntu Condensed' => 'Ubuntu Condensed', 'Ubuntu Mono' => 'Ubuntu Mono', 'Ultra' => 'Ultra', 'Uncial Antiqua' => 'Uncial Antiqua', 'Underdog' => 'Underdog', 'Unica One' => 'Unica One', 'UnifrakturCook' => 'UnifrakturCook', 'UnifrakturMaguntia' => 'UnifrakturMaguntia', 'Unkempt' => 'Unkempt', 'Unlock' => 'Unlock', 'Unna' => 'Unna', 'VT323' => 'VT323', 'Vampiro One' => 'Vampiro One', 'Varela' => 'Varela', 'Varela Round' => 'Varela Round', 'Vast Shadow' => 'Vast Shadow', 'Vesper Libre' => 'Vesper Libre', 'Vibur' => 'Vibur', 'Vidaloka' => 'Vidaloka', 'Viga' => 'Viga', 'Voces' => 'Voces', 'Volkhov' => 'Volkhov', 'Vollkorn' => 'Vollkorn', 'Voltaire' => 'Voltaire', 'Waiting for the Sunrise' => 'Waiting for the Sunrise', 'Wallpoet' => 'Wallpoet', 'Walter Turncoat' => 'Walter Turncoat', 'Warnes' => 'Warnes', 'Wellfleet' => 'Wellfleet', 'Wendy One' => 'Wendy One', 'Wire One' => 'Wire One', 'Work Sans' => 'Work Sans', 'Yanone Kaffeesatz' => 'Yanone Kaffeesatz', 'Yantramanav' => 'Yantramanav', 'Yatra One' => 'Yatra One', 'Yellowtail' => 'Yellowtail', 'Yeseva One' => 'Yeseva One', 'Yesteryear' => 'Yesteryear', 'Yrsa' => 'Yrsa', 'Zeyada' => 'Zeyada');
    }

}

if ( ! function_exists( 'newsair_header_color' ) ) :

function newsair_header_color() {
    $newsair_logo_text_color = get_header_textcolor();
    $newsair_title_fontsize_desktop = newsair_get_option('newsair_title_fontsize_desktop');
    $newsair_title_fontsize_tablet = newsair_get_option('newsair_title_fontsize_tablet');
    $newsair_title_fontsize_mobile = newsair_get_option('newsair_title_fontsize_mobile');

    ?>
    <style type="text/css">
    <?php if ( ! display_header_text() ) : ?>

        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }

    <?php else : ?>
        
        .site-title a,
        .site-description {
            color: #<?php echo esc_attr( $newsair_logo_text_color ); ?>;
        }

        .site-branding-text .site-title a {
                font-size: <?php echo esc_attr( $newsair_title_fontsize_desktop ); ?>px;
            }

            @media (max-width: 991.98px)  {
                .site-branding-text .site-title a {
                    font-size: <?php echo esc_attr( $newsair_title_fontsize_tablet ); ?>px;

                }
            }

            @media (max-width: 575.98px) {
                .site-branding-text .site-title a {
                    font-size: <?php echo esc_attr( $newsair_title_fontsize_mobile ); ?>px;

                }
            }

    <?php endif; ?>
    </style>
    <?php
}
endif;

//SCROLL TO TOP //
if ( ! function_exists( 'newsair_scrolltoup' ) ) :

function newsair_scrolltoup() {
    $scrollup_layout = get_theme_mod('scrollup_layout','default');
    $scrollup_enable = get_theme_mod('newsair_scrollup_enable',true);
    if($scrollup_enable == true)
    { ?>
    <div class="newsair_stt">
        <a href="#" class="bs_upscr">
            <i class="fas <?php echo esc_attr($scrollup_layout)?>"></i>
        </a>
    </div>
    <?php }  
}
endif; 

function newsair_dropcap()
{
$newsair_drop_caps_enable = get_theme_mod('newsair_drop_caps_enable','false');
if($newsair_drop_caps_enable == 'true')
{
?>
<style>
  .bs-blog-post p:nth-of-type(1)::first-letter {
    font-size: 60px;
    font-weight: 800;
    margin-right: 10px;
    font-family: 'Vollkorn', serif;
    line-height: 1; 
    float: left;
}
</style>
<?php } else { ?>
<style>
  .bs-blog-post p:nth-of-type(1)::first-letter {
    display: none;
}
</style>
<?php } } add_action('wp_head','newsair_dropcap');


if ( ! function_exists( 'newsair_search_popup' ) ) :
function newsair_search_popup() { ?>
    <div class="modal fade bs_model" id="exampleModal" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
              <?php get_search_form(); ?>
            </div>
          </div>
        </div>
    </div>
<?php }
endif;