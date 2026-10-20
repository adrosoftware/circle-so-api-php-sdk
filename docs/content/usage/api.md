?> For more details on the data returned by the endpoints visit the [official documentation](https://api.circle.so/)

!> For details on the values accepted for each parameter please visit the [official documentation](https://api.circle.so/)

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

## V1 endpoint groups

The client exposes the complete published V1 resource set:

```php
$circleSo->communities();
$circleSo->spaceGroups();
$circleSo->spaceGroupMembers();
$circleSo->spaces();
$circleSo->spaceMembers();
$circleSo->posts();
$circleSo->comments();
$circleSo->members();
$circleSo->memberTags();
$circleSo->taggedMembers();
$circleSo->messages();
$circleSo->subscriptions();
$circleSo->events();
$circleSo->eventAttendees();
$circleSo->charges();
$circleSo->likes();
$circleSo->communityMemberSpaces();
$circleSo->profileFields();
$circleSo->courses();
$circleSo->notifications();
$circleSo->topics();
$circleSo->contacts();
$circleSo->flaggedContents();
```

Set a community once when making several scoped calls:

```php
$posts = $circleSo->posts()
    ->communityId(123)
    ->all(spaceId: 456);
```

## Admin API V2

Use an Admin API token with the V2 client. Its resource methods cover all 171
operations published in Circle's Admin API V2 specification.

```php
use AdroSoftware\CircleSoSdk\AdminV2;

$admin = AdminV2::make($adminApiToken);

$members = $admin->communityMembers()->all(['page' => 1]);
$space = $admin->spaces()->show(123);
$post = $admin->posts()->create([
    'space_id' => 123,
    'name' => 'Welcome',
    'body' => 'Welcome to the community.',
]);
```

## Headless Auth and Member APIs

Create a member access token with the Headless Auth client, then pass that
access token to the Headless Member client. These clients cover all 4 Auth and
102 Member operations in Circle's published specifications.

```php
use AdroSoftware\CircleSoSdk\HeadlessAuth;
use AdroSoftware\CircleSoSdk\HeadlessMember;

$auth = HeadlessAuth::make($headlessApiToken);
$tokens = $auth->tokens()->createGetAnAuthToken([
    'email' => 'member@example.com',
]);

$member = HeadlessMember::make($tokens['access_token']);
$spaces = $member->spaces()->getListOfSpaces();
$notifications = $member->notifications()->getAPaginatedListOfNotifications([
    'page' => 1,
]);
```

All API clients retain the configured response factory. For forward
compatibility, call `raw()->call($method, $path, $query, $data)` on any client.
