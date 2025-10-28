<?php

get_header();

?>

<section class="sign-in">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <?php
                if (isset($_GET['register']) && $_GET['register'] === 'pending_verification') {
                    ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?php esc_html_e('Please check your email to verify your account.', 'nextdestina-booking'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                if (isset($_GET['verify']) && $_GET['verify'] === 'success') {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php esc_html_e('Your email is verified. You can now log in.', 'nextdestina-booking'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <div class="sign-in-container">
                    <div class="sign-in-container-inner">
                        <div class="sign-in-logo mb_30">
                            <?php nextdestina_header_logo(); ?>
                        </div>
                        <div class="sign-in-title">
                            <h3 class="mb_15"><?php esc_html_e('Welcome back, Sign In', 'nextdestina-booking'); ?></h3>
                            <p><?php esc_html_e('Sign in to your account and make booking faster and easier.', 'nextdestina-booking'); ?></p>
                        </div>

                        <div class="sign-in-form">
                            <form method="post">
                                <?php wp_nonce_field('traveler_login_action', 'traveler_login_nonce'); ?>

                                <div class="sign-in-form-group">
                                    <label for="username_email"><?php esc_html_e('Username or Email', 'nextdestina-booking'); ?></label>
                                    <input type="text" id="username_email" name="username_email" class="sign-in-input" placeholder="<?php esc_attr_e('Enter your email...', 'nextdestina-booking'); ?>" required>
                                </div>

                                <div class="sign-in-form-group">
                                    <label for="password"><?php esc_html_e('Password', 'nextdestina-booking'); ?></label>
                                    <div class="password-box">
                                        <input type="password" id="password" name="password" class="sign-in-input password" placeholder="<?php esc_attr_e('Password...', 'nextdestina-booking'); ?>" required>
                                        <i class="password-icon fa-regular fa-eye"></i>
                                    </div>
                                </div>

                                <div class="rember">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="rememberme" id="rememberme">
                                        <label for="rememberme"><?php esc_html_e('Remember me', 'nextdestina-booking'); ?></label>
                                    </div>
                                    <div class="forget-password">
                                        <a href="<?php echo esc_url(home_url('/traveler-forgot-password/')); ?>">
                                            <?php esc_html_e('Forgot Password?', 'nextdestina-booking'); ?>
                                        </a>
                                    </div>
                                </div>

                                <div class="sign-in-btn">
                                    <button type="submit" name="traveler_login" class="btn-1">
                                        <?php esc_html_e('Sign In', 'nextdestina-booking'); ?> <span></span>
                                    </button>
                                </div>
                            </form>
                            <div class="login-error">
                                <?php
                                    if (isset($_GET['login'])) {
                                        if (sanitize_text_field($_GET['login']) === 'failed') {
                                            ?><p><?php esc_html_e('Login failed. Please check your credentials.', 'nextdestina-booking'); ?></p><?php
                                        }elseif(sanitize_text_field($_GET['login']) === 'not_allowed'){
                                            ?><p><?php esc_html_e('Access denied. Only travelers can log in here.', 'nextdestina-booking'); ?></p><?php
                                        }
                                    }
                                ?>
                            </div>
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
