<?php

return [
    // Your TOPdesk server's address, such as https://yourcompany.topdesk.net. A path after it (/tas/ or /tas/api) is
    // ignored: the package adds the path each of TOPdesk's APIs lives under.
    'base_url' => env('TOPDESK_BASE_URL'),

    // An operator's login name and application token (My settings > Application tokens, or an API account's card),
    // which TOPdesk recommends for an integration. The operator needs the REST API permission, and the permissions
    // for what the integration reads and changes.
    'username' => env('TOPDESK_USERNAME'),
    'application_token' => env('TOPDESK_APPLICATION_TOKEN'),

    // Or an OAuth client (Connected applications), used when no application token is set.
    'client_id' => env('TOPDESK_CLIENT_ID'),
    'client_secret' => env('TOPDESK_CLIENT_SECRET'),

    // Other TOPdesk servers, used with Topdesk::connection('name'):
    // 'connections' => [
    //     'test' => ['base_url' => ..., 'username' => ..., 'application_token' => ...],
    //     'other' => ['base_url' => ..., 'client_id' => ..., 'client_secret' => ...],
    // ],
    'connections' => [],

    'timeouts' => [
        'connect' => env('TOPDESK_CONNECT_TIMEOUT', 10),
        'request' => env('TOPDESK_REQUEST_TIMEOUT', 30),
    ],

    'retries' => [
        'times' => env('TOPDESK_RETRIES'),
        'interval_ms' => 500,
    ],

    // For a person or an OAuth client: fetch a new token and send the request again, once, when TOPdesk answers
    // 401 to it.
    'reauthenticate' => true,

    // How long a person's token (from Topdesk::asPerson()) is used before the package signs them in again.
    // TOPdesk doesn't say when a token expires; one it refuses is replaced anyway.
    'person_token_seconds' => 1200,

    'cache' => [
        // Cache the answers to GET requests for records, per server and sign-in.
        'enabled' => env('TOPDESK_CACHE', false),
        'store' => env('TOPDESK_CACHE_STORE'),
        'seconds' => 3600,
    ],

    'pagination' => [
        // Records per page when paging through a list with all(), lazy() or paginate(), up to what each endpoint
        // allows.
        'per_page' => 100,
    ],
];
