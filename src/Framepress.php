<?php

namespace Framepress;

defined ( 'DS' ) or define ( 'DS', DIRECTORY_SEPARATOR );

use Framepress\controllers\Common;
use Framepress\controllers\Front;
use Framepress\controllers\Admin;

/**
 *
 * @author grayfolk
 *        
 */
class Framepress {
	CONST FRONT_SHORTCODES_FOLDER = 'shortcodes';
	public static $app;
	public static $id;
	public static $appPath;
	public static $config = [ 
			'id' => 'framepress-app',
			'appPath' => '',
			'common' => [ ],
			'front' => [ 
					'shortcodesFolder' => 'shortcodes' 
			],
			'admin' => [ 
					'createDefaultOptionsPage' => true 
			],
			'cli' => [ ] 
	];
	function __construct(array $config = []) {
		$this->parseConfig ( $config );
		self::$app = \Framepress\base\Application::init ();
		new Common ();
		if (! is_admin ()) {
			new Front ();
		} else {
			new Admin ();
		}
	}
	public function __get($var) {
		if (! empty ( self::$config [$var] ))
			return self::$config [$var];
	}
	private function parseConfig($config) {
		self::$config ['appPath'] = dirname ( dirname ( dirname ( dirname ( __DIR__ ) ) ) );
		self::$config = array_merge ( self::$config, $config );
		if (! empty ( $config ['id'] ))
			self::$id = $config ['id'];
		if (! empty ( $config ['appPath'] ))
			self::$appPath = $config ['appPath'];
	}
}