Kafka implementation with PHP
---

## Installation
- `cp .env.example .env`
- Populate the required environment variables.
- `sudo chown -R 1001:1001 ~/.backup/zookeeper/kafka-php`
- `sudo chown -R 1001:1001 ~/.backup/kafka/kafka-php`
- It comes with docker. `docker-compose up -d --build`
- `docker-compose exec php bash`
- `composer install`
- `php artisan <command to run>`
