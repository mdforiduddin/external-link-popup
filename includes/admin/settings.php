<?php

namespace External_Link_Popup\Includes\Admin;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Settings {
    public function __construct() {

        add_action( 'admin_init', [$this, 'add_section_with_field'] );
    }

    /**
     * Wordpress Option Page New Field Add
     *
     * @return void
     */
    function add_section_with_field() {

        /* Section Add Code */
        add_settings_section( 'external_link_popup', __( 'External Link Popup Setting', 'external-link-popup' ), [$this, 'section_content'], 'general', array(
            'before_section' => '<div class="external-link-popup">',
            'after_section'  => '</div>',
        ) );

        /* Add Textarea Field */
        add_settings_field( 'external-link-popup', __( 'External Links (one per line):', 'external-link-popup' ), [$this, 'display_fields'], 'general', 'external_link_popup', array(
            'name'      => 'external-link-popup',
            'label_for' => 'external-link-popup',
        ) );

        /* Add Checkbox Field*/
        add_settings_field( 'external-link-popup-all', __( 'All External Links Popup:', 'external-link-popup' ), [$this, 'display_checkbox_fields'], 'general', 'external_link_popup', array(
            'name'      => 'external-link-popup-all',
            'label_for' => 'external-link-popup-all',
        ) );

        /* Register Fields */
        register_setting( 'general', 'external-link-popup', array(
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );

        register_setting( 'general', 'external-link-popup-all', array(
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
    }

    /* Section Callback Fucntion */
    function section_content() {
        echo '<hr>';
    }

    /**
     * Field add callback function
     *
     * @param  array  $external_link_popup_fiels
     * @return void
     */
    function display_fields( $external_link_popup_fiels ) {

        $field_name = $external_link_popup_fiels['name'];

        $__option_val = get_option( $field_name );

        $option_value = $__option_val ? trim( $__option_val ) : '';

        printf( '<textarea name="%s"  id="%s" class="regular-text" rows="5">%s</textarea>', esc_attr( $field_name ), esc_attr( $field_name ), esc_textarea( $option_value ) );
    }

    /**
     * Field add callback function
     *
     * @param  array  $external_link_popup_fiels
     * @return void
     */
    function display_checkbox_fields( $external_link_popup_fiels ) {

        $field_name = $external_link_popup_fiels['name'];

        $__option_val = get_option( $field_name );

        $selected = $__option_val == 1 ? 'checked' : '';

        printf( '<div class="switch-input-wrapper"> <input type="checkbox" name="%s"  id="%s" value="1" %s /> <span class="slider round"></span></div>',
            esc_attr( $field_name ), esc_attr( $field_name ), esc_attr( $selected ) );
    }
}