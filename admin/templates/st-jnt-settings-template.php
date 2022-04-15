<?php 

/**
 * @package stjnttracker
 * */

$settings = ('' !== (get_option('st-jnt-settings')) ? get_option('st-jnt-settings') : array() );
?>
<div class="wrap">
    <div class="plug-container">
        <h1 class="plug-title"><?php echo esc_html_e(get_admin_page_title());?></h1>
        <hr>
        <form class="plug-form" method="POST" action="admin.php?page=stjnttracker">
            <input type="hidden" name="jntsettings" value="jntsettings">
            <div class="plugin-form-row">
                <label class="plug-label">VIP code</label>
                <input type="text" class="plug-input" placeholder="Enter VIP Code" name="st_jnt_vipcode"  value="<?php echo $value = ((array_key_exists('st_jnt_vipcode', $settings)) ? $settings['st_jnt_vipcode'] : '') ?>" >
            </div>
            <div class="plugin-form-row">
                <label class="plug-label">Password</label>
                <input type="password" class="plug-input" placeholder="Enter the password" name="st_jnt_password" value="<?php echo $value = ((array_key_exists('st_jnt_password', $settings)) ? $settings['st_jnt_password'] : '') ?>" >
            </div>
            <div class="plugin-form-row">
                <label class="plug-label">API Account</label>
                <input type="text" class="plug-input" placeholder="Enter API Account" name="st_jnt_api_acc" value="<?php echo $value = ((array_key_exists('st_jnt_api_acc', $settings)) ? $settings['st_jnt_api_acc'] : '') ?>" >
            </div>
            <div class="plugin-form-row">
                <label class="plug-label">API Private Key</label>
                <input type="text" class="plug-input" placeholder="Enter API Private Key" name="st_jnt_private_key" value="<?php echo $value = ((array_key_exists('st_jnt_private_key', $settings)) ? $settings['st_jnt_private_key'] : '') ?>" >
            </div>
            <div class="plugin-form-row">
                <label class="plug-label">Sender Name</label>
                <input type="text" class="plug-input" placeholder="Enter the Sender Name" name="st_jnt_sedername" value="<?php echo $value = ((array_key_exists('st_jnt_sedername', $settings)) ? $settings['st_jnt_sedername'] : '') ?>" >
            </div>
            <div class="plugin-form-row">
                <label class="plug-label">Seder Phone Number</label>
                <input type="text" class="plug-input" placeholder="Enter the Sender Phone Number" name="st_jnt_sndrphono" value="<?php echo $value = ((array_key_exists('st_jnt_sndrphono', $settings)) ? $settings['st_jnt_sndrphono'] : '') ?>" >
            </div>
            <div class="plugin-form-row">
                <label class="plug-label">Service Type</label>
                <input type="text" class="plug-input" value="pickup" 
                name="st_jnt_servicetype" readonly>
            </div>
            <div class="plugin-form-row">
                <input type="submit" name="submit" class="plug-sub-btn" value="Submit">
            </div>
        </form>
    </div>
</div>