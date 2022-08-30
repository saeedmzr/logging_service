
## A service for reading logs from a file

We have a text file that contains a list of logs (which can be millions of records)
we want to write a service that parses this file line by line, insert it to DB, and at the end, have a web service that counts logs for us based on parameters that we send.
## Problems : 

- File could be very large, so we cant open the whole of it in memory.
- file can contain an empty line in between lines.
- we cant have duplicated logs, so we should avoid duplication.



## Solutions

First of all, we should find a way to read the file line by line and not open it on memory.

Then we read the file line by line and try to parse it and make this line insertable in our DB.

Before we insert the log we check the last record of the log (order by log date ) and check if the log is newer than that.
by doing that, we prevent duplication.
the file should have a certain same pattern for each line, so we don't have to worry about text patterns.


## What I use

in this script  i use **laravel 9.19** and **PHP 8**.

i also try to implement **repository pattern** ,**dry** , **kiss**,**solid** principles and **unit testing**.

in this script, I use **laravel 9.19** and PHP **PHP 8**.
I also try to implement **repository pattern**, **dry**, **kiss**, **solid principles**, and **PHP unit**.


### instalation

- First, you have to clone into the repo.
- Then you have to create two databases. one for script and another one for testing.
- After that create .env.testing and fill it with your test database
- Run **PHP artisan config:cache --env=testing** to setup your DB for testing
- Run **PHP artisan migrate**
- Run **PHP artisan test**
- After seeing all of 10 tests passed,create .env and fill it with your  database
- Run **PHP artisan migrate**
- Run **PHP artisan import:logs**
- At the end run **PHP artisan serve**


Endpoint of count logs webservices : **/api/count**
