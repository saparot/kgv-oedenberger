# kgv-oedenberger

website for kleingarten Verein Oedenberger Strasse, Nuernberg. 


## development
1. yarn install
2. composer install
3. start symfony webserver `symfony server:start`
4. start npm with webpack: `npm run watch`  

## deployment

1. read https://symfony.com/doc/current/deployment.html
2. `composer install --no-dev --optimize-autoloader`
    `/usr/bin/php74 composer.phar install --no-dev --optimize-autoloader`
3. cache warm up: 
    `php bin/console cache:clear`
   `/usr/bin/php74 bin/console cache:clear`
4. install node packages: `npm ci`
5. build with encore prod asset bundle: 
`./node_modules/.bin/encore production`
