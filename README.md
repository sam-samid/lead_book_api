Lead Book APi
========================

What's inside?
--------------

First Config:

  * composer install

  * create database with this script :
    CREATE DATABASE `leadbook_test` /*!40100 DEFAULT CHARACTER SET latin1 */;
    
    -- leadbook_test.users definition

    CREATE TABLE `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(10) NOT NULL,
      `password` varchar(50) NOT NULL,
      `email` varchar(100) NOT NULL,
      `phone_number` varchar(15) DEFAULT NULL,
      `created_at` datetime DEFAULT NULL,
      `updated_at` datetime DEFAULT NULL,
      `deleted_at` datetime DEFAULT NULL,
      `email_verified` tinyint(1) DEFAULT '0',
      `token` varchar(100) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

    -- leadbook_test.companies definition

    CREATE TABLE `companies` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(25) NOT NULL,
      `address` varchar(100) NOT NULL,
      `phone_number` varchar(15) DEFAULT NULL,
      `created_at` datetime DEFAULT NULL,
      `updated_at` datetime DEFAULT NULL,
      `deleted_at` datetime DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

    -- leadbook_test.favourite_companies definition

    CREATE TABLE `favourite_companies` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `company_id` int(11) NOT NULL,
      `created_at` datetime DEFAULT NULL,
      `updated_at` datetime DEFAULT NULL,
      `deleted_at` datetime DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

    -- leadbook_test.users_token definition

Sample Usage:

  * REGISTER
    var form = new FormData();
    form.append("username", "samid");
    form.append("password", "samid2304");
    form.append("phone_number", "98123123123");
    form.append("email", "dimas.p.andrianto@gmail.com");

    var settings = {
      "url": "http://local.leadbook.devel:8081/register",
      "method": "POST",
      "timeout": 0,
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $.ajax(settings).done(function (response) {
      console.log(response);
    });

  * LOGIN
    var settings = {
      "url": "http://local.leadbook.devel:8081/users/login",
      "method": "POST",
      "timeout": 0,
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $.ajax(settings).done(function (response) {
      console.log(response);
    });

  * EMAIL VERIFYING
    var form = new FormData();
    form.append("username", "samid");
    form.append("password", "samid2304");
    form.append("phone_number", "98123123123");
    form.append("email", "dimas.p.andrianto@gmail.com");

    var settings = {
      "url": "http://local.leadbook.devel:8081/user/8wV8hTO80zh+N9WruW8ASST6D4YqokXWKC9p/verify",
      "method": "POST",
      "timeout": 0,
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $.ajax(settings).done(function (response) {
      console.log(response);
    });

  * RESET PASSWORD
    var form = new FormData();
    form.append("old_password", "samid2304");
    form.append("new_password", "samid2305");

    var settings = {
      "url": "http://local.leadbook.devel:8081/user/20/password/reset",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer 4AKuvFnsApPqybYSKOvddD8W+A=="
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $.ajax(settings).done(function (response) {
      console.log(response);
    });

  * SEARCH BY COMPANY NAME
    var settings = {
      "url": "http://local.leadbook.devel:8081/companies/tech/find",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer 4AKuvFnsApPqybYSKOvddD8W+A=="
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $.ajax(settings).done(function (response) {
      console.log(response);
    });

  * MARK AS FAVOURITE
    var settings = {
      "url": "http://local.leadbook.devel:8081/favouritecompanies/20users/2/companies/favourite",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer 4AKuvFnsApPqybYSKOvddD8W+A=="
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $.ajax(settings).done(function (response) {
      console.log(response);
    });

  * UNMARK THE FAVOURITE
    var settings = {
      "url": "http://local.leadbook.devel:8081/favouritecompanies/3/unfavourite",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer 4AKuvFnsApPqybYSKOvddD8W+A=="
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $.ajax(settings).done(function (response) {
      console.log(response);
    });

  * LIST FAVOURITE COMPANIES
    var settings = {
      "url": "http://local.leadbook.devel:8081/favouritecompanies/20/find",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer 4AKuvFnsApPqybYSKOvddD8W+A=="
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $.ajax(settings).done(function (response) {
      console.log(response);
    });
  
