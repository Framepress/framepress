<?php

namespace Framepress\controllers;

use Framepress\Framepress;
use Framepress\components\Controller;
use Framepress\helpers\Plugins;

class Admin extends Controller {
	private $pagesCount = 0;
	public function __construct() {
		$this->runSetup ();
		add_action ( 'admin_init', function () {
			Plugins::checkPlugins ();
		} );
		if (Framepress::$config ['admin'] ['createDefaultOptionsPage'] === true) {
			$this->pagesCount ++;
		}
		if ($this->pagesCount > 0)
			add_action ( 'admin_menu', function () {
				add_menu_page ( __ ( Framepress::$appName, Framepress::$id ), __ ( Framepress::$appName, Framepress::$id ), 'manage_options', Framepress::$id, function () {
				}, '', 56 );
				if (Framepress::$config ['admin'] ['createDefaultOptionsPage'] === true) {
					$this->createDefaultSettingsPage ();
				}
				remove_submenu_page ( Framepress::$id, Framepress::$id );
			} );
	}
	private function runSetup() {
		if (empty ( $_GET ['action'] ) || $_GET ['action'] != 'setup')
			return;
	}
	private function createDefaultSettingsPage() {
		Framepress::$app->view->addFolder ( '__admin', implode ( DS, [ 
				Framepress::$path,
				'controllers',
				'admin',
				'views' 
		] ) );
		add_submenu_page ( Framepress::$id, __ ( Framepress::$appName . ' Settings', Framepress::$id ), __ ( 'Settings', Framepress::$id ), 'manage_options', Framepress::$id . '/settings', [ 
				$this,
				'runSettingsPage' 
		] );
	}
	public function runSetupPage() {
		return $this->run ( '\\Framepress\controllers\admin\\Setup' );
	}
	public function runSettingsPage() {
		return $this->run ( '\\Framepress\controllers\admin\\Settings' );
	}
}
