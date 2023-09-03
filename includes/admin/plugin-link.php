<?php

namespace External_Link_Popup\Includes\Admin;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Plugin_Link {
    public function __construct() {

        /*
         * PLugin Action link Add hook
         */
        add_filter( 'plugin_action_links_' . External_Link_Popup_Plugin_Base, [$this, 'plugin_new_link_function'] );
    }

    /**
     * @param  $links
     * @return mixed
     */
    public function plugin_new_link_function( $links ) {

        $settings_link = sprintf( '<a href="%1$s"> %2$s </a>',
            admin_url( 'options-general.php' ),
            esc_html__( 'Check Settings', 'external-link-popup' ) );

        array_unshift( $links, $settings_link );

        return $links;
    }
}