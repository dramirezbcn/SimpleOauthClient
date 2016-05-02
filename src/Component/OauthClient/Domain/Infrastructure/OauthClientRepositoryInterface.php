<?php
namespace Component\OauthClient\Domain\Infrastructure;

interface OauthClientRepositoryInterface
{
    public function getToken();

    public function saveToken($accessToken);
}
