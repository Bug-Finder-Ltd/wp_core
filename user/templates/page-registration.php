<?php

get_header();

?>

    <section class="sign-in">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="sign-in-container">
                        <div class="sign-in-container-inner">
                            <div class="sign-in-logo mb_30">
                                <?php nextdestina_header_logo(); ?>
                            </div>
                            <div class="sign-in-title">
                                <h3 class="mb_15"><?php esc_html_e('Creative Account', 'nextdestina-booking'); ?></h3>
                                <p><?php esc_html_e('Discover the world’s best travel agency for making your adventure great with Explora.', 'nextdestina-booking'); ?></p>
                            </div>
                            <div class="sign-in-form">
                                <form method="post">
                                    <?php wp_nonce_field('traveler_register_action', 'traveler_register_nonce'); ?>
                                    <input type="hidden" name="traveler_register" value="1">
                                    <div class="sign-in-form-name">
                                        <div class="sign-in-form-group">
                                            <label for="first_name"><?php esc_html_e('First Name', 'nextdestina-booking'); ?></label>
                                            <input type="text" id="first_name" name="first_name" class="sign-in-input" placeholder="<?php esc_html_e('First Name', 'nextdestina-booking'); ?>" required>
                                        </div>
                                        <div class="sign-in-form-group">
                                            <label for="last_name"><?php esc_html_e('Last Name', 'nextdestina-booking'); ?></label>
                                            <input type="text" id="last_name" name="last_name" class="sign-in-input" placeholder="<?php esc_html_e('Last Name', 'nextdestina-booking'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="sign-in-form-group">
                                        <label for="username"><?php esc_html_e('Username', 'nextdestina-booking'); ?></label>
                                        <input type="text" id="username" name="username" class="sign-in-input" placeholder="<?php esc_html_e('Enter Username', 'nextdestina-booking'); ?>" required>
                                    </div>
                                    <div class="sign-in-form-group">
                                        <label for="email"><?php esc_html_e('Email', 'nextdestina-booking'); ?></label>
                                        <input type="email" id="email" name="email" class="sign-in-input" placeholder="<?php esc_html_e('Enter Email', 'nextdestina-booking'); ?>" required>
                                    </div>
                                    <div class="sign-in-form-group">
                                        <label for="phone"><?php esc_html_e('Phone', 'nextdestina-booking'); ?></label>
                                        <input type="tel" id="phone" name="phone" class="sign-in-input" placeholder="<?php esc_html_e('Enter Phone Number', 'nextdestina-booking'); ?>">
                                    </div>
                                    <div class="sign-in-form-group">
                                        <label for="password"><?php esc_html_e('Password', 'nextdestina-booking'); ?></label>
                                        <div class="password-box">
                                            <input type="password" id="password" name="password" class="sign-in-input password" placeholder="<?php esc_html_e('Password...', 'nextdestina-booking'); ?>" required>
                                            <i class="password-icon fa-regular fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="rember">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="rememberme" id="rememberme">
                                            <label for="rememberme"><?php esc_html_e('Remember me', 'nextdestina-booking'); ?></label>
                                        </div>
                                    </div>
                                    <div class="sign-in-btn">
                                        <button type="submit" name="traveler_register" class="btn-1"><?php esc_html_e('Create Account', 'nextdestina-booking'); ?> <span></span></button>
                                    </div>
                                </form>

                                <div class="login-error">
                                    <?php if ( isset($_GET['register']) && $_GET['register'] === 'success' ) : ?>
                                        <p class="success-msg"><?php esc_html_e('Registration successful! Please log in.', 'nextdestina-booking'); ?></p>
                                    <?php elseif ( isset($_GET['error']) && $_GET['error'] === 'exists' ) : ?>
                                        <p class="error-msg"><?php esc_html_e('Username or email already exists.', 'nextdestina-booking'); ?></p>
                                    <?php elseif ( isset($_GET['error']) && $_GET['error'] === 'failed' ) : ?>
                                        <p class="error-msg"><?php esc_html_e('Registration failed. Try again.', 'nextdestina-booking'); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="media-login">
                                    <div class="media-login-border"><h5><?php esc_html_e('OR', 'nextdestina-booking'); ?></h5></div>
                                    <div class="signup-account">
                                        <p><?php esc_html_e('Already have an account ?', 'nextdestina-booking'); ?> <a href="<?php echo site_url('/traveler-login/'); ?>"><?php esc_html_e('Sign In', 'nextdestina-booking'); ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="sign-in-image text-end">
                        <?php echo '<img src="'.esc_url( trailingslashit(get_template_directory_uri()) . '/assets/img/sign-in-2.jpg' ).'">'; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
