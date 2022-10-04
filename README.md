## Test Laravel

1. To run docker use: ``sh ./docker-start.sh``

2. Wait until the composer installs all packages. After, run the command in the console: `` docker-compose -f ./docker/docker-compose.yml exec php-test php artisan migrate``