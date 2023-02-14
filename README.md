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
- `php artisan migrate:fresh --seed`

### Stop server 
- `docker-compose down`

----

### Server base uri: http://localhost:8876/api/
### Routes
- Run `php artisan route:list` in server_app container
