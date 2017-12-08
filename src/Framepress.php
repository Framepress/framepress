<?php

namespace Framepress;

/**
 *
 * @author grayfolk
 *        
 */
class Framepress {
	protected $_config;
	public function __construct(array $config = [], $loader) {
		$loader->addPsr4 ( 'app\\', $config ['app'] );
		add_shortcode ( 'framepress-app-test', function () {
		} );
	}
}