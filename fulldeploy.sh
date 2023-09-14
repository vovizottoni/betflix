docker build . -t registry.digitalocean.com/betflix/nginx:latest --target=ngingx
docker push registry.digitalocean.com/betflix/nginx:latest

docker build . -t registry.digitalocean.com/betflix/laravel:latest --target=prod
docker push registry.digitalocean.com/betflix/laravel:latest

kubectl apply -f kubernetes    