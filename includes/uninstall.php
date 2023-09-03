<?php

namespace External_Link_Popup\Includes;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Uninstall {

    /**
     * Plugin Theme Mod List
     *
     * @var array
     */
    private $theme_mods = array(
        'external_link_popup_customize_preview',
        'external_link_popup_customize_heading',
        'external_link_popup_customize_text',
        'external_link_popup_customize_button',
        'external_link_popup_customize_confirm_button_background',
        'external_link_popup_customize_confirm_button_color',
        'external_link_popup_customize_cancel_button_background',
        'external_link_popup_customize_cancel_button_color',
    );

    /**
     * Plugin Option List
     *
     * @var array
     */
    private $options = array(
        'external-link-popup-all',
        'external-link-popup',
        'external-link-popup-version',
    );
    public function __construct() {
        $this->run();
    }

    /**
     * Run the uninstall
     *
     * @return void
     */
    public function run() {

        $this->remove_plugin_theme_mod();

        $this->remove_plugin_option();
    }

    /**
     * Remove Plugin Theme Mod Value
     */
    public function remove_plugin_theme_mod() {

        $theme_mods = $this->theme_mods;

        foreach ( $theme_mods as $theme_mod ) {
            remove_theme_mod( $theme_mod );
        }
    }

    public function remove_plugin_option() {
        $options = $this->options;

        foreach ( $options as $option ) {
            delete_option( $option );
        }
    }
}
