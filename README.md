<p><a href="#" target="_blank"><img src="https://images.app.goo.gl/cBcxwTZN8DtbKk5S7" width="200"></a></p>


## Duty Diary
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

## Steps to run this system after cloning
- run `composer install`
- run `cp .env.example .env`
- run `php artisan key:generate`
- run `php artisan migrate`
- run `php artisan db:seed --class=RolesSeeder`
- run `php artisan db:seed --class=AdminUserSeeder`
- run `npm install`
- run `npm run dev`