<?php
namespace Component\OauthClient\Domain\Model;

class OauthClientFactory
{
    public static function create(array $config)
    {
        return new OauthClient($config);
    }
}
