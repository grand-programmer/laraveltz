<ul>
<li>Create a database locally named <code>homestead</code> utf8_general_ci</li>
<li>Download composer <a href="https://getcomposer.org/download/" rel="nofollow">https://getcomposer.org/download/</a></li>
<li>Pull Laravel/php project from git provider.</li>
<li>Rename <code>.env.example</code> file to <code>.env</code>inside your project root and fill the database information.
(windows wont let you do it, so you have to open your console cd your project root directory and run <code>mv .env.example .env</code> )</li>
<li>Open the console and cd your project root directory</li>
<li>Run <code>composer install</code> or <code>php composer.phar install</code></li>
<li>Run <code>php artisan key:generate</code></li>
<li>Run <code>php artisan migrate</code></li>
<li>Run <code>php artisan db:seed</code> to run seeders, if any.</li>
<li>Run <code>php artisan serve</code></li>
</ul>
