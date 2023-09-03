<?php

    namespace External_Link_Popup\Includes;


    if ( !defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly.
    }

    class Frontend {
        public function __construct() {

           new Frontend\Popup();
        }

    }
