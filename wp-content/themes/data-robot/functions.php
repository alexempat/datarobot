<?php

/*
  Theme Name: Data Robot
  Theme URI: https://hasayone.com
  Author: Alexandr Orlovskiy
  Description: Special theme for Data Robot Test
  Version: 1.0.0
  Text Domain: datarobot
 */

if (!class_exists('DataRobot')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    class DataRobot_Setup {

        /**
         * A reference to an instance of this class.
         *
         * @since 1.0.0
         * @var   DataRobot_Setup
         */
        private static $instance = null;

        /**
         * Theme version
         *
         * @since 1.0.0
         * @var   string
         */
        public $version;

        /**
         * Sets up needed actions/filters for the theme to initialize.
         *
         * @since 1.0.0
         */
        public function __construct() {

            /*
             *  Enqueue scripts.
             */
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 10);

            /*
             *  Enqueue styles.
             */
            add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'), 10);
        }

        /**
         * Enqueue styles.
         *
         * @since 1.0.0
         */
        public function enqueue_styles() {
            wp_enqueue_style('datarobot-theme-style', get_stylesheet_uri(), array(), $this->version);
            wp_enqueue_style('uikit', get_template_directory_uri() . '/assets/lib/uikit/css/uikit.css', array(), $this->version);
        }

        /**
         * Enqueue scripts.
         *
         * @since 1.0.0
         */
        public function enqueue_scripts() {
            wp_enqueue_script('uikit', get_template_directory_uri() . '/assets/lib/uikit/js/uikit.min.js', array(), $this->version, true);
            wp_enqueue_script('uikit-icons', get_template_directory_uri() . '/assets/lib/uikit/js/uikit-icons.min.js', array(), $this->version, true);
        }

        /**
         * Returns the instance.
         *
         * @since  1.0.0
         * @return DataRobot_Setup
         */
        public static function get_instance() {

            /*
             *  If the single instance hasn't been set, set it now.
             */
            if (null == self::$instance) {
                self::$instance = new self;
            }

            return self::$instance;
        }

    }

endif;

/**
 * Returns instance of main theme configuration class.
 *
 * @since  1.0.0
 * @return DataRobot_Setup
 */
function DataRobot_theme() {
    return DataRobot_Setup::get_instance();
}

DataRobot_theme();
