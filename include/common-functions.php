<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Get All Post Types
 */
function raizen_get_post_types(){

    $raizen_cpts = get_post_types(array('public' => true, 'show_in_nav_menus' => true), 'object');
    $raizen_exclude_cpts = array('elementor_library', 'attachment');
    foreach ($raizen_exclude_cpts as $exclude_cpt) {
        unset($raizen_cpts[$exclude_cpt]);
    }
    $post_types = array_merge($raizen_cpts);
    foreach ($post_types as $type) {
        $types[$type->name] = $type->label;
    }
    return $types;
}

/**
 * Get all types of post.
 */
function raizen_get_all_types_post($post_type){

    $posts_args = get_posts(array(
        'post_type' => $post_type,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'posts_per_page' => 20,
    ));

    $posts = array();

    if (!empty($posts_args) && !is_wp_error($posts_args)) {
        foreach ($posts_args as $post) {
            $posts[$post->ID] = $post->post_title;
        }
    }

    return $posts;
}

/**
 * Get all Pages
 */
if (!function_exists('raizen_get_all_pages')) {
    function raizen_get_all_pages()
    {

        $page_list = get_posts(array(
            'post_type' => 'page',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 20,
        ));

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }
}

/**
 * Post Settings Parameter
 */
function raizen_get_post_settings($settings)
{
    foreach ($settings as $key => $value) {
        $post_args[$key] = $value;
    }
    $post_args['post_status'] = 'publish';

    return $post_args;
}

/**
 * Get Post Thumbnail Size
 */
function raizen_get_thumbnail_sizes()
{
    $sizes = get_intermediate_image_sizes();
    foreach ($sizes as $s) {
        $ret[$s] = $s;
    }
    return $ret;
}

/**
 * Post Orderby Options
 */
function raizen_get_orderby_options()
{
    $orderby = array(
        'ID' => 'Post ID',
        'author' => 'Post Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Last Modified Date',
        'parent' => 'Parent Id',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order',
    );
    return $orderby;
}

/**
 * Get Post Categories
 */
function raizen_get_categories($taxonomy)
{
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ));
    $options = array();
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
    }
    return $options;
}

/**
 * Get all Pages
 */
if (!function_exists('raizen_get_pages')) {
    function raizen_get_pages()
    {

        $page_list = get_posts(array(
            'post_type' => 'page',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 20,
        ));

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }
}

/**
 * Get a translatable string with allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return string
 */
function raizen_get_allowed_html_desc($level = 'basic')
{
    if (!in_array($level, ['basic', 'intermediate', 'advance'])) {
        $level = 'basic';
    }

    $tags_str = '<' . implode('>,<', array_keys(raizen_get_allowed_html_tags_core($level))) . '>';
    return sprintf(__('This input field has support for the following HTML tags: %1$s', 'raizencore'), '<code>' . esc_html($tags_str) . '</code>');
}

/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function raizen_get_allowed_html_tags_core($level = 'basic')
{
    $allowed_html = [
        'b' => [],
        'i' => [
            'class' => [],
        ],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
            'target' => [],
        ];
    }

    if ($level === 'advance') {
        $allowed_html['ul'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['ol'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['li'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
            'target' => [],
        ];

    }

    return $allowed_html;
}

// WP kses allowed tags
function raizen_kses_core($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
   );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}

/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
if( !function_exists('raizen_is_elementor_version')){
    function raizen_is_elementor_version($operator = '<', $version = '2.6.0')
    {
        return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
    }
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
if(!function_exists('raizen_render_icon')){
    function raizen_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [])
    {
        // Check if its already migrated
        $migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
        // Check if its a new widget without previously selected icon using the old Icon control
        $is_new = empty($settings[$old_icon_id]);

        $attributes['aria-hidden'] = 'true';

        if (raizen_is_elementor_version('>=', '2.6.0') && ($is_new || $migrated)) {
            \Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
        } else {
            if (empty($attributes['class'])) {
                $attributes['class'] = $settings[$old_icon_id];
            } else {
                if (is_array($attributes['class'])) {
                    $attributes['class'][] = $settings[$old_icon_id];
                } else {
                    $attributes['class'] .= ' ' . $settings[$old_icon_id];
                }
            }
            printf('<i %s></i>', \Elementor\Utils::render_html_attributes($attributes));
        }
    }
}


/**
 * Get all types of post.
 *
 * @param string $post_type
 *
 * @return array
 */
function get_post_list($post_type = 'any')
{
    return get_query_post_list($post_type);
}


/**
 * @param string $post_type
 * @param int $limit
 * @param string $search
 * @return array
 */
function get_query_post_list($post_type = 'any', $limit = -1, $search = '')
{
    global $wpdb;
    $where = '';
    $data = [];

    if (-1 == $limit) {
        $limit = '';
    } elseif (0 == $limit) {
        $limit = "limit 0,1";
    } else {
        $limit = $wpdb->prepare(" limit 0,%d", esc_sql($limit));
    }

    if ('any' === $post_type) {
        $in_search_post_types = get_post_types(['exclude_from_search' => false]);
        if (empty($in_search_post_types)) {
            $where .= ' AND 1=0 ';
        } else {
            $where .= " AND {$wpdb->posts}.post_type IN ('" . join("', '",
                    array_map('esc_sql', $in_search_post_types)) . "')";
        }
    } elseif (!empty($post_type)) {
        $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_type = %s", esc_sql($post_type));
    }

    if (!empty($search)) {
        $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql($search) . '%');
    }

    $query = "select post_title,ID  from $wpdb->posts where post_status = 'publish' $where $limit";
    $results = $wpdb->get_results($query);
    if (!empty($results)) {
        foreach ($results as $row) {
            $data[$row->ID] = $row->post_title;
        }
    }
    return $data;
}


/**
 * Get all elementor page templates
 *
 * @param null $type
 *
 * @return array
 */
function get_elementor_templates($type = null)
{
    $options = [];

    if ($type) {
        $args = [
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ];
        $args['tax_query'] = [
            [
                'taxonomy' => 'elementor_library_type',
                'field' => 'slug',
                'terms' => $type,
            ],
        ];

        $page_templates = get_posts($args);

        if (!empty($page_templates) && !is_wp_error($page_templates)) {
            foreach ($page_templates as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }
    } else {
        $options = get_query_post_list('elementor_library');
    }

    return $options;
}

/**
 * Slugify
 */
if (!function_exists('raizen_slugify')){
    function raizen_slugify($text){
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}


// Use the following code to get ride of autop (automatic <p> tag) and line breaking tag (<br> tag).
add_filter( 'wpcf7_autop_or_not', '__return_false' );


//get course url from different lms plugins
function eduker_header_search_url() {
    if(class_exists( 'SFWD_LMS' )) {
        return esc_url( home_url( '/courses' ) );
    }
    elseif(class_exists( 'LearnPress' )) {
        return esc_url( home_url( '/lp-courses' ) );
    }
    else {
        return esc_url( home_url( '/courses' ) );
    }
}

/**
 * Return or echo blog share buttons HTML.
 * @author            bug-finder
 * atikulislam92@mail.com
 */
 
function raizen_get_share_buttons( $args = array() ) {
    $defaults = array(
        'networks' => array( 'facebook', 'twitter', 'linkedin' ),
        'url'      => get_permalink(),
        'title'    => get_the_title(),
        'echo'     => true,
        'class'    => 'raizen-blog-share',
    );

    $r = wp_parse_args( $args, $defaults );

    // Allow other plugins/themes to filter networks.
    $r['networks'] = (array) apply_filters( 'raizen_share_networks', $r['networks'] );

    $url   = rawurlencode( $r['url'] );
    $title = rawurlencode( $r['title'] );

    $items = array();

    foreach ( $r['networks'] as $network ) {
        $share_url = '';
        $icon = '';

        switch ( strtolower( $network ) ) {
            case 'facebook':
                $share_url = "https://www.facebook.com/sharer/sharer.php?u={$url}";
                $icon = 'fab fa-facebook-f';
                break;

            case 'twitter':
                $share_url = "https://twitter.com/intent/tweet?text={$title}&url={$url}";
                $icon = 'fab fa-twitter';
                break;

            case 'linkedin':
                $share_url = "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}";
                $icon = 'fab fa-linkedin-in';
                break;

            case 'pinterest':
                $share_url = "https://pinterest.com/pin/create/button/?url={$url}&description={$title}";
                $icon = 'fab fa-pinterest-p';
                break;

            case 'whatsapp':
                $share_url = "https://api.whatsapp.com/send?text={$title}%20{$url}";
                $icon = 'fab fa-whatsapp';
                break;

            default:
                /**
                 * Allow custom networks to be handled by other code.
                 * If a filter returns an array with 'url' and 'icon', use it.
                 */
                $custom = apply_filters( 'raizen_share_custom_network', null, $network, $r );
                if ( is_array( $custom ) && ! empty( $custom['url'] ) ) {
                    $share_url = $custom['url'];
                    $icon = isset( $custom['icon'] ) ? $custom['icon'] : '';
                }
                break;
        }

        if ( $share_url ) {
            $aria_label = sprintf( __( 'Share on %s', 'raizencore' ), ucfirst( $network ) );

            $items[] = sprintf(
                '<li><a href="%1$s" target="_blank" rel="nofollow noopener noreferrer" aria-label="%2$s">%3$s</a></li>',
                esc_url( $share_url ),
                esc_attr( $aria_label ),
                '<i class="' . esc_attr( $icon ) . '"></i>'
            );
        }
    }

    if ( empty( $items ) ) {
        if ( $r['echo'] ) {
            return;
        }
        return '';
    }

    $label = esc_html__( 'Share this post:', 'raizencore' );

    $output  = '<div class="' . esc_attr( $r['class'] ) . '">';
    $output .= '<p>' . $label . '</p>';
    $output .= '<ul class="social-icons">' . implode( '', $items ) . '</ul>';
    $output .= '</div>';

    if ( $r['echo'] ) {
        echo $output;
        return null;
    }

    return $output;
}

/**
 * Return Woocommerce share buttons HTML.
 * @author            bug-finder
 * atikulislam92@mail.com
 */

if ( ! function_exists( 'raizen_product_share_icons' ) ) {

    function raizen_product_share_icons( $post_id = null ) {

        $post_id = $post_id ? $post_id : get_the_ID();

        $url   = urlencode( get_permalink( $post_id ) );
        $title = urlencode( get_the_title( $post_id ) );
        $image = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );

        ob_start();
        ?>
        <ul class="raizen-share-icons">
            <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
            <li>
                <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( $url ); ?>&text=<?php echo esc_html( $title ); ?>" target="_blank" rel="noopener">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url( $url ); ?>&media=<?php echo esc_url( $image ); ?>&description=<?php echo esc_html( $title ); ?>" target="_blank" rel="noopener">
                    <i class="fab fa-pinterest-p"></i>
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $url ); ?>&title=<?php echo esc_html( $title ); ?>" target="_blank" rel="noopener">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </li>
            <li>
                <a href="https://www.tiktok.com/" target="_blank" rel="noopener">
                    <i class="fab fa-tiktok"></i>
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/" target="_blank" rel="noopener">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        </ul>
        <?php

        return ob_get_clean();
    }
}

/**
 * Return Dynamic CSS 
 * @author            bug-finder
 * atikulislam92@mail.com
 */


function raizen_dynamic_css() {

    // Get the ACF color field
    $color = get_field( 'menu_item_color', get_the_ID() );
    $button_color = get_field( 'menu_button_bg', get_the_ID() );

    // If ALL fields are empty, do nothing
    if ( empty( $color ) && empty( $button_color ) ) {
        return;
    }

    ?>
        <style type="text/css">
            <?php if ( ! empty( $color ) ) : ?>
                .site-header.style-1 .navigation > li > a {
                    color: <?php echo $color; ?> !important;
                    background-image: linear-gradient(to bottom, <?php echo $color; ?> 0, <?php echo $color; ?> 98%) !important;
                }
                .site-header.style-1 .main-menu .navigation li.dropdown .dropdown-btn{
                    color: <?php echo $color; ?> !important;
                }
            <?php endif; ?>
            
            <?php if ( ! empty( $button_color ) ) : ?>
                .site-header.style-1 .menu-button{
                    background-color: <?php echo $button_color; ?>;
                }
            <?php endif; ?>
        </style>
    <?php

}
add_action( 'wp_head', 'raizen_dynamic_css' );
