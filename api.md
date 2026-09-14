# Demo API (Scalar Galaxy) PHP API

Complete reference of every operation, grouped by resource. See [the README](./README.md) for usage and configuration.

## Contents

- [`Planets`](#planets)
  - [Get all planets](#get-all-planets)
  - [Create a planet](#create-a-planet)
  - [Get a planet](#get-a-planet)
  - [Update a planet](#update-a-planet)
  - [Delete a planet](#delete-a-planet)
  - [Upload an image to a planet](#upload-an-image-to-a-planet)
- [`CelestialBodies`](#celestialbodies)
  - [Create a celestial body](#create-a-celestial-body)
- [`Authentication`](#authentication)
  - [Create a user](#create-a-user)
  - [Get a token](#get-a-token)
  - [Get authenticated user](#get-authenticated-user)

## Setup

```php
<?php

use DemoAPIScalarGalaxy\Client;

$client = new Client(bearerAuth: getenv('BEARER_AUTH') ?: null);
```

## `Planets`

Everything about planets

### Get all planets

It's easy to say you know them all, but do you really? Retrieve all the planets and check whether you missed one.

| Direction | Type |
| --- | --- |
| Request | [`PlanetListParams`](././src/Planets/PlanetListParams.php) |

```php
$response = $client->planets->list(limit: 10, offset: 0);

var_dump($response);
```

### Create a planet

Time to play god and create a new planet. What do you think? Ah, don't think too much. What could go wrong anyway?

| Direction | Type |
| --- | --- |
| Request | [`PlanetCreateParams`](././src/Planets/PlanetCreateParams.php) |

```php
$response = $client->planets->create(
    name: 'Mars',
    type: 'terrestrial',
    atmosphere: [[]],
    creator: [],
    description: 'The red planet',
    discoveredAt: new \DateTimeImmutable('1610-01-07T00:00:00Z'),
    failureCallbackURL: 'https://example.com/webhook',
    habitabilityIndex: 0.68,
    image: 'https://cdn.scalar.com/photos/mars.jpg',
    physicalProperties: [],
    satellites: [['name' => 'Phobos', 'type' => 'moon']],
    successCallbackURL: 'https://example.com/webhook',
    tags: [''],
);

var_dump($response);
```

### Get a planet

You'll better learn a little bit more about the planets. It might come in handy once space travel is available for everyone.

```php
$response = $client->planets->retrieve(1);

var_dump($response);
```

### Update a planet

Sometimes you make mistakes, that's fine. No worries, you can update all planets.

| Direction | Type |
| --- | --- |
| Request | [`PlanetUpdateParams`](././src/Planets/PlanetUpdateParams.php) |

```php
$response = $client->planets->update(
    1,
    name: 'Mars',
    type: 'terrestrial',
    atmosphere: [[]],
    creator: [],
    description: 'The red planet',
    discoveredAt: new \DateTimeImmutable('1610-01-07T00:00:00Z'),
    failureCallbackURL: 'https://example.com/webhook',
    habitabilityIndex: 0.68,
    image: 'https://cdn.scalar.com/photos/mars.jpg',
    physicalProperties: [],
    satellites: [['name' => 'Phobos', 'type' => 'moon']],
    successCallbackURL: 'https://example.com/webhook',
    tags: [''],
);

var_dump($response);
```

### Delete a planet

This endpoint was used to delete planets. Unfortunately, that caused a lot of trouble for planets with life. So, this endpoint is now deprecated and should not be used anymore.

```php
$client->planets->delete(1);
```

### Upload an image to a planet

Got a crazy good photo of a planet? Share it with the world!

| Direction | Type |
| --- | --- |
| Request | [`PlanetUploadImageParams`](././src/Planets/PlanetUploadImageParams.php) |

```php
$response = $client->planets->uploadImage(1, image: 'smoke-test');

var_dump($response);
```

## `CelestialBodies`

Celestial bodies are the planets and satellites in the Scalar Galaxy.

### Create a celestial body

| Direction | Type |
| --- | --- |
| Request | [`CelestialBodyCreateParams`](././src/CelestialBodies/CelestialBodyCreateParams.php) |

```php
$response = $client->celestialBodies->create(
    name: 'Mars',
    type: 'terrestrial',
    atmosphere: [[]],
    creator: [],
    description: 'The red planet',
    discoveredAt: new \DateTimeImmutable('1610-01-07T00:00:00Z'),
    failureCallbackURL: 'https://example.com/webhook',
    habitabilityIndex: 0.68,
    image: 'https://cdn.scalar.com/photos/mars.jpg',
    physicalProperties: [],
    satellites: [['name' => 'Phobos', 'type' => 'moon']],
    successCallbackURL: 'https://example.com/webhook',
    tags: [''],
    diameter: 22.2,
    orbit: [],
);

var_dump($response);
```

## `Authentication`

Some endpoints are public, but some require authentication. We provide all the required endpoints to create an account and authorize yourself.

### Create a user

Time to create a user account, eh?

| Direction | Type |
| --- | --- |
| Request | [`AuthenticationCreateUserParams`](././src/Authentication/AuthenticationCreateUserParams.php) |

```php
$response = $client->authentication->createUser(
    email: 'marc@scalar.com',
    password: 'i-love-scalar',
    name: 'Marc',
);

var_dump($response);
```

### Get a token

Yeah, this is the boring security stuff. Just get your super secret token and move on.

| Direction | Type |
| --- | --- |
| Request | [`AuthenticationCreateTokenParams`](././src/Authentication/AuthenticationCreateTokenParams.php) |

```php
$response = $client->authentication->createToken(
    email: 'marc@scalar.com',
    password: 'i-love-scalar',
);

var_dump($response);
```

### Get authenticated user

Find yourself they say. That's what you can do here.

```php
$response = $client->authentication->listMe();

var_dump($response);
```
