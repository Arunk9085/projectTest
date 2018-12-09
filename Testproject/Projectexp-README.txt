1.Project starts from login page (login.html).

2.If new user ,go for sigh up (register.html).Insert.php is used to insert values in mysql server

3.Once the registration is over login page is displayed,
  login wih same Email and password given in registration page.

4.verify.php file is used to validate the Email and Password are correct,
  if wrong it go back to "login page" after 2 sec atuomatically after diplaying "INVALID MSG",
  if Right it goes to details.html pages.

5.Once all the values all obtained from the details page it is stored in both mysql and 
   json(empdata.JSCON)

6.Finally Details Entered by the users are displayed in seperate page ,obtained from JSON file.
   
7.Atlast if the page is Refreshed ,insted of "ADDIND DUPLICATE DATA to DB and JSON file it get back to login page".