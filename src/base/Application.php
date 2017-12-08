<?php

namespace Framepress\base;

use Framepress\Framepress;

class Application {
	protected static $_instance;
	private $container;
	protected function __construct() {
		$this->container = new \League\Container\Container ();
		$this->container->add ( 'view', new \League\Plates\Engine ( implode ( DS, [ 
				Framepress::$appPath,
				'views' 
		] ) ) );
	}
	public static function init() {
		return self::getInstance ();
	}
	private function __clone() {
	}
	private function __sleep() {
	}
	private function __wakeup() {
	}
	public function __get($var) {
		if (self::getInstance ()->container->has ( $var ))
			return self::getInstance ()->container->get ( $var );
	}
	public static function getInstance() {
		if (! static::$_instance instanceof self) {
			static::$_instance = new self ();
		}
		return static::$_instance;
	}
}