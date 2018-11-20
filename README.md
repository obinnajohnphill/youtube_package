# autoload

Installation Guide
-------------------

create a composer file and add:
{
  "minimum-stability": "dev",

  "require": {
    "php": ">=7.1",
    "obinna/app": "*"
},

  "autoload": {
    "psr-4": {
      "Obinna\\":"src/"
    }
  }
}

Install package:
sudo composer require obinna/app:dev-master

Prepare project:
copy the index.php file from package to your project directory

Generate optimised autoload file:
composer dumpautoload -o

Run: 

sudo apt-get install php7.2-bcmath

composer require php-amqplib/php-amqplib



Copy:

public folder into the root of your app


Create Database Table:

CREATE TABLE videos( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, video_id VARCHAR(30) NOT NULL, title VARCHAR(500) NOT NULL, created_date TIMESTAMP )