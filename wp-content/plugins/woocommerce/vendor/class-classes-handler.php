<?php
/**
 * This file was automatically generated by automattic/jetpack-autoloader.
 *
 * @package automattic/jetpack-autoloader
 */

namespace Automattic\Jetpack\Autoloader\jp02f167abb8e9ed34472e5bd963af3d06;

 // phpcs:ignore

/**
 * This class selects the package versions for the package classes.
 */
class Classes_Handler
{

    /**
     * The Plugins_Handler object.
     *
     * @var Plugins_Handler
     */
    private $plugins_handler = null;

    /**
     * The Version_Selector object.
     *
     * @var Version_Selector
     */
    private $version_selector = null;

    /**
     * The constructor.
     *
     * @param Plugins_Handler  $plugins_handler  The Plugins_Handler object.
     * @param Version_Selector $version_selector The Version_Selector object.
     */
    public function __construct( $plugins_handler, $version_selector )
    {
        $this->plugins_handler  = $plugins_handler;
        $this->version_selector = $version_selector;
    }

    /**
     * Adds the version of a package to the $jetpack_packages_classmap global
     * array so that the autoloader is able to find it.
     *
     * @param string $class_name Name of the class that you want to autoload.
     * @param string $version    Version of the class.
     * @param string $path       Absolute path to the class so that we can load it.
     */
    public function enqueue_package_class( $class_name, $version, $path )
    {
        global $jetpack_packages_classmap;

        if (isset($jetpack_packages_classmap[ $class_name ]['version']) ) {
            $selected_version = $jetpack_packages_classmap[ $class_name ]['version'];
        } else {
            $selected_version = null;
        }

        if ($this->version_selector->is_version_update_required($selected_version, $version) ) {
            $jetpack_packages_classmap[ $class_name ] = array(
            'version' => $version,
            'path'    => $path,
            );
        }
    }

    /**
     * Creates the path to the plugin's classmap file. The classmap filename is the filename
     * generated by Jetpack Autoloader version >= 2.0.
     *
     * @param String $plugin_path The plugin path.
     *
     * @return String the classmap path.
     */
    public function create_classmap_path( $plugin_path )
    {
        return trailingslashit($plugin_path) . 'vendor/composer/jetpack_autoload_classmap.php';
    }

    /**
     *  Initializes the classmap.
     */
    public function set_class_paths()
    {
        $active_plugins_paths = $this->plugins_handler->get_all_active_plugins_paths();
        $classmap_paths       = array_map(array( $this, 'create_classmap_path' ), $active_plugins_paths);

        foreach ( $classmap_paths as $path ) {
            if (is_readable($path) ) {
                $class_map = include $path;

                if (is_array($class_map) ) {
                    foreach ( $class_map as $class_name => $class_info ) {
                        $this->enqueue_package_class($class_name, $class_info['version'], $class_info['path']);
                    }
                }
            }
        }
    }
}
