<?php

namespace Framepress;

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
			'plugins' => [ 
					'required' => [ ],
					'optionally' => [ ] 
			],
			'common' => [ ],
			'front' => [ 
					'shortcodesFolder' => 'shortcodes' 
			],
			'admin' => [ 
					'createDefaultOptionsPage' => true 
			],
			'cli' => [ ] 
	];
}
