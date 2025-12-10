<?php

class Raizen_Instagram_API {

    public static function get_media( $access_token, $limit = 6 ) {

        $endpoint = "https://graph.instagram.com/me/media?fields=id,caption,media_url,permalink&access_token={$access_token}&limit={$limit}";

        $response = wp_remote_get( $endpoint );

        if ( is_wp_error( $response ) ) return [];

        $data = json_decode( wp_remote_retrieve_body( $response ), true );

        return !empty( $data['data'] ) ? $data['data'] : [];
    }
}