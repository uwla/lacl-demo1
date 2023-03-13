# LACL DEMO APP

To run this demo locally:

1. Clone this repository.
2. Run `composer require` to install the composer packages.
3. Copy `.env.example` to `.env` and customize it.
4. Run `php artisan key:generate` to create the application's key.
5. Run `docker composer up` to start the application via docker.
6. Run `docker exec -it app php artisan migrate --seed` to seed the DB.

Now, the application should be up and running.

To  facilitate  interacting  with  the  API,  there  is   this   python   script
`play.py`. This script basically makes several  requests  to  the  Laravel  API,
which should be running on `localhost:8000`, authenticated as  different  users.
To run it:

```python
python3 play.py
```

The goal is to illustrate how the LACL system  works,  by  allowing  or  denying
access to different  application  resources.  Some  users  have  permissions  to
certain actions, others do not.

The script  will  just  show  that  the  system  works  from  outside.  You  are
encouraged to explore the application's controllers and policies to see how  the
system was defined.

By default, some users, permissions, roles, and articles will  be  created  when
you seed the database. You can explore those in `database/seeders`.

If you notice some error or want to contribue, feel free to submit a PR.
