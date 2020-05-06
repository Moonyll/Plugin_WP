<?php 
// HTML variables initialization :
$pluginTitle = 'Plugin Settings (Réglages du Plugin)';
$pluginSubTitle = 'Google Analytics Services';
$pluginLabelName= 'Tracking Id (ID de suivi) : ';
$pluginInputName = 'google_analytics';
$pluginInputFormat = 'UA-00000000-0';

// WP variables initialization :
$settingGroupName ='LAMANU_GoogleAnalytics';
$settingConfigName = 'configuration';
$submitButtonName = 'Save Tracking Id';

?>
<html>
<div class="wrap">
    <h1><?= $pluginTitle ?></h1>
    <!--Form - POST with "options.php" action => View to enable WP for database savings-->
    <form method="post" action="options.php"> 
        <h2><?= $pluginSubTitle ?></h2>
        <?php 
        // Setting_fields enable database savings for the group name 'LAMANU_GoogleAnalytics' :
        settings_fields($settingGroupName);
        
        // Recall option page name => wp page name = configuration :
        do_settings_sections($settingConfigName); ?>
        
        <!--Label for google analytics tracking Id--> 
        <label><?= $pluginLabelName ?></label>
        
        <!--Input for google analytics tracking Id--> 
        <input type="text" id="<?= $pluginInputName ?>" name="<?= $pluginInputName ?>" value="<?= get_option($pluginInputName, $pluginInputFormat); ?>"/>
        
        <!--wp submit button to save tracking Id--> 
        <?php submit_button($submitButtonName); ?>
    </form>
</div>
</html>
