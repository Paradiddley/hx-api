FROM mariadb:latest

COPY database/test_db.sql /docker-entrypoint-initdb.d

ADD database/instance /var/lib/mysql