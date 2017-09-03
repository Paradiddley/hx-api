# Web Development API Task

[![Build Status](https://travis-ci.org/Paradiddley/hx-api.svg?branch=master)](https://travis-ci.org/Paradiddley/hx-api)

### Introduction
A server-side API submission for Holiday Extras.

### Setup
Navigate to project root (where the docker-compose.yml file is) 
and run; 

    docker-compose up -d

This should download all necessary images, start up the 
containers and run migrations/seeds.

There is also an exported Postman collection and environment variables 
that contains predefined routes to consume the API. You 
can find this in the `postman` directory.

### Testing
The project uses PHPUnit for functional and unit tests. 
To run all tests use;

    docker exec -it <hxapi_fpm container> vendor/bin/phpunit

You can run test suites separately using the `--testsuite` 
parameter with either `functional` or `unit`.

### Migrations/seeds

To run table migrations;

    docker exec -it <hxapi_fpm container> php novice migrate

To run data seeds;

    docker exec -it <hxapi_fpm container> php novice migrate