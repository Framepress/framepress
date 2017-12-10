<?php

namespace Framepress\controllers;

use Framepress\Framepress;
use Framepress\base\Controller;

/**
 *
 * @author grayfolk
 *        
 */
class Front extends Controller {
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
			if (class_exists ( $class )) {
				$props = get_class_vars ( $class );
				if (! array_key_exists ( 'disabled', $props ) || $props ['disabled'] === false)
					new $class ();
			}
		}
	}
}
