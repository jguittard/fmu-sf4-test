# FoodMeUp SF4 test

## Docker
- For MacOS: get it [here](https://store.docker.com/editions/community/docker-ce-desktop-mac)
- For Windows: get it [here](https://store.docker.com/editions/community/docker-ce-desktop-windows)
- For Ubuntu (Trusty 16.04): more info [here](https://store.docker.com/editions/community/docker-ce-server-ubuntu)

## 1. Unit conversion

- Update the units entry you want to convert from/to inside `bin/test1/test1.php`
- Run the following command from the base dir of the project to launch the script:

```
$ docker run --rm -v $(pwd)/bin/test1:/app -w /app php:7.2-cli php test1.php
```

## 2. Nested model implementation in Symfony 4 application
### First use
Run this command line from the base dir of the project:
```
$ ./fmu-test-init.sh
```

Upon launch confirmation, this script will:
1. Build Docker containers
2. Install Composer dependencies
3. Initialize the application _(config files, database setup, data fixtures)_

### Use

- [http://test.foodmeup.local:8080](http://test.foodmeup.local:8080) to access the application

This endpoint redirects to the `categories` page, on which an _hierarchical ordered category list_ is available.

Each category entry is bound to its update page. Updating the category name refreshes the category `path`.
