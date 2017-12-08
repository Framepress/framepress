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
}