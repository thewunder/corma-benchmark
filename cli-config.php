<?php
require 'vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$doctrineBench = new \CormaBenchmark\Benchmark\DoctrineBenchmark();

return ConsoleRunner::createHelperSet($doctrineBench->getEntityManager());