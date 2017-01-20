Simple Benchmark Script comparing Corma and Doctrine
====================================================

Current results on my laptop (Ubuntu 16.04 with MySQL 5.7.17 and php 7.1.1):

Corma:

* Initialization: 4.00 MiB - 54 ms
* Insert 1000 objects: 6.00 MiB - 530 ms
* Insert 1000 associated objects: 6.00 MiB - 430 ms
* Update 1000 objects: 6.00 MiB - 682 ms
* Load 1000 objects with associated: 6.00 MiB - 405 ms
* Delete 1000 objects: 6.00 MiB - 184 ms

Total: 2285 ms

Doctrine 2:

* Initialization: 4.00 MiB - 84 ms
* Insert 1000 objects: 10.00 MiB - 1572 ms
* Insert 1000 associated objects: 10.00 MiB - 1188 ms
* Update 1000 objects: 12.00 MiB - 2135 ms
* Load 1000 objects with associated: 12.00 MiB - 156 ms
* Delete 1000 objects: 12.00 MiB - 1297 ms

Total: 6432 ms


Findings:

Corma is more than 2x faster at mass write operations.

Corma uses 50% less memory than Doctrine.

Read operations slower now, possibly because of new hydration behavior.

Both doctrine and corma slowed down massively since last run, why?