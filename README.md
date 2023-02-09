# Bank

### Setup server
- `cd server`
- `docker-compose up -d`
- `docker exec -it server_app bash`
- `php artisan migrate`
server is running on port 8876

### Stop server 
- `docker-compose down`