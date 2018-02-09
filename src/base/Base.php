<?php

namespace Framepress\base;

use Framepress\Framepress;

/**
 *
 * @author grayfolk
 *        
 */
abstract class Base {
	/**
	 *
	 * @param string $view        	
	 * @param array $args        	
	 */
	public function render($view, $args = []) {
		return Framepress::$app->view->render ( $view, $args );
	}
	/**
	 *
	 * @return boolean
	 */
	protected function isGet() {
		return $_SERVER ['REQUEST_METHOD'] == 'GET';
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
	protected function run($class, $action = 'actionIndex', $args = []) {
		echo (new $class ())->{$action} ();
	}
}
