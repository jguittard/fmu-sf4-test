# FoodMeUp SF4 test
Nested model implementation in Symfony 4 application

## Prerequesites
### Docker
- For MacOS: get it [here](https://store.docker.com/editions/community/docker-ce-desktop-mac)
- For Windows: get it [here](https://store.docker.com/editions/community/docker-ce-desktop-windows)
- For Ubuntu (Trusty 16.04): more info [here](https://store.docker.com/editions/community/docker-ce-server-ubuntu)

## First use
Run this command line from the base dir of the project:
```
$ ./fmu-test-init.sh
```

Upon launch confirmation, this script will:
1. Build Docker containers
2. Install Composer dependencies
3. Initialize the application _(config files, database setup, data fixtures)_

## Use

- [http://test.foodmeup.local:8080](http://test.foodmeup.local:8080) to access the application
