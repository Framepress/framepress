<?php

namespace Framepress;

/**
 *
 * @author grayfolk
 *        
 */
class Framepress {
	public static $app;
	public static $id;
	private static $config;
	function __construct(array $config = []) {
		$this->parseConfig ( $config );
		self::$app = \Framepress\base\Application::init ();
	}
	public function __get($var) {
		if (! empty ( self::$config [$var] ))
			return self::$config [$var];
	}
	private function parseConfig($config) {
		self::$config = $config;
		if (! empty ( $config ['id'] ))
			self::$id = $config ['id'];
	}
}