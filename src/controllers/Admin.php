<?php

namespace Framepress\controllers;

use Framepress\Framepress;
use Framepress\base\Base;

class Admin extends Base {
	private $pages = 0;
	public function __construct() {
		if (Framepress::$config ['admin'] ['createDefaultOptionsPage'] === true) {
			$this->pages ++;
		}
		if ($this->pages > 0)
			add_action ( 'admin_menu', function () {
				add_menu_page ( __ ( 'Framepress', Framepress::$id ), __ ( 'Framepress', Framepress::$id ), 'manage_options', Framepress::$id, function () {
				}, '', 56 );
				if (Framepress::$config ['admin'] ['createDefaultOptionsPage'] === true) {
					$this->createDefaultSettingsPage ();
				}
				remove_submenu_page ( Framepress::$id, Framepress::$id );
			} );
	}
	public function runSettingsPage() {
		$obj = '\\Framepress\controllers\admin\\Settings';
		echo (new $obj ())->{'actionIndex'} ();
	}
	private function createDefaultSettingsPage() {
		Framepress::$app->view->addFolder ( '__admin', implode ( DS, [ 
				Framepress::$path,
				'controllers',
				'admin',
				'views' 
		] ) );
		add_submenu_page ( Framepress::$id, __ ( 'Framepress Settings', Framepress::$id ), __ ( 'Settings', Framepress::$id ), 'manage_options', Framepress::$id . '/settings', [ 
				$this,
				'runSettingsPage' 
		] );
	}
}