<?php declare(strict_types = 1);

namespace MangowebTests\Authorization;

use Nette\Utils\FileSystem;
use Tester;

require __DIR__ . '/../vendor/autoload.php';


ini_set('assert.exception', '1');
Tester\Environment::setup();
Tester\Dumper::$maxPathSegments = 0;

define('MangowebTests\Authorization\TEMP_DIR', __DIR__ . '/temp/' . (int) getenv(Tester\Environment::THREAD));
FileSystem::createDir(TEMP_DIR);
Tester\Helpers::purge(TEMP_DIR);
