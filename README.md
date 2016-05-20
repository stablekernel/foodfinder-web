# Food Finder

#### Important Installation Instructions
The API used to access provider information by the android and ios apps are configured to use a cloned database on heroku.
To keep the data in sync between the database management panel "/admin" and the heroku database, environment variables must be
set in your .htaccess file. 

    #Environment Variables for Heroku Access
    SetEnv HTTP_HEROKU_DBNAME database_name
    SetEnv HTTP_HEROKU_DBHOST uri.to.heroku.database
    SetEnv HTTP_HEROKU_DBUSER heroku_db_user
    SetEnv HTTP_HEROKU_DBPASS heroku_db_password
    
Please note that if you do not do this, the heroku database will not be updated but there will be no indication that this is 
not happening in database management panel. If you update the database in ANY way other than using "Add Provider" "Edit Provider"
or "Remove Provider" in the "Manage Providers" section, the changes will not propogate into the apps. 
