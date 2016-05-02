<?php
namespace Ofertix\SimpleOauthClientBundle\Repository;

use Component\OauthClient\Domain\Infrastructure\OauthClientRepositoryInterface;

class OauthClientRepository implements OauthClientRepositoryInterface
{
    public function getToken()
    {
        return false;
    }

    public function saveToken($accessToken)
    {
        return $accessToken;
    }
}
