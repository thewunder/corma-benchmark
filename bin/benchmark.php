#!/usr/bin/env php
<?php
require(__DIR__ . '/../vendor/autoload.php');

$corma = new \CormaBenchmark\Benchmark\CormaBenchmark();

$corma->run();