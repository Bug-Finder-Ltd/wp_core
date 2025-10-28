<?php
$fields = get_post_meta( $post->ID, '_payment_method_fields', true );
if ( ! is_array( $fields ) ) $fields = [];

$manual_payment_description = get_post_meta($post->ID, '_manual_payment_description', true);
?>

<div class="meta-box-group">
    <div class="group-head">
        <h4><?php esc_html_e('Payment Details', 'nextdestina-booking'); ?></h4>
    </div>
    <div class="meta-box-grid">
        
        <div class="field">
            <label for="manual_payment_description"><?php esc_html_e('Description', 'nextdestina-booking'); ?></label>
            <textarea name="_manual_payment_description" id="manual_payment_description" rows="4"><?php echo esc_textarea($manual_payment_description); ?></textarea>
        </div>
    </div>
</div>


    <table class="widefat" id="payment-fields-table">
        <thead>
            <tr>
                <th><?php esc_html_e('Field Name', 'nextdestina-booking'); ?></th>
                <th><?php esc_html_e('Input Type', 'nextdestina-booking'); ?></th>
                <th><?php esc_html_e('Validation', 'nextdestina-booking'); ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ( $fields as $i => $field ) : ?>
                <tr>
                    <td><input type="text" name="payment_method_fields[<?php echo $i; ?>][name]" value="<?php echo esc_attr( $field['name'] ); ?>" /></td>
                    <td>
                        <select name="payment_method_fields[<?php echo $i; ?>][type]">
                            <option value="text" <?php selected( $field['type'], 'text' ); ?>><?php esc_html_e('Text', 'nextdestina-booking'); ?></option>
                            <option value="number" <?php selected( $field['type'], 'number' ); ?>><?php esc_html_e('Number', 'nextdestina-booking'); ?></option>
                            <option value="file" <?php selected( $field['type'], 'file' ); ?>><?php esc_html_e('File Upload', 'nextdestina-booking'); ?></option>
                            <option value="textarea" <?php selected( $field['type'], 'textarea' ); ?>><?php esc_html_e('Textarea', 'nextdestina-booking'); ?></option>
                            <option value="date" <?php selected( $field['type'], 'date' ); ?>><?php esc_html_e('Date', 'nextdestina-booking'); ?></option>
                        </select>
                    </td>
                    <td>
                        <select name="payment_method_fields[<?php echo $i; ?>][validation]">
                            <option value="required" <?php selected( $field['validation'], 'required' ); ?>><?php esc_html_e('Required', 'nextdestina-booking'); ?></option>
                            <option value="optional" <?php selected( $field['validation'], 'optional' ); ?>><?php esc_html_e('Optional', 'nextdestina-booking'); ?></option>
                        </select>
                    </td>
                    <td><button type="button" class="remove-field"><span class="dashicons dashicons-trash"></span></button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><button type="button" id="add-field" class="button-primary"><?php esc_html_e('+ Add Field', 'nextdestina-booking'); ?></button></p>

