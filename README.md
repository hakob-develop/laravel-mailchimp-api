# laravel-mailchimp-api
Simple RESTful API to work with mailchimp lists

## Setup

1. `git clone git@github.com:hakob-develop/laravel-mailchimp-api.git`
2. `cd laravel-mailchimp-api`
3. `composer install`
4. Make sure to add `MAILCHIMP_API_KEY` variable in your **.env** file
5. `php artisan serve`


## API

### API Root

```
http://localhost:8000/api
```

### Lists

```
GET  /lists # Get all lists
POST /lists # Create a new list
GET  /lists/{list_id} # Get single list
PUT  /lists/{list_id} # Update existing list
DELETE  /lists/{list_id} # Delete list
```

### Members

```
GET  /lists/{list_id}/members # Get list members
POST /lists/{list_id}/members # Add new member
GET  /members/{list_id}/members # Get single member
PUT  /members/{list_id} # Update existing member
DELETE  /members/{list_id} # Delete member
```
