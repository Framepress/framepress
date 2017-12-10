<?php

namespace Framepress\controllers\admin;

use Framepress\Framepress;
use Framepress\base\Controller;

class Settings extends Controller {
	public function actionIndex() {
		return $this->render ( '__admin::settings' );
	}
}