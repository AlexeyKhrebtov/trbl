<p align="center"><img src="https://image.flaticon.com/icons/png/512/2103/2103676.png" width="200"></p>

## Troubleshooting

### Полезные команды

```shell script
docker-compose run --rm app php artisan ...
```

Создание сущности
```shell script
docker-compose run --rm app php artisan make:model Market -a
docker-compose run --rm app php artisan make:request StoreEquipmentRequest
docker-compose run --rm app php artisan make:model Market -fms --api
docker-compose run --rm app php artisan make:controller API/MarketController --api -m Market
docker-compose run --rm app php artisan make:test MarketTest
docker-compose run --rm app php artisan make:resource MarketResource
docker-compose run --rm app php artisan make:policy PostPolicy --model=Market
```

Тесты
```shell script
docker-compose run --rm app php artisan test
```

NPM
```shell script
docker-compose run --rm npm npm run watch
docker-compose run --rm npm npm install tailwindcss --save-dev
docker-compose run --rm npm npm install leaflet vue2-leaflet --save
```

Миграция (полностью с 0, с заполнением данных)
```shell script
docker-compose run --rm app php artisan migrate:fresh --seed
docker-compose run --rm app php artisan db:seed --class=UserSeeder

```

Для PHPStorm
```shell script
docker-compose run --rm app php artisan ide-helper:generate # PHPDoc generation for Laravel Facades
docker-compose run --rm app php artisan ide-helper:models # PHPDocs for models
docker-compose run --rm app php artisan ide-helper:meta # PhpStorm Meta file
```

Для хешей можно использовать 
```php
$str = 'alexeymegaex@gmail.com';
echo hash('haval160,3', $str)."\n";
```

[https://vue2-leaflet.netlify.app/examples/simple.html](https://vue2-leaflet.netlify.app/examples/simple.html)
https://www.5balloons.info/laravel-tdd-beginner-crud-example/


Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the m 0-0 oster extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all m

