# Bank

Server is running on port 8876

### Run server
- `cd server`
- `docker-compose up -d`

### Setup database
- Run server
- `docker exec -it server_app bash`
- `php artisan migrate`

### Stop server 
- `docker-compose down`
