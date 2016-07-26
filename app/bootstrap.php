<?php

require_once '../vendor/autoload.php';

$settings = require __DIR__ . '/../app/settings.php';

$app = new \Slim\App($settings);

require_once '/../app/dependencies.php';

require_once '../app/route.php';

$app->run();