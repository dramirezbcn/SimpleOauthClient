<?php
namespace SimpleOauthClient\Component\OauthClient\Domain\Infrastructure;

interface OauthClientRepositoryInterface
{
    public function getToken();

    public function saveToken($accessToken);
}
