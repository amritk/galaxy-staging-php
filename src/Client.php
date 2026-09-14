<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy;

use DemoAPIScalarGalaxy\Core\BaseClient;
use DemoAPIScalarGalaxy\Core\Implementation\StreamingHttpClient;
use DemoAPIScalarGalaxy\Core\Util;
use DemoAPIScalarGalaxy\Services\AuthenticationService;
use DemoAPIScalarGalaxy\Services\CelestialBodiesService;
use DemoAPIScalarGalaxy\Services\PlanetsService;
use DemoAPIScalarGalaxy\Services\WebhooksService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \DemoAPIScalarGalaxy\Core\BaseClient
 * @phpstan-import-type RequestOpts from \DemoAPIScalarGalaxy\RequestOptions
 */
class Client extends BaseClient
{
    public string $bearerAuth;

    public string $basicAuthUsername;

    public string $basicAuthPassword;

    public string $apiKeyHeader;

    public string $apiKeyQuery;

    public string $apiKeyCookie;

    public string $oAuth2;

    public string $openIDConnect;

    public string $webhookSecret;

    /**
     * @api
     */
    public PlanetsService $planets;

    /**
     * @api
     */
    public CelestialBodiesService $celestialBodies;

    /**
     * @api
     */
    public AuthenticationService $authentication;

    /**
     * @api
     */
    public WebhooksService $webhooks;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $bearerAuth = null,
        ?string $basicAuthUsername = null,
        ?string $basicAuthPassword = null,
        ?string $apiKeyHeader = null,
        ?string $apiKeyQuery = null,
        ?string $apiKeyCookie = null,
        ?string $oAuth2 = null,
        ?string $openIDConnect = null,
        ?string $webhookSecret = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->bearerAuth = (string) (
            $bearerAuth ?? Util::getenv('BEARER_AUTH')
        );
        $this->basicAuthUsername = (string) (
            $basicAuthUsername ?? Util::getenv('BASIC_AUTH_USERNAME')
        );
        $this->basicAuthPassword = (string) (
            $basicAuthPassword ?? Util::getenv('BASIC_AUTH_PASSWORD')
        );
        $this->apiKeyHeader = (string) (
            $apiKeyHeader ?? Util::getenv('API_KEY_HEADER')
        );
        $this->apiKeyQuery = (string) (
            $apiKeyQuery ?? Util::getenv('API_KEY_QUERY')
        );
        $this->apiKeyCookie = (string) (
            $apiKeyCookie ?? Util::getenv('API_KEY_COOKIE')
        );
        $this->oAuth2 = (string) ($oAuth2 ?? Util::getenv('O_AUTH2'));
        $this->openIDConnect = (string) (
            $openIDConnect ?? Util::getenv('OPEN_ID_CONNECT')
        );
        $this->webhookSecret = (string) (
            $webhookSecret ?? Util::getenv(
                'OFFICIAL_GALAXY_TESTING_WEBHOOK_SECRET',
            )
        );

        $baseUrl ??= Util::getenv('OFFICIAL_GALAXY_TESTING_BASE_URL')
        ?: 'https://galaxy.scalar.com';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        if (is_null($options->streamingTransporter)) {
            assert(!is_null($options->transporter));
            $options->streamingTransporter =
                new StreamingHttpClient($options->transporter);
        }

        /** @var array<string, string|null> $headers */
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => sprintf('DemoApiScalarGalaxy/PHP %s', VERSION),
            'X-Scalar-Lang' => 'php',
            'X-Scalar-Package-Version' => VERSION,
            'X-Scalar-Arch' => Util::machtype(),
            'X-Scalar-OS' => Util::ostype(),
            'X-Scalar-Runtime' => php_sapi_name(),
            'X-Scalar-Runtime-Version' => phpversion(),
        ];

        $customHeadersEnv = Util::getenv(
            'OFFICIAL_GALAXY_TESTING_CUSTOM_HEADERS',
        );
        if (null !== $customHeadersEnv) {
            foreach (explode("\n", $customHeadersEnv) as $line) {
                $colon = strpos($line, ':');
                if (false !== $colon) {
                    $headers[trim(substr($line, 0, $colon))] = trim(substr(
                        $line,
                        $colon + 1,
                    ));
                }
            }
        }

        parent::__construct(
            headers: $headers,
            baseUrl: $baseUrl,
            options: $options,
        );

        $this->planets = new PlanetsService($this);
        $this->celestialBodies = new CelestialBodiesService($this);
        $this->authentication = new AuthenticationService($this);
        $this->webhooks = new WebhooksService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return [
            ...$this->bearerAuthScheme(),
            ...$this->basicAuth(),
            ...$this->apiKeyHeaderScheme(),
            ...$this->oAuth2Scheme(),
            ...$this->openIDConnectScheme(),
        ];
    }

    /** @return array<string,string> */
    protected function bearerAuthScheme(): array
    {
        return (
            $this->bearerAuth
                ? ['Authorization' => "Bearer {$this->bearerAuth}"]
                : []
        );
    }

    /** @return array<string,string> */
    protected function basicAuth(): array
    {
        if (!$this->basicAuthUsername && !$this->basicAuthPassword) {
            return [];
        }

        $base64_credentials = base64_encode(
            "{$this->basicAuthUsername}:{$this->basicAuthPassword}",
        );

        return ['Authorization' => "Basic {$base64_credentials}"];
    }

    /** @return array<string,string> */
    protected function apiKeyHeaderScheme(): array
    {
        return $this->apiKeyHeader ? ['X-API-Key' => $this->apiKeyHeader] : [];
    }

    /** @return array<string,string> */
    protected function oAuth2Scheme(): array
    {
        return (
            $this->oAuth2 ? ['Authorization' => "Bearer {$this->oAuth2}"] : []
        );
    }

    /** @return array<string,string> */
    protected function openIDConnectScheme(): array
    {
        return (
            $this->openIDConnect
                ? ['Authorization' => "Bearer {$this->openIDConnect}"]
                : []
        );
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
