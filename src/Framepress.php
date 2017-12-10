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
	/**
	 *
	 * @var unknown
	 */
	CONST FRONT_SHORTCODES_FOLDER = 'shortcodes';
	/**
	 *
	 * @var \Framepress\base\Application
	 */
	public static $app;
	/**
	 *
	 * @var string
	 */
	public static $appName = 'Framepress';
	/**
	 *
	 * @var string
	 */
	public static $id;
	/**
	 *
	 * @var string
	 */
	public static $path;
	/**
	 *
	 * @var string
	 */
	public static $appPath;
	/**
	 *
	 * @var array
	 */
	public static $config = [ 
			'id' => 'framepress-app',
			'appPath' => '',
			'appName' => 'Framepress',
			'common' => [ ],
			'front' => [ 
					'shortcodesFolder' => 'shortcodes' 
			],
			'admin' => [ 
					'createDefaultOptionsPage' => true 
			],
			'cli' => [ ] 
	];
	/**
	 *
	 * @param array $config        	
	 */
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
	/**
	 *
	 * @param string $var        	
	 * @return \Framepress\unknown
	 */
	public function __get($var) {
		if (! empty ( self::$config [$var] ))
			return self::$config [$var];
	}
	/**
	 *
	 * @param array $config        	
	 */
	private function parseConfig(array $config) {
		self::$path = __DIR__;
		self::$config ['appPath'] = dirname ( dirname ( dirname ( dirname ( __DIR__ ) ) ) );
		self::$config = array_merge ( self::$config, $config );
		if (! empty ( $config ['id'] ))
			self::$id = $config ['id'];
		if (! empty ( $config ['appName'] ))
			self::$appName = $config ['appName'];
		if (! empty ( $config ['appPath'] ))
			self::$appPath = $config ['appPath'];
	}
}
