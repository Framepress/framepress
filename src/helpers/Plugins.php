<?php

namespace Framepress\helpers;

use Framepress\Framepress;

class Plugins {
	public static function checkPlugins() {
		/* var_dump ( empty ( Framepress::$config ['plugins'] ) );
		die (); */
		if (empty ( Framepress::$config ['plugins'] ))
			return;
		$plugins = get_plugins ();
		foreach ( $plugins as $plugin => $info ) {
			if (! is_plugin_active ( $plugin )) {
			}
		}
		// Plugins::getActionPluginUrl ( 'hello.php' )
	}
	public static function getActionPluginUrl($name, $action = 'install-plugin') {
		return wp_nonce_url ( add_query_arg ( [ 
				'action' => $action,
				'plugin' => $name 
		], admin_url ( 'update.php' ) ), $action . '_' . $name );
	}
}
