<?php
namespace External_Link_Popup\Includes;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Admin {
    public function __construct() {

        new Admin\Plugin_Link();

        new Admin\Settings();
        

        add_filter( 'pre_update_option_external-link-popup', [$this, 'check_update_option'], 10, 2 );
    }

    /**
     *
     * @param $old_value
     * @param $new_value
     */
    function check_update_option( $new_value, $old_value ) {

        if ( '' === $new_value ) {
            return $old_value;
        }

        return $new_value;
    }
}
