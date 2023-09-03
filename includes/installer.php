<?php

namespace External_Link_Popup\Includes;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Installer {
    public function __construct() {
        $this->run();
    }

    /**
     * Run the installer
     *
     * @return void
     */
    public function run() {
        $this->add_version();

        $this->add_option();
    }

    /**
     * Add time and version on DB
     */
    public function add_version() {
        $installed = get_option( 'external-link-popup-installed' );

        if ( !$installed ) {
            update_option( 'external-link-popup-installed', time() );
        }
        update_option( 'external-link-popup-version', External_Link_Popup_Version );
    }

    function add_option() {
        update_option( 'external-link-popup-all', 1 );
    }
}
