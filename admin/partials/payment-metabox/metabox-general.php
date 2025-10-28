<?php
$logo = get_post_meta($post->ID, '_payment_logo', true);
$payment_description = get_post_meta($post->ID, '_payment_description', true);
?>
<style>

</style>
<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('General Settings', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        <div class="field">
            <label for="payment_logo"><?php esc_html_e('Logo', 'nextdestina-booking'); ?></label>
            <div class="logo-preview">
                <img id="payment_logo_preview" src="<?php echo esc_url($logo); ?>" style="<?php echo $logo ? '' : 'display:none;'; ?>">
            </div>
            <input type="hidden" id="payment_logo" name="_payment_logo" value="<?php echo esc_attr($logo); ?>" />
            <button class="upload-logo button-primary"><?php esc_html_e('Upload', 'nextdestina-booking'); ?></button>
        </div>
        <div class="field">
            <label for="payment_description"><?php esc_html_e('Description', 'nextdestina-booking'); ?></label>
            <textarea name="_payment_description" id="payment_description" rows="4"><?php echo esc_textarea($payment_description); ?></textarea>
        </div>
    </div>
</div>
