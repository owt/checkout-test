# Checkout test

## Running the tests

After this repository has been checked out, running the unit tests takes one step:
1. Run `./autotest.sh` command. This will build and run a docker container, run the tests and exit (removing itself).

To run tests manually

1. Run `docker build -t checkout -f Dockerfile . && docker run --rm --name checkout_test -td checkout` to build and run the container.
2. Run `docker exec -it checkout_test /usr/bin/bash` to access the container
3. Inside the container, run `./vendor/bin/phpunit --color="always" src` or other PHPUnit commands as desired.
4. `exit` to exit the container.
5. `docker stop checkout_test` to stop the container.

Once in the container, you can also run `php src/app.php` to see a couple of items added to the basket, and the discount applied.
