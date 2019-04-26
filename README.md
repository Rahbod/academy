# academy

### Installation

install composer dependencies in private folder
    
    composer install

generate new key , using the following artisan command:

    php artisan key:generate

install node dependencies in public_html folder
    
    npm install
  
 ### Configuration
 
 set host name and database configuration  using the `.env` file in private folder.
 
 ```dotenv
 APP_URL=http://my.host
 
 DB_DATABASE=zaban
 DB_USERNAME=root
 DB_PASSWORD=
 
 ```  
 
 to create database tables run the following artisan command in private folder:
 
     php artisan migrate
     
 to insert default data in database run the following artisan command in private folder:
      
      php artisan db:seed