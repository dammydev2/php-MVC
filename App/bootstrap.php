<?php
require_once 'core/database.php';
new App\Core\Database();
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
App\Core\Route::start();