# Vessels Tracks API



### Installing

A step by step to get a development env running

Go to the project

```
cd restful_api
```

Install packages

```
composer install
```

create database

```
php bin/console doctrine:schema:update --force
```

Import csv data

```
php bin/console csv:import
```

Create a test user (for getting authentication token)

```
php bin/console create_user
```

Run server

```
php bin/console server:run
```


### Usage

Application run on default http://localhost:8000

first of all we need to get authentication token.

make a POST request at http://localhost:8000/authentication_token with the following body:
```
{
	"password":"testtest",
	"email": "test@test.com"
}

```

then on http://localhost:8000/api/docs there is the swagger controlling all requests.
You have to **Authorize** with the token we got in previous step.
All you have to do is configure the API key in the value field. 
You must set the **token** as below and click on the "Authorize" button.
```
Bearer MY_TOKEN
```
  
### Testing

```
php bin/phpunit tests
```

