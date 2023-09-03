<?php

namespace External_Link_Popup\Includes;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Customize {
    public function __construct() {

        add_action( 'customize_register', '__return_true' );

        add_action( 'customize_register', [$this, 'external_link_popup_customize'] );
    }

    /**
     * @param $wp_customize
     */
    function external_link_popup_customize( $wp_customize ) {

        /*
         * Customize e Section Add
         */
        $wp_customize->add_section( 'external_link_popup_wp_customize', array(
            'title'    => __( 'External Link Popup Settings', 'external-link-popup' ),
            'priority' => 30,
        ) );

        $wp_customize->add_setting( 'external_link_popup_customize_preview', array(
            'default'   => 1,
            'transport' => 'postMessage', //postMessage
        ) );
        $wp_customize->add_control( 'external_link_popup_customize_preview', array(
            'label'   => __( 'Popup Preview', 'customizer' ),
            'section' => 'external_link_popup_wp_customize',
            'type'    => 'checkbox',
        ) );

        /* Customize e Section Under Setting Add */
        $wp_customize->add_setting( 'external_link_popup_customize_heading', array(
            'default'    => 'Important Notice!',
            'capability' => 'edit_theme_options',
            'transport'  => 'postMessage', /* Default refresh */
        ) );

        /* Customize Settings Under Control Add */
        $wp_customize->add_control( 'external_link_popup_customize_heading', array(
            'label'       => 'External Link Popup Heading',
            'section'     => 'external_link_popup_wp_customize',
            'type'        => 'text',
            'input_attrs' => array(
                'placeholder' => 'External Link Popup Heading Change Here',
            ),

        ) );

        /* Customize e Section Under Setting Add */
        $wp_customize->add_setting( 'external_link_popup_customize_text', array(
            'capability' => 'edit_theme_options',
            'default'    => 'Links to web sites on this page have been compiled from internal and external sources. Information contained on linked pages may become dated or change without notice. We do not endorse, represent or warrant that information contained on external linked pages are complete or accurate.',
            'transport'  => 'postMessage', /* Default refresh */
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );

        /* Customize Settings Under Control Add */
        $wp_customize->add_control( 'external_link_popup_customize_text', array(
            'label'       => 'External Link Popup Text',
            'section'     => 'external_link_popup_wp_customize',
            'type'        => 'textarea',
            'input_attrs' => array(
                'placeholder' => 'External Link Popup Text Change Here',
            ),

        ) );

        /* ----------------------------------------------------- */

        $wp_customize->add_setting( 'external_link_popup_customize_button', array(
            'default'    => 0,
            'capability' => 'edit_theme_options',
            'transport'  => 'refresh', //postMessage
        ) );
        $wp_customize->add_control( 'external_link_popup_customize_button', array(
            'label'   => __( 'Customize Button', 'customizer' ),
            'section' => 'external_link_popup_wp_customize',
            'type'    => 'checkbox',
        ) );
        /* ----------------------------------------------------- */

        /* Confirm Button Bacckground Color */
        $wp_customize->add_setting( 'external_link_popup_customize_confirm_button_background', array(
            'default'    => '#0678ab',
            'capability' => 'edit_theme_options',
            'transport'  => 'postMessage',
        ) );

        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'external_link_popup_customize_confirm_button_background', array(
            'label'           => __( 'Confirm Button Background Color', 'customizer' ),
            'section'         => 'external_link_popup_wp_customize',
            'active_callback' => function () {
                if ( 1 == get_theme_mod( 'external_link_popup_customize_button', 1 ) ) {
                    return true;
                }
                return false;
            },
        ) ) );

        /* Confirm Button Text Color */
        $wp_customize->add_setting( 'external_link_popup_customize_confirm_button_color', array(
            'default'    => '#ffffff',
            'capability' => 'edit_theme_options',
            'transport'  => 'postMessage',
        ) );

        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'external_link_popup_customize_confirm_button_color', array(
            'label'           => __( 'Confirm Button Text Color', 'customizer' ),
            'section'         => 'external_link_popup_wp_customize',
            'active_callback' => function () {
                if ( 1 == get_theme_mod( 'external_link_popup_customize_button', 1 ) ) {
                    return true;
                }
                return false;
            },
        ) ) );

        /* Cancel Button Bacckground Color */
        $wp_customize->add_setting( 'external_link_popup_customize_cancel_button_background', array(
            'default'    => '#282A35',
            'capability' => 'edit_theme_options',
            'transport'  => 'postMessage',
        ) );

        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'external_link_popup_customize_cancel_button_background', array(
            'label'           => __( 'Cancel Button Background Color', 'customizer' ),
            'section'         => 'external_link_popup_wp_customize',
            'active_callback' => function () {
                if ( 1 == get_theme_mod( 'external_link_popup_customize_button', 1 ) ) {
                    return true;
                }
                return false;
            },
        ) ) );

        /* Cancel Button Text Color */
        $wp_customize->add_setting( 'external_link_popup_customize_cancel_button_color', array(
            'default'    => '#ffffff',
            'capability' => 'edit_theme_options',
            'transport'  => 'postMessage',
        ) );

        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'external_link_popup_customize_cancel_button_color', array(
            'label'           => __( 'Cancel Button Text Color', 'customizer' ),
            'section'         => 'external_link_popup_wp_customize',
            'active_callback' => function () {
                if ( 1 == get_theme_mod( 'external_link_popup_customize_button', 1 ) ) {
                    return true;
                }
                return false;
            },
        ) ) );

        /* Live Preview  */
        $wp_customize->selective_refresh->add_partial( 'external_link_popup_heading', array(
            'selector'        => '.external-link-popup-heading',
            'settings'        => 'external_link_popup_customize_heading',
            'render_callback' => function () {
                return get_theme_mod( 'external_link_popup_customize_heading' );
            },

        ) );

        // $wp_customize->selective_refresh->add_partial( 'external_link_popup_text', array(
        //     'selector'        => '.external-link-popup-container .external-link-popup-text',
        //     'settings'        => 'external_link_popup_customize_text',
        //     'render_callback' => function () {
        //         return apply_filters( 'the_content', get_theme_mod( 'external_link_popup_customize_text' ) );
        //     },

        // ) );

        $wp_customize->add_setting( 'external_link_popup_customize_css', array(
            'default'    => '',
            'capability' => 'edit_css',
            'transport'  => 'postMessage',
        ) );

        $wp_customize->add_control( new \WP_Customize_Code_Editor_Control( $wp_customize, 'external_link_popup_customize_css', array(
            'label'     => __( 'Additional Custom Css Code', 'customizer' ),
            'section'   => 'external_link_popup_wp_customize',
            'code_type' => 'text/css',
        ) ) );
    }
}