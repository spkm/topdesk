<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Requests\Login\GetLoginOperatorRequest;
use spkm\Topdesk\Requests\Login\GetLoginPersonRequest;
use spkm\Topdesk\Requests\Login\LogoutRequest;

/**
 * The login endpoints of TOPdesk's General API, from Topdesk::login().
 *
 * @extends BaseResource<Data>
 */
class LoginResource extends BaseResource
{
    /**
     * Login - (Deprecated) Log in as an operator: GET /tas/api/login/operator.
     *
     * @deprecated TOPdesk deprecated this endpoint.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getLoginOperator(array $options = []): mixed
    {
        return $this->fetch(new GetLoginOperatorRequest($options));
    }

    /**
     * Log out as operator or person: GET /tas/api/logout.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function logout(array $options = []): mixed
    {
        return $this->fetch(new LogoutRequest($options));
    }

    /**
     * Login - as a person: GET /tas/api/login/person.
     *
     * The token TOPdesk gives a person for their login name and password. Topdesk::asPerson() signs in this way for
     * you.
     */
    public function getLoginPerson(string $loginName, #[\SensitiveParameter] string $password): mixed
    {
        return $this->fetch(new GetLoginPersonRequest($loginName, $password));
    }
}
