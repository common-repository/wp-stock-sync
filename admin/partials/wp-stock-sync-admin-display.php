<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.google.com
 * @since      1.0.0
 *
 * @package    Wp_Stock_Sync
 * @subpackage Wp_Stock_Sync/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

     <h1>WP Stock Sync Settings</h1>

    <form method="post" name="cleanup_options" action="options.php">

    <?php
        //Grab all options
        $options = get_option($this->plugin_name);

        // Activatation Settings
        $activate = $options['activate'];
    ?>

    <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
    ?>

	
    <fieldset>
        <legend class="screen-reader-text">
            <span>Activate the Sync</span>
        </legend>
        <label for="<?php echo $this->plugin_name; ?>-activate">
            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-activate" name="<?php echo $this->plugin_name; ?>[activate]" value="1" <?php checked($activate, 1); ?> />
            <span><?php esc_attr_e('Activate the Sync', $this->plugin_name); ?></span>
        </label>
    </fieldset>

    <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
	
</div>	
