# Note tag service
This service is created using Laravel 8.83.6 API Resource. It has Teams, Users, Notes and NoteUserTags.

#### Following are the Models
* Team
* User
* Note
* NoteUserTags

#### Usage
Clone the project via git clone or download the zip file.

##### .env
Copy contents of .env.example file to .env file. Create a database and add credentials in .env file.
##### Composer Install
cd into the project directory via terminal and run the following command to install composer packages.
###### `composer install`
##### Run Migration
then run the following command to create migrations in the database.
###### `php artisan migrate`
##### Run the service
then run the following command to start the service
###### `php artisan serve`

### API EndPoints
##### Team
* User GET `http://127.0.0.1:8000/api/team`
* User POST `http://127.0.0.1:8000/api/team`
##### User
* User GET `http://127.0.0.1:8000/api/user`
* User POST `http://127.0.0.1:8000/api/user`
* User PUT `http://127.0.0.1:8000/api/user`
* User DELETE `http://127.0.0.1:8000/api/user`
##### Note
* User GET `http://127.0.0.1:8000/api/team`
* User POST `http://127.0.0.1:8000/api/team`
* User DELETE `http://127.0.0.1:8000/api/team`
##### NoteUserTags
* User GET `http://127.0.0.1:8000/api/tag`
* User POST `http://127.0.0.1:8000/api/tag`