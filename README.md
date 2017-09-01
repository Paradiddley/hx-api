# Web Development API Task

### Introduction
Microservice API submission for Holiday Extras.

### Setup
Navigate to project root (where the docker-compose.yml file is) and run; 

    docker-compose up -d

This should download all necessary images, start up the containers and run migrations/seeds.

### Testing
The project uses PHPUnit for functional and unit tests. To run all tests use;

    docker exec -it hxapi_fpm_1 vendor/bin/phpunit