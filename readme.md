#ALL INITIAL TESTS HAS BEEN MET , 
##composer install ,
##make .env file ,
##configure phpunit in php storm ,
## run each test (it will glow green),
  ##now go run 
 php artisan migrate , php artisan db:seed, 
 ##choose an email from the stored emails in the users table 
 ##password will be "secret",
 ##go /home in browser 
 ##login 
 ##make post , comment on it , reply to the comment ,
 ##i need you to mark where i would improve this example 
     ->using repo,presenter would be applicable 
     ->also i saw people who have unique request for each entity e.g "userRequest"
     ->views , models calls , how to aggrigate 
     
 ##note :
  one way the tests wont work for the first time 
  run php artisan migrate , then php artisan db:seed

  then run the post test , the "each user has posts"
will not wok properly and you need to rerun the test to reset the database 


