<?php
/*
Plugin Name: LAMANU-cookie-law
Version: 0.1
Plugin URI: https://gitlab.ecole-e2n.fr/La-Manu/Exercice-WordPress
Description: A wordPress plugin to manage cookies with "tarteaucitron" script.
Author: Moon
Author URI: https://gitlab.ecole-e2n.fr/La-Manu/Exercice-WordPress
*/

/// 1. PLUGIN LAMANU FUNCTIONS ///

/* 1.0.a. Create TAC script source : */
function ScriptTACSource()
{
    // Main plugin directory url :
     $mainDirectory = plugin_dir_url(__FILE__);
    
    // Script directory :
     $scriptDirectory ='js/tarteaucitron/tarteaucitron.js';
     
     // Set 'Tarteaucitron' script source :
     echo $mainDirectory.$scriptDirectory;
}

/* 1.0.b. Create GGA script source : */
function ScriptGGASource()
{
    // Main plugin directory url :
     $mainDirectory = plugin_dir_url(__FILE__);
    
    // Script directory :
     $scriptDirectory ='js/googleAnalytics.js';
     
     // Set 'Tarteaucitron' script source :
     echo $mainDirectory.$scriptDirectory;
}

/* 1.0.c. Get Option Wp Function : */
function GetOption()
{
    // Set variables :
    $pluginInputName = 'google_analytics';
    $pluginInputFormat = 'UA-00000000-0';
     
    // Apply wp get_option function :
    get_option(
        $pluginInputName,       /* Id from form input */
        $pluginInputFormat);    /* Id format type */   
}


/* 1.1.LAMANU function to initialize the "tarteaucitron" script & use Google Analytics Service : */
function LAMANU_scripts() {?>
    
    <!-- Load "Tarteaucitron" script -->
    <script type="text/javascript" src=" <?php ScriptTACSource(); ?>">
    </script>

    <!-- Tarteaucitron & Google Analytics script -->
    <script type="text/javascript">

    // Tarteaucitron script initialization :
    tarteaucitron.init({

      "hashtag": "#tarteaucitron",      /* Open the panel with this hashtag */              /* Fr = Identifiant pour l'ouverture de Tarteaucitron */
      "cookieName": "tarteaucitron",    /* Cookie name */                                   /* Fr = Nom du script */
      "orientation": "bottom",          /* Banner position (top - bottom) */                /* Fr = Position de la bannière */
      "showAlertSmall": true,           /* Show the small banner on bottom right */         /* Fr = Affiche la petite bannière en bas à droite */
      "showAlertBig": true,             /* Show the big banner on bottom right */           /* Fr = Affiche la grande bannière en bas à droite */
      "cookieslist": true,              /* Show the cookie list */                          /* Fr = affiche la liste des cookies */
      "adblocker": false,               /* Show a Warning if an adblocker is detected */    /* Fr = Affiche une alerte si un adblocker est présent */
      "AcceptAllCta" : true,            /* Show accept all button when highPrivacy on */    /* Fr = Affiche le bouton tout accepter si consentement activé */
      "highPrivacy": false,             /* Disable auto consent */                          /* Fr = Désactive le consentement automatique */
      "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */            /* Fr = Répondre au 'DoNotTrack' du navigateur */
      "removeCredit": false,            /* Remove credit link */                            /* Fr = Supprime le lien de crédit */     
      "moreInfoLink": true,             /* Display link to know more */                     /* Fr = Affiche un lien "en savoir */ 
      "useExternalCss": false,          /* The 'tarteaucitron.css' is loaded */             /* Fr = Le css 'tarteaucitron.css' par défaut est chargé */
      "readmoreLink": "/cookiespolicy"  /* Change the default readmore link */              /* Fr = Définit le lien "en savoir plus" */

    });
    
    // Google Analytics script service => Retrieve Tracking Id From Option View :
    tarteaucitron.user.analyticsUa = <?php GetOption(); ?>
    
    // User & job analytics :
    tarteaucitron.user.analyticsMore =
    function ()
    {
        /* add here your optionnal ga.push() */
    };
    (tarteaucitron.job = tarteaucitron.job || []).push("analytics");

    </script>

    <!-- Load "googleAnalytics" script -->
    <script type="text/javascript" src="<?php ScriptGGASource() ?>">
    </script>

<?php }

/* 1.2.LAMANU_settings_tab function => display the settings tab : */
function LAMANU_settings_tab()
{
    // Variables initialization :
    $menuPage_TabName = 'Cookies Settings Page';
    $menuPage_PageName ='Cookies Settings';
    $menuPage_Options = 'manage_options';
    $menuPage_ConfigName = 'configuration';
    $menuPage_Function = 'LAMANU_load_settings_page';
    
    // Add settings tab :
    add_menu_page(
                    $menuPage_TabName,        /* Page browser title tab */
                    $menuPage_PageName,       /* Page name */
                    $menuPage_Options,        /* Options management */
                    $menuPage_ConfigName,     /* wp configuration name */
                    $menuPage_Function        /* Function to load */
                 );
}

/* 1.3.LAMANU_load_settings_page function => load the option setting page : */
function LAMANU_load_settings_page()
{
    // Retrieve file name directory :
    $fileDirectory = plugin_dir_path(__FILE__);
    
    // Set file name : 
    $fileName ='view/option.php';
    
    // Load php file once :
    require_once($fileDirectory.$fileName);
}

/* 1.4.LAMANU_register_settings function => register service from option page : */
function LAMANU_register_settings()
{
    // Variables initialization :
    $register_settings_GroupName = 'LAMANU_GoogleAnalytics';
    $register_settings_IdName = 'google_analytics';
    
    // Register Tracking Id Of Google Analitycs Service :
    register_setting(
                        $register_settings_GroupName,   /* Function group */
                        $register_settings_IdName       /* Id reference */
                    );
}

/// 2.ACTIONS FOR WORDPRESS ///

// Wp Main Variables initialization :
$wp_Head = 'wp_head';       /* 2.1 Wp Head */
$wp_Admin = 'admin_menu';   /* 2.2 Wp Admin Menu */
$wp_Init = 'admin_init';    /* 2.3 Wp Admin Init */

// Wp Functions Variables initialization :
$wp_ScriptToLoad = 'LAMANU_scripts';                    /* 2.1.Add action for wp => Load all needed script */
$wp_SettingsTabToDisplay = 'LAMANU_settings_tab';       /* 2.2.Add action for wp => Display settings tab */
$wp_SettingsToRegister = 'LAMANU_register_settings';    /* 2.3.Add action for wp => Register all settings */

// Array of variables :
$wp_array_For_Action = array(

    $wp_Head => $wp_ScriptToLoad,
    $wp_Admin => $wp_SettingsTabToDisplay,
    $wp_Init => $wp_SettingsToRegister);

// Add action applied for array element :
foreach ($wp_array_For_Action as $key => $value)
{
    add_action($key, $value);
}

?>