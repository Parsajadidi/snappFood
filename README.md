# Introduction
**This project is an experimental project and a clone of Snapfood **

# Installation

 - composer install
			
	    > $ composer install
	    
- laravel create .env file

		> $  cp .env.example .env
- laravel key generate
			
		> $ php artisan key:generate


- config database information in .env file
- laravel migrate database
			
		> $ php artisan migrate:fresh --seed
        
- npm run
			
		> $ npm run dev

# Requests

The development Docker containers do not automatically build vendor files for PHP or JS, this is left as a developer responsibility. Therefore you will need the following tools:

-   Git
-   [Composer](http://getcomposer.org/)
-   NPM 

## Clone the repository

Create a folder then open the terminal in it and enter the following code in the terminal

git clone https://github.com/Parsajadidi/snappFood.git

# Used packages

 
 - [Breeze](https://github.com/laravel/breeze)
 - [Laravel Sanctum](https://github.com/laravel/sanctum)
 
