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

/* 1.1.LAMANU function to initialize the "tarteaucitron" script & use Google Analytics Service : */
function LAMANU_scripts() {?>
    
    <!-- Load "Tarteaucitron" script -->
    <script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__).'js/tarteaucitron/tarteaucitron.js'; ?>">
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
    tarteaucitron.user.analyticsUa =    <?php get_option(
                                                        'google_analytics',     /* Id from form input */
                                                        'UA-00000000-0');       /* Id format type */   
                                        ?>
    
    // User & job analytics :
    tarteaucitron.user.analyticsMore =
    function ()
    {
        /* add here your optionnal ga.push() */
    };
    (tarteaucitron.job = tarteaucitron.job || []).push("analytics");

    </script>

    <!-- Load "googleAnalytics" script -->
    <script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ).'js/googleAnalytics.js'; ?>">
    </script>

<?php }

/* 1.2.LAMANU_settings_tab function => display the settings tab : */
function LAMANU_settings_tab()
{
    /* Add setting tab : */
    add_menu_page(
                    'Cookies Settings Page',        /* Page browser title tab */
                    'Cookies Settings',             /* Page name */
                    'manage_options',               /* Options management */
                    'configuration',                /* wp configuration name */
                    'LAMANU_load_settings_page'     /* Function to load */
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
    // Register Tracking Id Of Google Analitycs Service :
    register_setting(
                        'LAMANU_GoogleAnalytics',   /* Function group */
                        'google_analytics'          /* Id reference */
                    );
}

/// 2.ACTIONS FOR WORDPRESS ///

/* 2.1.Add action for wp => Load all needed script */
add_action('wp_head', 'LAMANU_scripts');

/* 2.2.Add action for wp => Display settings tab */
add_action( 'admin_menu', 'LAMANU_settings_tab' );

/* 2.3.Add action for wp => Register settings tab */
add_action('admin_init', 'LAMANU_register_settings');

?>