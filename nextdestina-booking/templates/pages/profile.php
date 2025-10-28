<?php
/**
 * Dashboard Profile Page
 *
 * @package TravelerDashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$current_user = wp_get_current_user();
$user_id = $current_user->ID;

// Get current meta values

$phone        = get_user_meta($user_id, 'phone', true);
$address      = get_user_meta($user_id, 'address', true);
$state        = get_user_meta($user_id, 'state', true);
$zipcode      = get_user_meta($user_id, 'zipcode', true);
$country      = get_user_meta($user_id, 'country', true);
$language     = get_user_meta($user_id, 'language', true);
$timezone     = get_user_meta($user_id, 'timezone', true);


// Get profile image
$profile_img_id = get_user_meta($user_id, 'profile_picture', true);
if ( $profile_img_id ) {
    $profile_img_html = wp_get_attachment_image($profile_img_id, 'thumbnail', false, [
        'id'    => 'profile-img',
        'class' => 'profile-img rounded-circle',
        'alt'   => esc_attr__('Profile Image', 'nextdestina-booking')
    ]);
} else {
    $profile_img_html = get_avatar($user_id, 100, '', '', [
        'class' => 'profile-img rounded-circle',
        'id'    => 'profile-img',
        'alt'   => esc_attr__('Profile Image', 'nextdestina-booking')
    ]);
}

?>

<div class="dashboard-profile">
    <div class="row">
        <div class="col-xxl-8 col-xl-10 mx-auto">

            <?php if ( isset($_GET['updated']) && $_GET['updated'] === 'true' ) : ?>
                <div class="alert alert-success"><?php esc_html_e('Profile updated successfully!', 'nextdestina-booking'); ?></div>
            <?php endif; ?>

            <div class="breadcrumb-area">
                <h3 class="title"><?php esc_html_e('Profile', 'nextdestina-booking'); ?></h3>
            </div>
            <div class="account-settings-navbar">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile-tab-pane" role="tab">
                            <i class="fa-regular fa-user"></i> <?php esc_html_e('Profile', 'nextdestina-booking'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password-tab-pane" role="tab">
                            <i class="fa-regular fa-link"></i> <?php esc_html_e('Password', 'nextdestina-booking'); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel">
                    <form method="post" enctype="multipart/form-data">
                        <?php wp_nonce_field('update_user_profile', 'user_profile_nonce'); ?>
                        <div class="account-settings-profile-section">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><?php esc_html_e('Profile Details', 'nextdestina-booking'); ?></h5>
                                    <div class="profile-details-section">
                                        <div class="d-flex gap-3 align-items-center">
                                            <div class="image-area">
                                                <?php echo $profile_img_html; ?>
                                            </div>
                                            <div class="btn-area">
                                                <div class="btn-area-inner d-flex">
                                                    <div class="cmn-file-input">
                                                        <label for="formFile" class="form-label">
                                                            <span class="d-sm-none"><i class="fa-regular fa-circle-plus"></i></span>
                                                            <span class="d-none d-sm-block"><?php esc_html_e('Upload New Photo', 'nextdestina-booking'); ?></span>
                                                        </label>
                                                        <input class="form-control" type="file" name="profile_picture" id="formFile" onchange="previewImage()">
                                                    </div>
                                                    <button type="button" class="cmn-btn3" onclick="resetPreviewImage()">
                                                        <?php esc_html_e('Reset', 'nextdestina-booking'); ?>
                                                    </button>
                                                </div>
                                                <small><?php esc_html_e('Allowed JPG, GIF or PNG. Max size of 800K', 'nextdestina-booking'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="profile-form-section">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="firstname" class="form-label"><?php esc_html_e('First Name', 'nextdestina-booking'); ?></label>
                                                <input type="text" name="first_name" value="<?php echo esc_attr( $current_user->first_name ); ?>" class="form-control" id="firstname">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastname" class="form-label"><?php esc_html_e('last name', 'nextdestina-booking'); ?></label>
                                                <input type="text" name="last_name" value="<?php echo esc_attr( $current_user->last_name ); ?>" class="form-control" id="lastname">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="e-mail" class="form-label"><?php esc_html_e('e-mail', 'nextdestina-booking'); ?></label>
                                                <input type="email" name="email" value="<?php echo esc_attr( $current_user->user_email ); ?>" class="form-control" id="e-mail">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phonenumber" class="form-label"><?php esc_html_e('phone number', 'nextdestina-booking'); ?></label>
                                                <input type="tel" id="phonenumber" name="phone" class="form-control" value="<?php echo esc_attr($phone); ?>">
                                                <input type="hidden" name="full_phone" id="full_phone">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address" class="form-label"><?php esc_html_e('address', 'nextdestina-booking'); ?></label>
                                                <input type="text" name="address" class="form-control" id="address" value="<?php echo esc_attr($address); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="state" class="form-label"><?php esc_html_e('state', 'nextdestina-booking'); ?></label>
                                                <input type="text" name="state" class="form-control" id="state" value="<?php echo esc_attr($state); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="zipcode" class="form-label"><?php esc_html_e('zip code', 'nextdestina-booking'); ?></label>
                                                <input type="text" name="zipcode" class="form-control" id="zipcode" value="<?php echo esc_attr($zipcode); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label"><?php esc_html_e('country', 'nextdestina-booking'); ?></label>
                                                <select class="cmn-select2" name="country">
                                                    <option value=""><?php esc_html_e('Select', 'nextdestina-booking'); ?></option>
                                                    <option value="Bangladesh" <?php selected($country, 'Bangladesh'); ?>><?php esc_html_e('Bangladesh', 'nextdestina-booking'); ?></option>
                                                    <option value="Australia" <?php selected($country, 'Australia'); ?>><?php esc_html_e('Australia', 'nextdestina-booking'); ?></option>
                                                    <option value="Belarus" <?php selected($country, 'Belarus'); ?>><?php esc_html_e('Belarus', 'nextdestina-booking'); ?></option>
                                                    <option value="Canada" <?php selected($country, 'Canada'); ?>><?php esc_html_e('Canada', 'nextdestina-booking'); ?></option>
                                                    <option value="China" <?php selected($country, 'China'); ?>><?php esc_html_e('China', 'nextdestina-booking'); ?></option>
                                                    <option value="France" <?php selected($country, 'France'); ?>><?php esc_html_e('France', 'nextdestina-booking'); ?></option>
                                                    <option value="Germany" <?php selected($country, 'Germany'); ?>><?php esc_html_e('Germany', 'nextdestina-booking'); ?></option>
                                                    <option value="India" <?php selected($country, 'India'); ?>><?php esc_html_e('India', 'nextdestina-booking'); ?></option>
                                                    <option value="Indonesia" <?php selected($country, 'Indonesia'); ?>><?php esc_html_e('Indonesia', 'nextdestina-booking'); ?></option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label"><?php esc_html_e('language', 'nextdestina-booking'); ?></label>
                                                <select class="cmn-select2" name="language">
                                                    <option value=""><?php esc_html_e('Select Language', 'nextdestina-booking'); ?></option>
                                                    <option value="English" <?php selected($language, 'English'); ?>><?php esc_html_e('English', 'nextdestina-booking'); ?></option>
                                                    <option value="Spanish" <?php selected($language, 'Spanish'); ?>><?php esc_html_e('Spanish', 'nextdestina-booking'); ?></option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                    <label class="form-label"><?php esc_html_e('Time zone', 'nextdestina-booking'); ?></label>
                                                    <select class="cmn-select2" name="timezone">
                                                        <option value=""><?php esc_html_e('Select Timezone', 'nextdestina-booking'); ?></option>
                                                        <option value="Universal" <?php selected($timezone, 'Universal'); ?>><?php esc_html_e('(UTC ±00:00) Coordinated Universal Time', 'nextdestina-booking'); ?></option>
                                                        <option value="Toronto" <?php selected($timezone, 'Toronto'); ?>><?php esc_html_e('(UTC −05:00) New York, Toronto', 'nextdestina-booking'); ?></option>
                                                        <option value="Vancouver" <?php selected($timezone, 'Vancouver'); ?>><?php esc_html_e('(UTC −08:00) Los Angeles, Vancouver', 'nextdestina-booking'); ?></option>
                                                        <option value="Shanghai" <?php selected($timezone, 'Shanghai'); ?>><?php esc_html_e('(UTC +08:00) Beijing, Shanghai', 'nextdestina-booking'); ?></option>
                                                        <option value="Mumbai" <?php selected($timezone, 'Mumbai'); ?>><?php esc_html_e('(UTC +05:30) Delhi, Mumbai', 'nextdestina-booking'); ?></option>
                                                        <option value="California" <?php selected($timezone, 'California'); ?>><?php esc_html_e('(GMT-08:00) Tijuana, Baja California', 'nextdestina-booking'); ?></option>
                                                        <option value="Arizona" <?php selected($timezone, 'Arizona'); ?>><?php esc_html_e('(GMT-07:00) Arizona', 'nextdestina-booking'); ?></option>
                                                        <option value="Mazatlan" <?php selected($timezone, 'Mazatlan'); ?>><?php esc_html_e('(GMT-07:00) Chihuahua, La Paz, Mazatlan', 'nextdestina-booking'); ?></option>
                                                        <option value="US" <?php selected($timezone, 'US'); ?>><?php esc_html_e('(GMT-07:00) Mountain Time (US & Canada)', 'nextdestina-booking'); ?></option>
                                                        <option value="America" <?php selected($timezone, 'America'); ?>><?php esc_html_e('(GMT-06:00) Central America', 'nextdestina-booking'); ?></option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="btn-area d-flex g-3">
                                            <button type="submit" name="submit_profile" class="cmn-btn"><?php esc_html_e('save changes', 'nextdestina-booking'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="password-tab-pane" role="tabpanel">
                    <form method="post">
                        <?php wp_nonce_field('update_user_password', 'user_password_nonce'); ?>

                        <?php if (isset($_GET['status'])): ?>
                            <div id="password-alert" class="alert 
                                <?php echo $_GET['status'] === 'success' ? 'alert-success' : 'alert-danger'; ?>">
                                <?php
                                switch ($_GET['status']) {
                                    case 'success':
                                        echo 'Password updated successfully. Please log in again.';
                                        break;
                                    case 'wrong_old':
                                        echo 'Old password is incorrect.';
                                        break;
                                    case 'mismatch':
                                        echo 'New and confirm password do not match.';
                                        break;
                                    case 'empty_fields':
                                        echo 'All fields are required.';
                                        break;
                                    default:
                                        echo 'Something went wrong.';
                                }
                                ?>
                            </div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><?php esc_html_e('Change Password', 'nextdestina-booking'); ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="old_password" class="form-label"><?php esc_html_e('Old Password', 'nextdestina-booking'); ?></label>
                                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="new_password" class="form-label"><?php esc_html_e('New Password', 'nextdestina-booking'); ?></label>
                                        <input type="password" name="new_password" class="form-control" id="new_password">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="confirm_password" class="form-label"><?php esc_html_e('Confirm Password', 'nextdestina-booking'); ?></label>
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                    </div>
                                </div>
                                <div class="btn-area d-flex g-3 mt-4">
                                    <button type="submit" name="submit_password" class="cmn-btn"><?php esc_html_e('Update Password', 'nextdestina-booking'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$reset_img_url = $profile_img_id
    ? wp_get_attachment_image_url($profile_img_id, 'thumbnail')
    : get_avatar_url($user_id);
?>
<script>
function previewImage() {
    const input = document.getElementById('formFile');
    const img = document.getElementById('profile-img');
    const file = input.files[0];

    if (file && img) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

function resetPreviewImage() {
    const input = document.getElementById('formFile');
    const img = document.getElementById('profile-img');
    input.value = '';
    img.src = '<?php echo esc_url($reset_img_url); ?>';
}

// Phone country code (+880)

document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector("#phonenumber");
    const fullPhone = document.querySelector("#full_phone");

    if (!input) return;

    const iti = window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("us"));
        },
        separateDialCode: true,
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17/build/js/utils.js"
    });

    // On submit, populate full international number
    input.form.addEventListener('submit', function () {
        fullPhone.value = iti.getNumber(); // E.g., +880123456789
    });

    // Set fullPhone value initially (when editing)
    setTimeout(() => {
        fullPhone.value = iti.getNumber();
    }, 500);
});

</script>