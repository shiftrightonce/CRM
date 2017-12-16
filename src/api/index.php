<?php

require '../Include/Config.php';
require '../Include/Functions.php';

use ChurchCRM\Utils\RedirectUtils;
use Slim\Container;
use Slim\App;
use Slim\HttpCache\Cache;
use Slim\HttpCache\CacheProvider;
use ChurchCRM\Slim\Middleware\VersionMiddleware;

//Security
if (!isset($_SESSION['iUserID'])) {
   RedirectUtils::Redirect('Login.php');
    exit;
}


// Instantiate the app
$settings = require __DIR__.'/../Include/slim/settings.php';

$container = new Container;
$container['cache'] = function () {
    return new CacheProvider();
};

// Add middleware to the application
$app = new App($container);

$app->add(new VersionMiddleware());

// Set up
require __DIR__.'/dependencies.php';
require __DIR__.'/../Include/slim/error-handler.php';

// system routes
require __DIR__.'/routes/database.php';
require __DIR__.'/routes/issues.php';

// people routes
require __DIR__.'/routes/search.php';
require __DIR__.'/routes/persons.php';
require __DIR__.'/routes/roles.php';
require __DIR__.'/routes/properties.php';
require __DIR__.'/routes/users.php';
require __DIR__.'/routes/families.php';
require __DIR__.'/routes/groups.php';

// finance routes
require __DIR__.'/routes/deposits.php';
require __DIR__.'/routes/payments.php';

// other
require __DIR__.'/routes/calendar.php';

//timer jobs
require __DIR__.'/routes/timerjobs.php';

//self-upgrade tasks
require __DIR__.'/routes/systemupgrade.php';

//registration
require __DIR__.'/routes/register.php';

//cart
require __DIR__.'/routes/cart.php';

require __DIR__.'/routes/kiosks.php';

require __DIR__.'/routes/events.php';

require __DIR__.'/routes/custom-fields.php';

require __DIR__.'/routes/system.php';

require __DIR__.'/routes/dashboard.php';

require __DIR__.'/routes/geocoder.php';

// Run app
$app->run();
