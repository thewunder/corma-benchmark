Simple Benchmark Script comparing Corma and Doctrine
====================================================

Current results on my laptop (Ubuntu 16.04 with MySQL 5.7.12 and php 7.0.4):

Corma:

* Initialization: 2.00 MiB - 4 ms
* Insert 1000 objects: 6.00 MiB - 110 ms
* Insert 1000 associated objects: 6.00 MiB - 52 ms
* Update 1000 objects: 6.00 MiB - 126 ms
* Load 1000 objects with associated: 6.00 MiB - 29 ms
* Delete 1000 objects: 6.00 MiB - 27 ms

Total: 348 ms

Doctrine 2:

* Initialization: 4.00 MiB - 9 ms
* Insert 1000 objects: 10.00 MiB - 225 ms
* Insert 1000 associated objects: 10.00 MiB - 193 ms
* Update 1000 objects: 12.00 MiB - 363 ms
* Load 1000 objects with associated: 12.00 MiB - 19 ms
* Delete 1000 objects: 12.00 MiB - 128 ms

Total: 937 ms

Findings:

Corma is more than 2x faster at mass write operations.

Corma uses 50% less memory than Doctrine.

Doctrine is ~15% faster at simple read operations when event dispatching is enabled.
Without the event dispatcher read operations are about the same.