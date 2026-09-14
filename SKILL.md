---
name: demo-api-scalar-galaxy-php-sdk
description: "PHP SDK for Demo API (Scalar Galaxy). Use when writing PHP code that calls Demo API (Scalar Galaxy) with the scalar/demo-api-scalar-galaxy package: installing it, constructing and authenticating the client, and calling API operations."
---

# Demo API (Scalar Galaxy) PHP SDK

Generated PHP client for Demo API (Scalar Galaxy), published as `scalar/demo-api-scalar-galaxy`. Use the generated client instead of hand-writing HTTP requests.

## Install

```sh
composer require scalar/demo-api-scalar-galaxy
```

## Client setup and authentication

```php
<?php

use DemoAPIScalarGalaxy\Client;

$client = new Client(bearerAuth: getenv('BEARER_AUTH') ?: null);
```

Provide credentials using the options below. Environment variables are read automatically when the target runtime supports them:

- `bearerAuth` (env: `BEARER_AUTH`) — JWT Bearer token authentication
- `basicAuthUsername` (env: `BASIC_AUTH_USERNAME`) — Credential sent with every request.
- `basicAuthPassword` (env: `BASIC_AUTH_PASSWORD`) — Credential sent with every request.
- `apiKeyHeader` (env: `API_KEY_HEADER`) — API key request header
- `apiKeyQuery` (env: `API_KEY_QUERY`) — API key query parameter
- `apiKeyCookie` (env: `API_KEY_COOKIE`) — API key browser cookie
- `oAuth2` (env: `O_AUTH2`) — OAuth 2.0 authentication
- `openIDConnect` (env: `OPEN_ID_CONNECT`) — OpenID Connect Authentication

## Calling operations

```php
<?php

use DemoAPIScalarGalaxy\Client;

$client = new Client(bearerAuth: getenv('BEARER_AUTH') ?: null);

$response = $client->planets->list(limit: 10, offset: 0);

var_dump($response);
```

Method names, parameter shapes, and response types are generated from the API description — do not guess them. Look up the exact call signature in [api.md](./api.md) before writing a call.

## Error handling

Non-success responses throw generated API errors. Error objects expose status, headers, response body, and request metadata where the target runtime supports it.

## Requirements

- PHP >=8.1

## Reference files

- [README.md](./README.md) — full feature tour: client options, request options, retries and timeouts.
- [api.md](./api.md) — complete catalogue of every operation with request and response types.
