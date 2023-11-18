# cgrd-Testtask

## Requirements:

Description:  

Build a website with a login. The login should only be successful with the login data admin/test. Afterwards you should see an admin area where you can create, change or delete a news article. The news entries should be stored in a database. The change function should write the data live via javascript into the create form. All functions should be provided with a success or error message.  

Screenshots and images/icons for this task are attached to the mail.  

Here is an preview of this task: https://www.loom.com/share/65f7533740024aafb1e5fc9ad1e16379  

What can be used?  

- PHP (Object Oriented) 
- SQL (Database) 
- Vanilla JS (Nativ Javascript) 
- jQuery (https://api.jquery.com/) 
- HTML 
- CSS 
- twig  

  
What should not be used? 
- No PHP Frameworks 
- No other Javascript libraries 
- No HTML and/or CSS Frameworks (eg. Bootstrap) 
- No CSS preprocessor (eg. Sass)  



## Local setup

1. Clone the project form repository
```
git clone https://github.com/Abuziarova/cgrd-Testtask.git
```

2. Run the project with the command:
```
docker compose up -d
```

3. Insert the 'cgrd-Testtask.sql' file to the database (use password "app")
```
mysql -h localhost -P 3306 --protocol=tcp -u app -D database -p < cgrd-Testtask.sql
```

4. Install dependences:
```
composer install
```


In the database only one user 