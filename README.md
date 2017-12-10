## Framepress
*Framework for Wordpress themes&plugins development.*

#### Installation
* Go to theme or plugin folder and execute command:  
`php composer.phar create-project Framepress/framepress-app app`

* Add following code to start of theme functions.php or plugin main file:

```php
defined ( 'DS' ) or define ( 'DS', DIRECTORY_SEPARATOR );
$loader = require_once implode ( DS, [ 
		__DIR__,
		'app',
		'vendor',
		'autoload.php' 
] );

$config = require_once implode ( DS, [ 
		__DIR__,
		'app',
		'config.php' 
] );
new \Framepress\Framepress ( $config );
```

#### Basic usage