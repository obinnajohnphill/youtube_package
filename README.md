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

