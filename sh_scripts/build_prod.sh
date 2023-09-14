cd ../
<<<<<<< HEAD
git pull
=======
>>>>>>> brazabet-v2
php composer.phar update
php artisan migrate
php artisan cache:clear
php artisan config:clear
php artisan view:clear
npm i
npm run build:all
<<<<<<< HEAD
#service supervisor restart
=======
service supervisor restart
>>>>>>> brazabet-v2
