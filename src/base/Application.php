<?php

namespace Framepress\base;

defined ( 'DS' ) or define ( 'DS', DIRECTORY_SEPARATOR );

use Framepress\Framepress;
use Framepress\controllers\Common;
use Framepress\controllers\Front;
use Framepress\controllers\Admin;

class Application {
	private $container;
	public function __construct(array $config = []) {
		Framepress::$app = $this;
		$this->parseConfig ( $config );
		$this->container = new \League\Container\Container ();
		$this->container->add ( 'view', new \League\Plates\Engine ( implode ( DS, [ 
				Framepress::$appPath,
				'views' 
		] ) ) );
		new Common ();
		if (! is_admin ()) {
			new Front ();
		} else {
			new Admin ();
		}
	}
	public function __get($var) {
		if ($this->container->has ( $var ))
			return $this->container->get ( $var );
		return null;
	}
	/**
	 *
	 * @param array $config        	
	 */
	private function parseConfig(array $config) {
		Framepress::$path = __DIR__;
		Framepress::$config ['appPath'] = dirname ( dirname ( dirname ( dirname ( __DIR__ ) ) ) );
		Framepress::$config = array_merge ( Framepress::$config, $config );
		if (! empty ( $config ['id'] ))
			Framepress::$id = $config ['id'];
		if (! empty ( $config ['appName'] ))
			Framepress::$appName = $config ['appName'];
		if (! empty ( $config ['appPath'] ))
			Framepress::$appPath = $config ['appPath'];
	}
}
