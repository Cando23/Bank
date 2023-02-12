# Bank

### Modify .env.example => .env
- `DB_HOST=db`
- `DB_DATABASE=bank`
- `DB_PASSWORD=root`

### Run server
- `cd server`
- `docker-compose up -d`

### Setup database
- Run server
- `docker exec -it server_app bash`
- `php artisan migrate`

### Stop server 
- `docker-compose down`

Server is running on port 8876
