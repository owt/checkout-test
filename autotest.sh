docker build -t checkout -f Dockerfile . \
    && docker run --rm --name checkout_test -td checkout \
    && docker exec -it checkout_test /usr/bin/bash -c "./vendor/bin/phpunit --color=\"always\" src" \
    && docker stop checkout_test