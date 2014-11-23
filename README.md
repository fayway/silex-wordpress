# Description

In this POC, I used Silex as a micro-framework for developing a WordPress plugin 
to validate if Silex is small but efficient enough to wrap informal and not object oriented code into more clean and service oriented code. 

The main "benefits" are:

  - Use Pimple as a service container for various plugin services

  - Use HTTP Foundation components (Request & Response) to handle all the HTTP layer interactions

  - Use Twig as a template engine. eg the plugin setting page

  - Use the EventDispatcher component as a complementary of WordPress Actions

  - Use Monolog to trace what's happening under the hood

  - ...
  
# Disclaimer

That's what's going to happen inside Uncle Bob head if by chance he finds this repo:

> Why would someone need to use Silex as a developing platform for a WordPress plugin?!!!

> What kind of nonsense is that?!! Putting business rules inside a tool that's itself bundled inside another tool!!! 
The ULTIMATE INFINITE ENSLAVEMENT this hack screams !

> What's the purpose of the plugin? Why don't you talk about the business instead of WordPress or Silex, those are just tools

> Arghhh... God help you, cause the tools will not! 

So you're warned, don't try this at home or do it at your own risk :)

# Installation

```sh
$ cd /path/to/wordpress/plugins
$ git clone https://github.com/fayway/silex-wordpress.git
$ cd silex-wordpress
$ composer install
```