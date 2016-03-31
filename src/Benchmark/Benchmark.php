<?php
namespace CormaBenchmark\Benchmark;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;
use Symfony\Component\Stopwatch\Stopwatch;

abstract class Benchmark
{
    /** @var  Connection */
    protected $connection;
    
    /** @var  Stopwatch */
    protected $stopwatch;
    
    public function __construct()
    {
        $this->stopwatch = new Stopwatch();
    }

    protected function connect()
    {
        if(empty(getenv('MYSQL_HOST')) && file_exists(__DIR__ . '/../../.env')) {
            $dotenv = new Dotenv(__DIR__ . '/../../');
            $dotenv->load();
        }

        if(empty(getenv('MYSQL_HOST')) || empty(getenv('MYSQL_USER'))) {
            throw new \RuntimeException('Create a .env file with MYSQL_HOST, MYSQL_USER, and MYSQL_PASS to run this benchmark.');
        }

        $pass = getenv('MYSQL_PASS') ? getenv('MYSQL_PASS') : '';

        $pdo = new \PDO('mysql:host='.getenv('MYSQL_HOST'), getenv('MYSQL_USER'), $pass);
        $this->connection = DriverManager::getConnection(['driver'=>'pdo_mysql','pdo'=>$pdo]);
    }
    
    protected function createDatabase()
    {
        $this->connection->query('CREATE DATABASE IF NOT EXISTS corma_benchmark DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci');
        $this->connection->query('USE corma_benchmark');
        $this->connection->query('CREATE TABLE IF NOT EXISTS test_objects (
          id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `name` VARCHAR(255) NOT NULL,
          description TEXT NOT NULL,
          associatedObjectId INT (11) UNSIGNED NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1');

        $this->connection->query('CREATE TABLE IF NOT EXISTS associated_objects (
          id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `name` VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1');

        $this->connection->query('ALTER TABLE test_objects ADD FOREIGN KEY (associatedObjectId) REFERENCES associated_objects (id) ON UPDATE CASCADE ON DELETE SET NULL');

    }

    public function run()
    {
        $this->connect();
        $this->createDatabase();
        $this->runBenchmarks();
        $this->printResults();
        $this->cleanup();
    }

    protected function printResults()
    {
        $total = 0;
        foreach($this->stopwatch->getSections() as $section) {
            foreach ($section->getEvents() as $event) {
                echo "$event\n";
                $total += $event->getDuration();
            }
        }
        echo "Total: $total ms\n";
    }

    protected function cleanup()
    {
        $this->connection->query('DROP DATABASE corma_benchmark');
    }

    abstract protected function runBenchmarks();


}