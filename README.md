Simple Benchmark Script comparing Corma and Doctrine
====================================================

Current results on my laptop (Ubuntu 17.04 with MySQL 5.7.17 and php 7.1.7):

Yes I know this isn't a very good benchmark!

Corma:

* Initialization: 2.00 MiB - 37 ms
* Insert 1000 objects: 4.00 MiB - 152 ms
* Insert 1000 associated objects: 4.00 MiB - 110 ms
* Update 1000 objects: 6.00 MiB - 156 ms
* Load 1000 objects with associated: 6.00 MiB - 48 ms
* Delete 1000 objects: 6.00 MiB - 27 ms

Total: 530 ms

Doctrine 2:

* Initialization: 4.00 MiB - 29 ms
* Insert 1000 objects: 8.00 MiB - 208 ms
* Insert 1000 associated objects: 8.00 MiB - 121 ms
* Update 1000 objects: 8.00 MiB - 648 ms
* Load 1000 objects with associated: 8.00 MiB - 36 ms
* Delete 1000 objects: 8.00 MiB - 114 ms

Total: 1156 ms

Findings:

Corma is more than 2x faster at mass write operations.

Corma uses 50% less memory than Doctrine.

Read operations slower now, possibly because of new hydration behavior.