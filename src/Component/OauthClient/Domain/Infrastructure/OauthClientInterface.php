<?php
namespace SimpleOauthClient\Component\OauthClient\Domain\Infrastructure;

interface OauthClientInterface
{
    /**
     * @param $token
     */
    public function setToken($token);

    /**
     * @return string
     */
    public function getToken();

    /**
     * @param $method
     * @param $url
     * @param $params
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function get($method, $url, $params = array());
}
