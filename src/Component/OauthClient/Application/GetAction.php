<?php
namespace Component\OauthClient\Application;

use Component\OauthClient\Application\Request\UrlRequest;
use Component\OauthClient\Domain\Infrastructure\OauthClientInterface;
use Component\OauthClient\Domain\Infrastructure\OauthClientRepositoryInterface;

class GetAction
{
    /** @var OauthClientRepositoryInterface **/
    private $repository;

    /** @var OauthClientInterface **/
    private $client;


    public function __construct(
        OauthClientRepositoryInterface $repository,
        OauthClientInterface $client
    ) {
        $this->repository = $repository;
        $this->client = $client;
    }

    /**
     * @param UrlRequest $oauthClientRequest
     * @return bool
     */
    public function execute(UrlRequest $oauthClientRequest)
    {
        $cachedToken = $this->repository->getToken();

        if ($cachedToken) {
            $this->client->setToken($cachedToken);
        } else {
            $this->repository->saveToken($this->client->getToken());
        }

        $response = $this->client->get(
            $oauthClientRequest->method(),
            $oauthClientRequest->url(),
            $oauthClientRequest->params()
        );

        $result = json_decode($response->getBody(), true);

        return $result;
    }
}
