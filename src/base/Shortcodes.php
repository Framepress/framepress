<?php

namespace Framepress\base;

use Framepress\Framepress;

/**
 *
 * @author grayfolk
 *        
 */
abstract class Shortcodes extends Controller {
	public $args;
	public $disabled = false;
	abstract function init();
	public function __construct() {
		add_shortcode ( $this->getShortcode (), function ($args) {
			$this->args = $args;
			return call_user_func ( [ 
					get_called_class (),
					'init' 
			] );
		} );
	}
	public function getShortcode() {
		return Framepress::$id . strtolower ( str_ireplace ( [ 
				'app\shortcodes',
				'\\' 
		], [ 
				'',
				'-' 
		], trim ( get_called_class (), '\\' ) ) );
	}
}
