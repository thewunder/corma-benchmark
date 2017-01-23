Simple Benchmark Script comparing Corma and Doctrine
====================================================

Current results on my laptop (Ubuntu 16.04 with MySQL 5.7.17 and php 7.1.1):

Corma:

* Initialization: 2.00 MiB - 18 ms
* Insert 1000 objects: 4.00 MiB - 136 ms
* Insert 1000 associated objects: 4.00 MiB - 74 ms
* Update 1000 objects: 6.00 MiB - 135 ms
* Load 1000 objects with associated: 6.00 MiB - 49 ms
* Delete 1000 objects: 6.00 MiB - 26 ms

Total: 438 ms

Doctrine 2:

* Initialization: 4.00 MiB - 25 ms
* Insert 1000 objects: 8.00 MiB - 342 ms
* Insert 1000 associated objects: 8.00 MiB - 210 ms
* Update 1000 objects: 8.00 MiB - 417 ms
* Load 1000 objects with associated: 8.00 MiB - 38 ms
* Delete 1000 objects: 8.00 MiB - 118 ms

Total: 1150 ms


Findings:

Corma is more than 2x faster at mass write operations.

Corma uses 50% less memory than Doctrine.

Read operations slower now, possibly because of new hydration behavior.