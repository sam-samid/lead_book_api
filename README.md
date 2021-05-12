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

  -api documentation https://documenter.getpostman.com/view/4677413/TzRUC83a

FrontEnd URL:
  -url/registers
  -url/login
  -url/company
  -url/favouritecompany
  -url/reset

  
