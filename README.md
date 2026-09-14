# Demo API (Scalar Galaxy)

This library provides convenient access to the Demo API (Scalar Galaxy) from PHP.

The full API of this library can be found in [api.md](./api.md).

<br />

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [API Reference](./api.md)
- [Authentication](#authentication)
- [Errors](#errors)
- [Client Options](#client-options)
- [Request Options](#request-options)
- [Retries and Timeouts](#retries-and-timeouts)
- [Helpers](#helpers)
- [Requirements](#requirements)

<br />

## Installation

```sh
composer require scalar/demo-api-scalar-galaxy
```

<br />

## Usage

```php
<?php

use DemoAPIScalarGalaxy\Client;

$client = new Client(bearerAuth: getenv('BEARER_AUTH') ?: null);

$response = $client->planets->list(limit: 10, offset: 0);

var_dump($response);
```

The examples in the following sections assume a `client` configured as shown above.

See the [API reference](./api.md) for every available operation.

<br />

## Authentication

Pass credentials to the generated client constructor. Environment variables are read automatically when supported by the target runtime.

| Option | Type | Default | Description |
| --- | --- | --- | --- |
| `bearerAuth` | `string \| provider` | - | JWT Bearer token authentication Defaults to BEARER_AUTH. |
| `basicAuthUsername` | `string \| provider` | - | Credential sent with every request. Defaults to BASIC_AUTH_USERNAME. |
| `basicAuthPassword` | `string \| provider` | - | Credential sent with every request. Defaults to BASIC_AUTH_PASSWORD. |
| `apiKeyHeader` | `string \| provider` | - | API key request header Defaults to API_KEY_HEADER. |
| `apiKeyQuery` | `string \| provider` | - | API key query parameter Defaults to API_KEY_QUERY. |
| `apiKeyCookie` | `string \| provider` | - | API key browser cookie Defaults to API_KEY_COOKIE. |
| `oAuth2` | `string \| provider` | - | OAuth 2.0 authentication Defaults to O_AUTH2. |
| `openIDConnect` | `string \| provider` | - | OpenID Connect Authentication Defaults to OPEN_ID_CONNECT. |

Declared schemes:

- `bearerAuth` bearer token
- `basicAuth` basic authentication
- `apiKeyHeader` API key in header `X-API-Key`
- `apiKeyQuery` API key in query `api_key`
- `apiKeyCookie` API key in cookie `api_key`
- `oAuth2` OAuth2/OpenID Connect
- `openIdConnect` OAuth2/OpenID Connect

<br />

## Errors

Non-success responses throw generated API errors. Error objects expose status, headers, response body, and request metadata where the target runtime supports it.

Documented error statuses: `400`, `401`, `403`, `404`, `409`, `422`.

<br />

## Client Options

Configure the generated client by setting any of these options when you create it.

```php
<?php

use DemoAPIScalarGalaxy\Client;

$client = new Client(requestOptions: ['timeout' => 30.0, 'maxRetries' => 2]);
```

| Option | Type | Default | Description |
| --- | --- | --- | --- |
| `bearerAuth` | `string\|null` | `getenv("BEARER_AUTH")` | JWT Bearer token authentication |
| `basicAuthUsername` | `string\|null` | `getenv("BASIC_AUTH_USERNAME")` | Credential sent with every request. |
| `basicAuthPassword` | `string\|null` | `getenv("BASIC_AUTH_PASSWORD")` | Credential sent with every request. |
| `apiKeyHeader` | `string\|null` | `getenv("API_KEY_HEADER")` | API key request header |
| `apiKeyQuery` | `string\|null` | `getenv("API_KEY_QUERY")` | API key query parameter |
| `apiKeyCookie` | `string\|null` | `getenv("API_KEY_COOKIE")` | API key browser cookie |
| `oAuth2` | `string\|null` | `getenv("O_AUTH2")` | OAuth 2.0 authentication |
| `openIDConnect` | `string\|null` | `getenv("OPEN_ID_CONNECT")` | OpenID Connect Authentication |
| `webhookSecret` | `string\|null` | `getenv("OFFICIAL_GALAXY_TESTING_WEBHOOK_SECRET")` | Secret used to verify incoming webhook signatures. |
| `baseUrl` | `string\|null` | - | Override the default API base URL. |
| `requestOptions` | `RequestOptions\|array\|null` | - | Defaults merged into every request: timeout, retries, extra headers, and the transport. |

<br />

## Request Options

| Option | Type | Default | Description |
| --- | --- | --- | --- |
| `timeout` | `float` | - | Seconds to wait for a response before timing out. |
| `maxRetries` | `int` | - | Maximum number of retries for temporary failures. |
| `extraHeaders` | `array` | - | Additional headers for one request. |
| `extraQueryParams` | `array` | - | Additional query parameters for one request. |
| `extraBodyParams` | `array` | - | Additional body fields for one request. |
| `idempotencyKey` | `string` | - | Value for the configured idempotency header. |

<br />

## Retries and Timeouts

Generated clients support request timeouts and retry temporary failures such as network errors, 408, 409, 429, and 5xx responses. Retry delays honor `Retry-After` headers when present. Tune the retry and timeout client options shown above, or override them per request.

<br />

## Helpers

- Every model implements `BaseModel`: pass a plain array or a model instance, and read decoded values back as typed properties.
- Every service exposes a `raw` twin returning the undecoded `BaseResponse`, for callers that need the status line or the headers.
- Paginated methods return a page you can `foreach` directly, or walk item by item with `pagingEachItem()`.

<br />

## Requirements

- PHP >=8.1

Powered by Scalar.
