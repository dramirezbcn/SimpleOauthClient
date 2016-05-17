<?php
namespace SimpleOauthClient\Component\OauthClient\Application;

use Psr\Http\Message\ResponseInterface;
use SimpleOauthClient\Component\OauthClient\Application\Request\UrlRequest;
use SimpleOauthClient\Component\OauthClient\Application\Request\UrlResponse;
use SimpleOauthClient\Component\OauthClient\Domain\Infrastructure\OauthClientInterface;
use SimpleOauthClient\Component\OauthClient\Domain\Infrastructure\OauthClientRepositoryInterface;

class GetAction
{
    /** @var OauthClientRepositoryInterface **/
    private $repository;

    /** @var OauthClientInterface **/
    private $client;


    public function __construct(
        OauthClientRepositoryInterface $repository = null,
        OauthClientInterface $client
    ) {
        $this->repository = $repository;
        $this->client = $client;
    }

    /**
     * @param UrlRequest $oauthClientRequest
     * @return mixed|ResponseInterface
     */
    public function execute(UrlRequest $oauthClientRequest)
    {
        if (!is_null($this->repository)) {
            $cachedToken = $this->repository->getToken();

            if ($cachedToken) {
                $this->client->setToken($cachedToken);
            } else {
                $this->repository->saveToken($this->client->getToken());
            }
        }

        $result = $this->client->get(
            $oauthClientRequest->method(),
            $oauthClientRequest->url(),
            $oauthClientRequest->params()
        );
        
        return new UrlResponse(
            $result->getStatusCode(), 
            $result->getHeaders(), 
            $result->getBody()
        );
    }
}
