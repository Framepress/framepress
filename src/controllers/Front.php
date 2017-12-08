<?php

namespace Framepress\controllers;

use Framepress\Framepress;

class Front {
	private $shortcodes = [ ];
	public function __construct() {
		$this->findShortcodes ();
		$this->callShortcodes ();
	}
	private function findShortcodes() {
		$dir = implode ( DS, [ 
				Framepress::$appPath,
				Framepress::FRONT_SHORTCODES_FOLDER 
		] );
		$iterator = new \RecursiveIteratorIterator ( new \RecursiveDirectoryIterator ( $dir, \RecursiveIteratorIterator::SELF_FIRST ) );
		
		foreach ( $iterator as $file ) {
			if ($file->isFile ())
				$this->shortcodes [$file->getFilename ()] = trim ( str_ireplace ( [ 
						$dir,
						'.php' 
				], '', $file ), '/' );
		}
	}
	private function callShortcodes() {
		if (! count ( $this->shortcodes ))
			return;
		foreach ( $this->shortcodes as $file ) {
			$class = str_ireplace ( '/', '\\', "\\app\\shortcodes\\" . $file );
			/* if (is_callable ( [ 
					$class,
					'init' 
			] )) {
				(new $class ())->init ();
			} */
			new $class ();
		}
	}
}