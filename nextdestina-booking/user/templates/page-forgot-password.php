<?php

if (!defined('ABSPATH')) exit;

get_header();
        
        $email_notification = get_option('email_notification');
        
        $traveler_email_template = get_posts([
            'post_type'      => 'email_template',
            'title'          => 'Traveler',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ]);
        $traveler_template_id = !empty($traveler_email_template) ? $traveler_email_template[0]->ID : 0;

        $send_email = get_post_meta($traveler_template_id, '_user_pass_reset_switch', true);

?>

<section class="sign-in">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_login'])) {
                    $user_login = sanitize_text_field($_POST['user_login']);
                    $user = get_user_by('login', $user_login);
                    if (!$user && is_email($user_login)) {
                        $user = get_user_by('email', $user_login);
                    }

                    if ($user) {
                        if (in_array('traveler', (array)$user->roles)) {
                            $reset_key = get_password_reset_key($user);
                            if (!is_wp_error($reset_key)) {
                                $reset_url = home_url('/traveler-reset-password/?key=' . $reset_key . '&login=' . rawurlencode($user->user_login));
                                
                                if ($email_notification == 1) {
                                    if ($send_email === 'yes') {
                                        if ( Nextdestina_Global_Functions::is_wp_mail_smtp_configured() ) {
                                            wp_mail($user->user_email, 'Reset Your Password', "Click the link to reset your password:\n\n$reset_url");
                                        }
                                    }
                                }
                                ?>
                                <div class="alert alert-info" role="alert">
                                    <?php esc_html_e('Check your email for the reset link.', 'nextdestina-booking'); ?>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php esc_html_e('Could not generate reset key.', 'nextdestina-booking'); ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-warning" role="alert">
                                <?php esc_html_e('Only travelers can reset password here.', 'nextdestina-booking'); ?>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="alert alert-secondary" role="alert">
                            <?php esc_html_e('The selected email is invalid.', 'nextdestina-booking'); ?>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="sign-in-container">
                    <div class="sign-in-container-inner">
                        <div class="sign-in-logo mb_30">
                            <?php nextdestina_header_logo(); ?>
                        </div>
                        <div class="sign-in-title">
                            <h3 class="mb_15"><?php esc_html_e('Reset Password', 'nextdestina-booking'); ?></h3>
                        </div>

                        <div class="sign-in-form">
                            <form method="post">
                                <div class="sign-in-form-group">
                                    <label for="user_login"><?php esc_html_e('Email Address', 'nextdestina-booking'); ?></label>
                                    <input type="text" id="user_login" name="user_login" class="sign-in-input" placeholder="<?php esc_attr_e('Enter your email...', 'nextdestina-booking'); ?>" required>
                                </div>

                                <div class="sign-in-btn">
                                    <button type="submit" class="btn-1">
                                        <?php esc_html_e('Send Reset Link', 'nextdestina-booking'); ?> <span></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="sign-in-image text-end">
                    <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . '/assets/img/sign-in.jpg'); ?>" alt="Sign In">
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
