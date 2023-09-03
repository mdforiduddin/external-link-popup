<?php

namespace External_Link_Popup\Includes;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Assets {
    public function __construct() {

        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );

        add_action( 'wp_enqueue_scripts', [$this, 'frontend_enqueue_scripts'] );

        add_action( 'customize_preview_init', [$this, 'customize_preview_enqueue_scripts'] );
    }

    /**
     * Plugin Admin Assets Load
     *
     * @param $screen
     */
    public function admin_enqueue_scripts( $screen ) {

        if ( 'options-general.php' === $screen ) {
            /* Scrip Enqueue */
            wp_enqueue_script( 'external-link-popup-admin-script', External_Link_Popup_Assets . '/js/admin-script.js', array( 'jquery' ), External_Link_Popup_Version, true );

            /* Style Enqueue */
            wp_enqueue_style( 'external-link-popup-admin-style', External_Link_Popup_Assets . '/css/admin-style.css', array(), External_Link_Popup_Version );
        }
    }

    function frontend_enqueue_scripts() {
        /* Scrip Enqueue */
        wp_enqueue_script( 'external-link-popup-script', External_Link_Popup_Assets . '/js/main.js', array( 'jquery' ), External_Link_Popup_Version, true );

        /* Style Enqueue */
        wp_enqueue_style( 'external-link-popup-style', External_Link_Popup_Assets . '/css/style.css', array(), External_Link_Popup_Version );

        // Pass data to JavaScript
        $external_links = get_option( 'external-link-popup', '' );

        wp_localize_script( 'external-link-popup-script', 'External_Link_Popup', array(
            'links'                     => explode( "\n", $external_links ),
            'all_link'                  => get_option( 'external-link-popup-all' ),
            'confirm_button_background' => get_theme_mod( 'external_link_popup_customize_confirm_button_background', '#0678ab' ),
            'confirm_button_color'      => get_theme_mod( 'external_link_popup_customize_confirm_button_color', '#ffffff' ),
            'cancel_button_color'       => get_theme_mod( 'external_link_popup_customize_cancel_button_color', '#ffffff' ),
            'cancel_button_background'  => get_theme_mod( 'external_link_popup_customize_cancel_button_background', '#282A35' ),
        ) );
    }

    function customize_preview_enqueue_scripts() {
        wp_enqueue_script( 'external-link-popup-customize-preview', External_Link_Popup_Assets . '/js/customize.js', array( 'jquery', 'customize-preview' ), External_Link_Popup_Version, true );

        wp_localize_script( 'external-link-popup-customize-preview', 'External_Link_Popup_Preview', array(
            'Value' => get_theme_mod( 'external_link_popup_customize_preview', true ),

        ) );
    }
}