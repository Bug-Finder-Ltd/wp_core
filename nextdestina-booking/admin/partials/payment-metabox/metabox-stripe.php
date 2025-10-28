<?php
$stripe_secret_key      = get_post_meta($post->ID, '_stripe_secret_key', true);
$stripe_publishable_key = get_post_meta($post->ID, '_stripe_publishable_key', true);
$stripe_percentage_charge = get_post_meta($post->ID, '_stripe_percentage_charge', true);
$stripe_fixed_charge = get_post_meta($post->ID, '_stripe_fixed_charge', true);
?>

<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('Parameters', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="stripe_secret_key"><?php esc_html_e('Secret Key', 'nextdestina-booking'); ?></label>
            <div class="secret-input-wrapper">
                <input type="password" name="_stripe_secret_key" id="stripe_secret_key" value="<?php echo esc_attr($stripe_secret_key); ?>">
                <span class="toggle-secret"><i class="dashicons dashicons-visibility"></i></span>
            </div>
        </div>
        <div class="field">
            <label for="stripe_publishable_key"><?php esc_html_e('Publishable Key', 'nextdestina-booking'); ?></label>
            <div class="secret-input-wrapper">
                <input type="password" name="_stripe_publishable_key" id="stripe_publishable_key" value="<?php echo esc_attr($stripe_publishable_key); ?>">
                <span class="toggle-secret"><i class="dashicons dashicons-visibility"></i></span>
            </div>
        </div>
        <div class="field">
            <label for="stripe_percentage_charge"><?php esc_html_e('Percentage Charge', 'nextdestina-booking'); ?></label>
            <div class="secret-input-wrapper">
                <input type="text" name="_stripe_percentage_charge" id="stripe_percentage_charge" value="<?php echo esc_attr($stripe_percentage_charge); ?>">
            </div>
        </div>
        <div class="field">
            <label for="stripe_fixed_charge"><?php esc_html_e('Fixed Charge', 'nextdestina-booking'); ?></label>
            <div class="secret-input-wrapper">
                <input type="text" name="_stripe_fixed_charge" id="stripe_fixed_charge" value="<?php echo esc_attr($stripe_fixed_charge); ?>">
            </div>
        </div>
    </div>
</div>
