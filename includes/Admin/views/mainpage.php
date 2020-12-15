<div class="naija-options-form">
<h2>Naija4Sale options</h2>
<hr>
<form action="">
    <table class="form-table">
        <tr>
            <th><label for="ip_redirection"><?php n('Use IP redirection') ?></label></th>
            <td><input type="checkbox" name="ip_redirection" id="ip_redirection" <?php if(get_option('naija_use_ip_redirection'))echo "checked" ?> /> </td>
        </tr>
        <tr>
            <th><label for="naija_site_key"><?php n('Captcha site key') ?></label></th>
            <td><input type="text" name="naija_site_key" id="naija_site_key" class="regular-text" placeholder="Your site key from google captcha"  value="<?php echo get_option('naija_captcha_site_key') ?>"/> </td>
        </tr>
        <tr>
            <th><label for="naija_site_secret"><?php n('Captcha site secret') ?></label></th>
            <td><input type="text" name="naija_site_secret" id="naija_site_secret"  class="regular-text" placeholder="Your site secret from google captcha"  value="<?php echo get_option('naija_captcha_secret') ?>"/> </td>
        </tr>
    </table>
    <?php naija_form_action('naija_save_options') ?>
    <?php wp_nonce_field('naija-save-options') ?>
    <?php submit_button( __( 'Save options', 'naija' ), 'primary', 'save_options' )?>
</form>

</div>