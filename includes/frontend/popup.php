<?php

    namespace External_Link_Popup\Includes\Frontend;

    if ( !defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly.
    }

    class Popup {
        public function __construct() {
            add_action( 'wp_footer', [$this, 'render_popup_code'] );
        }

        function render_popup_code() {

            $popup_headding = get_theme_mod( 'external_link_popup_customize_heading', __( 'Important Notice!', 'external-link-popup' ) );
            $popup_text     = get_theme_mod( 'external_link_popup_customize_text', __( 'Links to web sites on this page have been compiled from internal and external sources. Information contained on linked pages may become dated or change without notice. We do not endorse, represent or warrant that information contained on external linked pages are complete or accurate.', 'external-link-popup' ) );
        ?>
        <style>
            <?php echo get_theme_mod('external_link_popup_customize_css'); ?>
        </style>

        <!-- External Link Popup Html -->
        <div class="external-link-popup-overlay" style="display: none;">
            <div class="external-link-popup-container">
                <h2 class="external-link-popup-heading"><?php esc_html_e( $popup_headding );?> </h2>
                <div class="external-link-popup-text"><?php echo apply_filters( 'the_content', $popup_text ); ?></div>
                <div class="external-link-popup-button-wrapper">
                    <button class="external-link-popup-confirm">Yes, Continue</button>
                    <button class="external-link-popup-cancel">Cancel</button>
                </div>
            </div>
        </div>
        <!-- External Link Popup Html End -->
 <?php
 }
 }