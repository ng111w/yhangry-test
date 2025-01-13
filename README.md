# INTRODUCTION
______________________________________
- This project is developed with Laravel version 11, PHP version 8.1 and MySQL 8.0
- After setting-up is complete and the [ import ] command is run, and API call is made to the provided API BaseUrl, respective data is imported.
- The project includes a check feature that stops the command from running (connecting to API) after all data has been imported successfully
- The project includes a [MenuServiceTest] that test if data is imported and also if there are no multiple of its kind, where necessary 
- ScreenShots of tested results are located [ projectName/screenshots ] directory.

The project is divided into 2 main sections:
1. Connect to an API and import it respective data into MySql Database
2. Create an API that accepts a string and returns a filtered result


TOOLS USED
______________________________________
1. PhpStorm - IDE
2. PostMan
3. SourceTree - GIT


# SET UP and RUN PROJECT  - SECTION 1
______________________________________
1. Create a .env file and update it with your database details (db_username, db_password, host and database name)
2. Add the line of code below within your .env file

    ```bash
         API_URL="https://staging.yhangry.com/booking/test/set-menus"
    ````
   
3. Run Database migration to create the tables [menus, cuisines and settings]
4. Run the project which ever way comfortable: for example, within your terminal, cd into [yourProjectDirectory] and run command below: 

```bash
    php artisan serve --port:9090 
```

5. Run the command within your terminal 

```bash
    php artisan import:menu 
```
The above command will trigger a connection to the API, import each page's data into the menu / cuisine tables wth a foreign key connection of between the 2 table.

6. You will receive a message on the terminal as each page are imported until it gets to the last one, successfully
7. If there be any error during the import process, you will be notified with specific area the error is emanating from
 

# SET UP and RUN PROJECT  - SECTION 2
______________________________________              

Copy and paste the endPoints URL below to your PostMan and see results as requested 
                                                         
````bash

  yourDomain.com/api/menus/CuisineSlug
  
````
examples of CuisineSlug are:   [Brunch | BBQ | KIDS | FRENCH and so on...]


````bash
    
    yourDomain.com/api/menus/bbq?filter[name]=*exotic*
    
    yourDomain.com/api/menus/bbq?filter[is_halal]=1   
    
    yourDomain.com/api/menus/bbq?sort=-number_of_orders  [the "-" sign indicates ascending order]
    
    yourDomain.com/api/menus/bbq?sort=number_of_orders
    
    yourDomain.com/api/menus/bbq?filter[is_halal]=0&sort=number_of_orders
    
                                                                                                          
````


# FILE FUNCTIONALITY
___________________________________
 - [ api.php ] : handles api routes 
 - 2 Models [Cuisine and Menu] and 2 tables are setup to handle the data storage, respectively
 - [ Menu ] belongsTo [Cuisine]
 - [ BookingService Class ]: handles the API call with a delay / sleepDuration argument 
 - [ ImportMenuCommand Class ]: triggers and API call and the data Import  
 - [ MenuImport ]: save API data into 2 tables, menus and cuisines respectively
 - [ Model/Setting ] : stop any connection or data import, once it has already been completed
 - [ CuisineSeeder ] : updates the slug column accordingly
 - [ MenuServiceTest ] : tests if data is imported and also if there are no multiple of its kind, where necessary. Cuisines records are store as unique data
 - [ MenuController ] : receives requests (cuisineSlug and Filters)  and return [MenuResource]
 - [ MenuResource ] : used to override the API json response return, and structure the payload
 - [ QueryFilter ] :  handles generic filtering and sorting
 - [ MenuFilter ]   : uses the parent class [QueryFilter] to handle custom filtering and sorting                 
             

# Contact / Support                       
___________________________________ 
If you have any question you can contact me via: [tosyn800@gmail.com]
