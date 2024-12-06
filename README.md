# Event Register System With API

## Prerequisites
- 8.1 or higher
- Composer
- Mysql
- Laravel 11 installed


Clone the repository:

```bash
git clone https://github.com/capamaroux1/assessment.git

cd your-repo-name
```

Install PHP dependencies using Composer:
```bash
composer install
```

Copy the .env.example file to .env and configure it
```bash
cp .env.example .env
```
Set your database credentials in the .env file:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
Generate an application key:
```
php artisan key:generate
```
Run migrations and seed the database:
```
php artisan migrate --seed
```

Users for testing:
Admin:
- admin@mail.com
- password

Simple User:
- user@mail.com
- password

## API Endpoints


## GET
`Login` [/api/login]

**Parameters**

`email` | required 

`password` | required

**Response**

```
// Success Login
{
    "token": "2|86v3A1CQZyRw5neJ2htFoMwgk3yMjF0k2mNQrIfmaad1e693",
    "message": "Login success"
}

// Invalid Credentials
{
    "message": "Invalid credentials. Please check your email and password.",
    "status": "error"
}
```
___


## GET
`User Profile` [/api/user/profile]

Requires Authentication (bearer token). 


**Response**

```
{
    "data": {
        "id": 2,
        "first_name": "Myra",
        "last_name": "Okuneva",
        "email": "koch.stuart@example.org",
        "created_at": "2024-12-05T22:55:51.000000Z",
        "updated_at": "2024-12-05T22:55:51.000000Z"
    }
}
```



## GET
`Get Events` [/api/events]

Requires Authentication (bearer token). 

Paginated Results

**Response**

```
{
    "data": [
        {
            "id": 1,
            "start_date": "2024-12-05T00:00:00.000000Z",
            "title": "Aut sapiente architecto expedita quia magnam sint",
            "description": "Amet perspiciatis aspernatur culpa quibusdam est",
            "capacity": 42,
            "location": "Virtual",
            "status": "Published",
            "type": "Social"
        },
        {
            "id": 2,
            "start_date": "2024-12-05T00:00:00.000000Z",
            "title": "Quaerat aut quod qui in rerum excepturi totam plac",
            "description": "Id qui sunt aperiam reprehenderit error architec",
            "capacity": 93,
            "location": "Virtual",
            "status": "Draft",
            "type": "Training"
        }
    ],
    "links": {
        "first": "/api/events?page=1",
        "last": "/api/events?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "/api/events?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "/api/events",
        "per_page": 15,
        "to": 2,
        "total": 2
    }
}
```



## POST
`Register for Event` [/api/events/{id}/register]

Requires Authentication (bearer token). 


**Parameters**

`id` | required | Event ID


**Response**

```
{
    "message": "You are succesfully register to this event!"
}
```

Email Confirmation

Emails are sent automatically upon successful event registration.



## POST
`Unregister from Event` [/api/events/{id}/unregister]

Requires Authentication (bearer token). 


**Parameters**

`id` | required | Event ID


**Response**

```
{
    "message": "You are succesfully unregister from this event!"
}
```



## GET
`Get Event attendees` [/api/events/{id}/attendees]

Requires Authentication (bearer token). 


**Parameters**

`id` | required | Event ID


**Response**

```
{
    "data": [
        {
            "id": 2,
            "first_name": "Myra",
            "last_name": "Okuneva",
            "email": "koch.stuart@example.org",
            "created_at": "2024-12-05T22:55:51.000000Z",
            "updated_at": "2024-12-05T22:55:51.000000Z"
        }
    ]
}
```


## GET
`Get Event Details` [/api/events/{id}]

Requires Authentication (bearer token). 


**Parameters**

`id` | required | Event ID


**Response**

```
{
    "data": {
        "id": 1,
        "start_date": "2024-12-05T00:00:00.000000Z",
        "title": "Aut sapiente architecto expedita quia magnam sint",
        "description": "Amet perspiciatis aspernatur culpa quibusdam est",
        "capacity": 42,
        "location": "Virtual",
        "status": "Published",
        "type": "Social"
    }
}
```

## POST
`Logout` [/api/auth/logout]

Requires Authentication (bearer token). 


**Response**

```
{
    "message": "Logged out successfully"
}
```

## GET
`Get User Events` [/api/user/events]

Requires Authentication (bearer token). 

Paginated Results

**Response**

```
{
    "data": [
        {
            "id": 2,
            "start_date": "2024-12-05T00:00:00.000000Z",
            "title": "Quaerat aut quod qui in rerum excepturi totam plac",
            "description": "Id qui sunt aperiam reprehenderit error architec",
            "capacity": 93,
            "location": "Virtual",
            "status": "Draft",
            "type": "Training"
        }
    ],
    "links": {
        "first": "http://event-manager.test/api/user/events?page=1",
        "last": "http://event-manager.test/api/user/events?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://event-manager.test/api/user/events?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://event-manager.test/api/user/events",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}
```
