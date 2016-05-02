<?php
namespace Component\OauthClient\Domain\Model;

use Component\OauthClient\Domain\Infrastructure\OauthClientInterface;

class ClientAdapter implements OauthClientInterface
{
    /** @var  OauthClientInterface */
    private $oauth2Client;

    public function __construct(OauthClientInterface $client)
    {
        $this->oauth2Client = $client;
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->oauth2Client->setToken($token);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->oauth2Client->getToken();
    }

    /**
     * @param $method
     * @param $url
     * @param $params
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function get($method, $url, $params = array())
    {
        return $this->oauth2Client->get($method, $url, $params);
    }
}
