Simple Benchmark Script comparing Corma and Doctrine
====================================================

Current results on my laptop (Ubuntu 16.04 beta with MySQL 5.6.28 and php 7.0.4):

Corma:

* Initialization: 2.00 MiB - 4 ms
* Insert 1000 objects: 6.00 MiB - 85 ms
* Insert 1000 associated objects: 6.00 MiB - 59 ms
* Update 1000 objects: 6.00 MiB - 114 ms
* Load 1000 objects with associated: 6.00 MiB - 22 ms
* Delete 1000 objects: 6.00 MiB - 30 ms

Total: 314 ms

Doctrine 2:

* Initialization: 4.00 MiB - 10 ms
* Insert 1000 objects: 10.00 MiB - 210 ms
* Insert 1000 associated objects: 10.00 MiB - 204 ms
* Update 1000 objects: 12.00 MiB - 295 ms
* Load 1000 objects with associated: 12.00 MiB - 19 ms
* Delete 1000 objects: 12.00 MiB - 115 ms

Total: 853 ms

Findings:

Corma is more than 2x faster at mass write operations.

Corma uses 50% less memory than Doctrine.

Doctrine is still 15% faster at simple read operations, how??