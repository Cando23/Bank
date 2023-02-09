# Bank

### Setup server
- `cd server`
- `docker-compose up -d`
- `docker exec -it server_app bash`
- `php artisan migrate`

### Stop server 
- `docker-compose down`