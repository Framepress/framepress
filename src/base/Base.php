<?php

namespace Framepress\base;

use Framepress\Framepress;

/**
 *
 * @author grayfolk
 *        
 */
abstract class Base {
	public function render($view) {
		return Framepress::$app->view->render ( $view );
	}
	/**
	 *
	 * @return boolean
	 */
	protected function isPost() {
		return $_SERVER ['REQUEST_METHOD'] == 'POST';
	}
	/**
	 *
	 * @return boolean
	 */
	protected function isPut() {
		return $_SERVER ['REQUEST_METHOD'] == 'PUT';
	}
	/**
	 *
	 * @return boolean
	 */
	protected function isDelete() {
		return $_SERVER ['REQUEST_METHOD'] == 'DELETE';
	}
	/**
	 *
	 * @param string $class        	
	 * @param string $action        	
	 */
	protected function run($class, $action = 'actionIndex') {
		echo (new $class ())->{$action} ();
	}
}