# HomeSwitchHome
<p align="center"><img src="https://i.imgur.com/6yDD1V9.png" width="25%"></p>
<h2> Server requirements </h2>
<ul>
    <li>PHP &gt;= 7.1.3</li>
    <li>OpenSSL PHP Extension</li>
    <li>PDO PHP Extension</li>
    <li>Mbstring PHP Extension</li>
    <li>Tokenizer PHP Extension</li>
    <li>XML PHP Extension</li>
    <li>Ctype PHP Extension</li>
    <li>JSON PHP Extension</li>
    <li>BCMath PHP Extension</li>
</ul>
<h2> Installation guide </h2>
<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
<h6 align="center"> A laravel 5.8 project </h6>
<ol>
    <li> Create a MariaDB database named u280573530_hsh with utf8_unicode_ci encoding</li>
    <li> Install composer https://getcomposer.org/download/ </li>
    <li> Pull project </li>
    <li> Rename .env.example file to .env inside your project root and fill information. </li>
    <li> Open the terminal and cd your project root directory </li>
    <li> Run composer install </li>
    <li> Run php artisan key:generate </li> 
    <li> Run php artisan migrate </li>
    <li> Run php artisan serve </li>
</ol>
