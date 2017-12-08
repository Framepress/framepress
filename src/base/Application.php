<?php

namespace Framepress\base;

class Application {
	private static $_instance;
	private $container;
	protected function __construct() {
		$this->container = new \League\Container\Container ();
		$this->container->add ( 'view', 'League\Plates\Engine' );
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
		return self::getInstance ()->container->get ( $var );
	}
	public static function getInstance() {
		if (! static::$_instance instanceof self) {
			static::$_instance = new self ();
		}
		return static::$_instance;
	}
}