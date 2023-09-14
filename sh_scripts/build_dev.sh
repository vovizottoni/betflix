cd /var/www/_10mb.com.br/betflix
php composer.phar update
php artisan migrate
php artisan cache:clear
php artisan config:clear
php artisan view:clear
npm i
npm run dev:all
#ls -l /var/www/_10mb.com.br/betflix/storage/framework/views/
