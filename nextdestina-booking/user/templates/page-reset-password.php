<?php

get_header();

$key   = sanitize_text_field($_GET['key'] ?? '');
$login = sanitize_user($_GET['login'] ?? '');

$user = check_password_reset_key($key, $login);

?>

<section class="sign-in">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
				<?php
				if (is_wp_error($user)) {
					?>
					<div class="alert alert-danger" role="alert">
						<?php esc_html_e('Invalid or expired reset link.', 'nextdestina-booking'); ?>
					</div>
					<?php
				} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					$pass1 = $_POST['pass1'] ?? '';
					$pass2 = $_POST['pass2'] ?? '';

					if ($pass1 !== $pass2) {
						?>
						<div class="alert alert-danger" role="alert">
							<?php esc_html_e('Passwords do not match.', 'nextdestina-booking'); ?>
						</div>
						<?php
					} else if (strlen($pass1) < 6) {
						?>
						<div class="alert alert-warning" role="alert">
							<?php esc_html_e('Password must be at least 6 characters.', 'nextdestina-booking'); ?>
						</div>
						<?php
					} else {
						reset_password($user, $pass1);
						?>
						<div class="alert alert-success" role="alert">
							<?php esc_html_e('Password successfully reset.', 'nextdestina-booking') ?>
						</div>
						<a href="<?php echo site_url('/traveler-login/'); ?>" class="btn-1"><?php esc_html_e('Sign In'); ?></a>
						<?php
						return;
					}
				}
				?>
                <div class="sign-in-container">
                    <div class="sign-in-container-inner">
                        <div class="sign-in-logo mb_30">
                            <?php nextdestina_header_logo(); ?>
                        </div>
                        <div class="sign-in-title">
                            <h3 class="mb_15"><?php esc_html_e('Reset Your Password', 'nextdestina-booking'); ?></h3>
                        </div>

                        <div class="sign-in-form">
                            <form method="post">
                                <div class="sign-in-form-group">
                                    <label for="pass1"><?php esc_html_e('New Password', 'nextdestina-booking'); ?></label>
                                    <div class="password-box">
                                    	<input type="password" id="pass1" name="pass1" class="sign-in-input password" placeholder="<?php esc_attr_e('Enter password...', 'nextdestina-booking'); ?>" required>
                                    	<i class="password-icon fa-regular fa-eye"></i>
                                	</div>
                                </div>

                                <div class="sign-in-form-group">
                                    <label for="pass2"><?php esc_html_e('Confirm New Password', 'nextdestina-booking'); ?></label>
                                    <div class="password-box">
                                        <input type="password" id="pass2" name="pass2" class="sign-in-input password" placeholder="<?php esc_attr_e('Enter Password...', 'nextdestina-booking'); ?>" required>
                                        <i class="password-icon fa-regular fa-eye"></i>
                                    </div>
                                </div>

                                <div class="sign-in-btn">
                                    <button type="submit" class="btn-1">
                                        <?php esc_html_e('Reset Password', 'nextdestina-booking'); ?> <span></span>
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
