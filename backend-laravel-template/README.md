# Vegekul BPaaS Backend

## Version
- Laravel: v10.34.2
- PHP: 8.2
- NodeJS: >=18
- MySQL: 8.0
- Nginx

## Requirement
- Docker


## Setup Docker
```bash
cd docker
cp .env.example .env
cp workspace/auth.example.json workspace/auth.json

docker compose up -d workspace nginx php-fpm mysql phpmyadmin
```

## Installation
```bash
cd docker

# Access to workspace container
sudo docker compose exec workspace bash

composer install

cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migration
php artisan migrate

# Run database seeder
php artisan db:seed
```

## Frontend
```bash
npm install
npm run dev

# Build
npm run build
```

## Frontend
```bash
npm install
npm run dev

# Build
npm run build
```

## Unit test
```bash
php artisan test
```

## Format code
```bash
./vendor/bin/pint
./vendor/bin/pint --dirty
```


## Demo
Open browser and navigate to `http://localhost:8000`

### Api Docs
Open browser at http://localhost:8000/api/docs

