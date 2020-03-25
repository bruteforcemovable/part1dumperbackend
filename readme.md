# Part1-Dumperbackend for bruteforcemovable
## Information
This is a microservice built to handle requests for part1 dumping, these requests get distributed across all available botters/dumpers.
It is heavily based on bruteforcemovable which means that the code sometimes refers to dumping requests as seeds and dumpers as miners, this is expected to change when I clean this up.
## Requirements
- Docker
- MySQL-Server Instance
## Install Instructions
First you need to build the docker image.
```
docker build -t deadphoenix8091/part1dumperbackend .
```

Then you need to run the docker image. Please note that you need to pass in the database credentials as environment variables to the docker container. 
In this repository you will find a file called database.sql, you can use this to setup the necessary database structure.

```
docker run -it -p 80:80 --env DB_HOSTNAME=localhost --env DB_USERNAME=example --env DB_PASSWORD=example --env DB_DATABASE=part1dumper deadphoenix8091/part1dumperbackend .
```
