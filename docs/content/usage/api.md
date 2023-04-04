?> For more details on the data returned by the endpoints visit the [official documentation](https://api.circle.so/)

!> For details on the values accepted for each parameter pelase visit the [official documentation](https://api.circle.so/)

## Me

The __Me__ API lets you retrieve information about you, the owner of the API key being used to authenticate with the Circle API.

### info()

Returns an array with the info of the owner of the API key.

```php
$me = $circleSo->me()->info();
```

## Members

The __Members__ API lets you retrieve, invite, or remove members from your community.

### communityMembers()

Retrieve a list of all the members that belong to a community.

```php
$members = $circleSo->members()->communityMembers(
    sortBy: 'latest', // Optional
    perPage: 10, // Optional
    page: 1, // Optional
    status: 'active', // Optional
    communityId: 1, // Required,
);
```

### search()

Search for a member that belongs to a community using the `email`

```php
$member = $circleSo->members()->search(
    email: 'adro@example.com', // Required,
    communityId: 1, // Required,
);
```

### member()

Retrieve a member that belong to a community using the `id`.

```php
$member = $circleSo->members()->member(
    id: 123, // Required,
    communityId: 1, // Required,
);
```

### update()

Update an existing member of your community.

```php
$member = $circleSo->members()->update(
    id: 1, // Required,
    data: ['first_name' => 'Adroeck'], // Required,
    spaceIds: [1,2,3,], // Optional
    spaceGroupIds: [1,2,3,], // Optional
    skipInvitation: true // Optional
);
```
