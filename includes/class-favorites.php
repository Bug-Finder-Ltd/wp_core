<?php
if (!defined('ABSPATH')) exit;

class Nextdestina_Favorites {
    private static $meta_key = 'favorite_tours';

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_ajax_toggle_favorite', [$this, 'handle_ajax']);
        add_action('wp_ajax_nopriv_toggle_favorite', [$this, 'handle_ajax']);
    }

    public function enqueue_scripts() {
        if ( ! is_post_type_archive('tour') && ! get_query_var('traveler_dashboard') ) {
            return;
        }

        wp_enqueue_script(
            'traveler-favorites',
            TRAVELER_DASHBOARD_PLUGIN_URL . 'assets/js/favorites.js',
            ['jquery'],
            TRAVELER_DASHBOARD_VERSION,
            true
        );

        wp_localize_script('traveler-favorites', 'TravelerFavoritesData', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('traveler_favorite_nonce')
        ]);
    }

    public function handle_ajax() {
        check_ajax_referer('traveler_favorite_nonce', 'nonce');

        $post_id = absint($_POST['post_id']);
        if (!$post_id || get_post_type($post_id) !== 'tour') {
            wp_send_json_error(['message' => 'Invalid tour.']);
        }

        if (is_user_logged_in()) {
            $user_id  = get_current_user_id();
            $favorites = get_user_meta($user_id, self::$meta_key, true);
            $favorites = is_array($favorites) ? $favorites : [];

            if (isset($favorites[$post_id])) {
                unset($favorites[$post_id]);
                update_user_meta($user_id, self::$meta_key, $favorites);
                wp_send_json_success(['status' => 'removed']);
            } else {
                $favorites[$post_id] = current_time('mysql');
                update_user_meta($user_id, self::$meta_key, $favorites);
                wp_send_json_success(['status' => 'added']);
            }
        } else {
            $cookie = isset($_COOKIE['favorite_tours']) ? json_decode(stripslashes($_COOKIE['favorite_tours']), true) : [];
            $cookie = is_array($cookie) ? $cookie : [];

            if (in_array($post_id, $cookie)) {
                $cookie = array_diff($cookie, [$post_id]);
                setcookie('favorite_tours', json_encode(array_values($cookie)), time() + 3600 * 24 * 30, '/');
                wp_send_json_success(['status' => 'removed']);
            } else {
                $cookie[] = $post_id;
                setcookie('favorite_tours', json_encode(array_values($cookie)), time() + 3600 * 24 * 30, '/');
                wp_send_json_success(['status' => 'added']);
            }
        }

        wp_die();
    }

    public static function get_user_favorites() {
        if (is_user_logged_in()) {
            $user_id   = get_current_user_id();
            $favorites = get_user_meta($user_id, self::$meta_key, true);
            return is_array($favorites) ? $favorites : [];
        } else {
            // For guest users, no date is stored — just return array with null dates
            $cookie = isset($_COOKIE['favorite_tours']) ? json_decode(stripslashes($_COOKIE['favorite_tours']), true) : [];
            $cookie = is_array($cookie) ? $cookie : [];

            $mapped = [];
            foreach ($cookie as $id) {
                $mapped[$id] = null;
            }
            return $mapped;
        }
    }
}
