<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Nextdestina_Global_Functions {

    /**
     * Initialize hooks.
     */
    public function __construct() {
        add_action( 'init', array( $this, 'init_hooks' ) );
    }

    /**
     * Optional future hooks
     */
    public function init_hooks() {
        // Reserved for future use if needed (e.g. shortcode or block support)
    }

    /**
     * Display the average rating stars and count.
     *
     * @param int|null $tour_id Tour Post ID. Defaults to current post.
     */
    public function render_rating_summary( $tour_id = null ) {
        global $wpdb;

        if ( ! $tour_id ) {
            $tour_id = get_the_ID();
        }

        $table = $wpdb->prefix . 'tour_ratings';

        $average = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT AVG(rating) FROM $table WHERE tour_id = %d AND status = %s",
                $tour_id,
                'approved'
            )
        );

        $count = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM $table WHERE tour_id = %d AND status = %s",
                $tour_id,
                'approved'
            )
        );

        $average = $average ? round( (float) $average, 1 ) : 0;

        echo '<div class="tour-rating-summary">';
			echo '<div class="rating-stars">';
				for ( $i = 1; $i <= 5; $i++ ) {
					if ( $average >= $i ) {
						echo '<span class="star filled"><i class="fas fa-star text-warning"></i></span>';
					} elseif ( $average >= ( $i - 0.5 ) ) {
						echo '<span class="star half"><i class="fas fa-star-half-alt text-warning"></i></span>';
					} else {
						echo '<span class="star"><i class="far fa-star text-warning"></i></span>';
					}
				}
			echo '</div>';

			echo '<div class="rating-meta">';
				echo '<span>(' . intval( $count ) . ' ' . _n( 'review', 'reviews', $count, 'nextdestina-booking' ) . ')</span>';
			echo '</div>';
		echo '</div>';
    }

    /**
     * Invoice
     */

    public function nextdestina_generate_invoice($booking_id, $user_id, $amount_paid) {
        $invoice_id = wp_insert_post([
            'post_type'   => 'invoice',
            'post_status' => 'publish',
            'post_title'  => 'Invoice for Booking #' . $booking_id,
            'meta_input'  => [
                '_booking_id' => $booking_id,
                '_user_id'    => $user_id,
                '_amount'     => $amount_paid,
                '_invoice_date' => current_time('mysql'),
                '_invoice_status' => 'paid',
                '_invoice_number' => uniqid('INV-'),
            ]
        ]);

        return $invoice_id;
    }

    public function get_invoice_id_by_booking_id($booking_id) {
        $args = [
            'post_type'      => 'invoice',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
            'meta_query'     => [
                [
                    'key'   => '_booking_id',
                    'value' => $booking_id,
                ],
            ],
        ];

        $invoice = get_posts($args);

        return !empty($invoice) ? $invoice[0]->ID : false;
    }

    /**
     * Mail SMTP configure
     */

    public static function is_wp_mail_smtp_configured() {

        $opts = get_option('wp_mail_smtp');

        // Must have a mailer selected (and not the default "mail")
        $mailer = isset($opts['mail']['mailer']) ? $opts['mail']['mailer'] : 'mail';
        if ($mailer === 'mail') {
            return false;
        }

        // Normalize some legacy/alt slugs
        $normalized = [
            'sendinblue' => 'brevo',
            'smtp_com'   => 'smtpcom',
            'amazon_ses' => 'amazonses',
        ];
        if (isset($normalized[$mailer])) {
            $mailer = $normalized[$mailer];
        }

        switch ($mailer) {
            case 'smtp':
                // Host is the minimum; if auth is enabled, need user+pass (or const password)
                if (empty($opts['smtp']['host'])) {
                    return false;
                }
                $auth = isset($opts['smtp']['auth']) ? $opts['smtp']['auth'] : 'yes';
                if ($auth === 'yes') {
                    return !empty($opts['smtp']['user']) &&
                    (!empty($opts['smtp']['pass']) || defined('WPMS_ONESMTP_PASSWORD'));
                }
                return true;

            // API-key mailers
            case 'sendgrid':
            case 'sendlayer':
            case 'elasticemail':
            case 'smtp2go':
                return !empty($opts[$mailer]['api_key']);

            // Mailers with extra required fields
            case 'mailgun':
                return !empty($opts['mailgun']['api_key']) && !empty($opts['mailgun']['domain']);

            case 'mailjet':
                return !empty($opts['mailjet']['api_key']) && !empty($opts['mailjet']['secret_key']);

            case 'postmark':
                return !empty($opts['postmark']['server_api_token']);

            case 'sparkpost':
                return !empty($opts['sparkpost']['api_key']);

            case 'smtpcom':
                return !empty($opts['smtpcom']['api_key']);

            case 'brevo':
                return !empty($opts['brevo']['api_key']);

            // OAuth mailers (client credentials present = "configured enough" to try)
            case 'gmail':
            case 'outlook':
            case 'zoho':
                return !empty($opts[$mailer]['client_id']) && !empty($opts[$mailer]['client_secret']);

            case 'amazonses':
                return !empty($opts['amazonses']['access_key']) && !empty($opts['amazonses']['secret_key']);

            default:
                // Fallback: consider configured if there’s any non-empty scalar in that section
                if (!empty($opts[$mailer]) && is_array($opts[$mailer])) {
                    foreach ($opts[$mailer] as $v) {
                        if (is_string($v) && $v !== '') {
                            return true;
                        }
                    }
                }
                return false;
        }
    }

}
