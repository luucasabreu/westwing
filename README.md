# Westwing Test

Docker running Nginx, PHP-FPM, MySQL.

## Overview

1. [Clone the project](#clone-the-project)

    We’ll download the code from its repository on GitHub.


2. [Run the application](#run-the-application)

    By this point we’ll have all the project pieces in place.


___

## Clone the project

To install [Git](http://git-scm.com/book/en/v2/Getting-Started-Installing-Git), download it and install following the instructions : 

```sh
git clone git@github.com:luucasabreu/westwing.git
```

Go to the project directory : 

```sh
cd westwing
```

## Run the application

1. Start the application :

    ```sh
    sudo docker-compose up -d
    ```

    **Please wait this might take a several minutes...**

2. Open your favorite browser :

    * [http://localhost:8000](http://localhost:8000/)

3. Stop and clear services

    ```sh
    sudo docker-compose down -v
    ```