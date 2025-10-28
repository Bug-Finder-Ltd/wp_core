<?php
$paypal_client_id      = get_post_meta($post->ID, '_paypal_client_id', true);
$paypal_secret = get_post_meta($post->ID, '_paypal_secret', true);
$paypal_percentage_charge = get_post_meta($post->ID, '_paypal_percentage_charge', true);
$paypal_fixed_charge = get_post_meta($post->ID, '_paypal_fixed_charge', true);
?>

<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('Parameters', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="paypal_client_id"><?php esc_html_e('Client Id', 'nextdestina-booking'); ?></label>
            <input type="text" name="_paypal_client_id" id="paypal_client_id" value="<?php echo esc_attr($paypal_client_id); ?>">
        </div>
        <div class="field">
            <label for="paypal_secret"><?php esc_html_e('Secret', 'nextdestina-booking'); ?></label>
            <div class="secret-input-wrapper">
                <input type="password" name="_paypal_secret" id="paypal_secret" value="<?php echo esc_attr($paypal_secret); ?>">
                <span class="toggle-secret"><i class="dashicons dashicons-visibility"></i></span>
            </div>
        </div>
        <div class="field">
            <label for="paypal_percentage_charge"><?php esc_html_e('Percentage Charge', 'nextdestina-booking'); ?></label>
            <div class="secret-input-wrapper">
                <input type="text" name="_paypal_percentage_charge" id="paypal_percentage_charge" value="<?php echo esc_attr($paypal_percentage_charge); ?>">
            </div>
        </div>
        <div class="field">
            <label for="paypal_fixed_charge"><?php esc_html_e('Fixed Charge', 'nextdestina-booking'); ?></label>
            <div class="secret-input-wrapper">
                <input type="text" name="_paypal_fixed_charge" id="paypal_fixed_charge" value="<?php echo esc_attr($paypal_fixed_charge); ?>">
            </div>
        </div>
    </div>
</div>
