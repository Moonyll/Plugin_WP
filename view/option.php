<html>
<div class="wrap">
    <h1> Plugin Settings (Réglages du Plugin) </h1>
    <!--Form - POST with "options.php" action => View to enable WP for database savings-->
    
    <form method="post" action="options.php"> 
        <h2>Google Analytics Services</h2>
        <?php 
        
        // Setting_fields enable database savings for the group name 'LAMANU_GoogleAnalytics' :
        settings_fields('LAMANU_GoogleAnalytics');
        
        // Recall option page name => wp page name = configuration :
        do_settings_sections('configuration'); ?>
        
        <!--Label for google analytics tracking Id--> 
        <label>Tracking Id (ID de suivi) : </label>
        
        <!--Input for google analytics tracking Id--> 
        <input type="text" id="google_analytics" name="google_analytics" value="<?= get_option('google_analytics','UA-00000000-0'); ?>"/>
        
        <!--wp submit button to save tracking Id--> 
        <?php submit_button('Save Tracking Id'); ?>
    </form>
</div>
</html>
