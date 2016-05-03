<?php
namespace SimpleOauthClient\Component\OauthClient\Domain\Model;

use SimpleOauthClient\Component\OauthClient\Domain\Infrastructure\OauthClientInterface;
use Guzzle\Common\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class OauthClient implements OauthClientInterface
{
    /** @var  Client */
    private $oauth2Client;

    /** @var  AccessToken */
    private $accessToken;

    /** @var array  */
    private $config;

    /**
     * OauthClient constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->oauth2Client = new Client(['base_url' => $config['base_url']]);
        $this->config = Collection::fromConfig($config, $this->getDefaults(), $this->getRequired());
    }

    /**
     * @return array
     */
    protected function getDefaults()
    {
        return [
            'client_secret' => '',
            'scope' => '',
            'token_url' => 'oauth2/token',
            'auth_location' => 'headers',
        ];
    }

    /**
     * Get required configuration items.
     *
     * @return array
     */
    protected function getRequired()
    {
        return [
            'client_id',
            'client_secret'
        ];
    }

    /**
     * Get additional options, if any.
     *
     * @return array|null
     */
    protected function getAdditionalOptions()
    {
        return null;
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->accessToken = $token;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        if (!$this->accessToken) {
            $this->accessToken = $this->getAccessToken();
        }
        return $this->accessToken->getToken();
    }

    /**
     * @return AccessToken
     */
    private function getAccessToken()
    {
        $config = $this->config->toArray();

        $body = $config;
        $body['grant_type'] = 'client_credentials';
        unset($body['token_url'], $body['auth_location']);

        $requestOptions = [];

        if ($config['auth_location'] !== 'body') {
            $requestOptions['auth'] = [$config['client_id'], $config['client_secret']];
            unset($body['client_id'], $body['client_secret']);
        }

        $requestOptions['form_params'] = $body;

        if ($additionalOptions = $this->getAdditionalOptions()) {
            $requestOptions = array_merge_recursive($requestOptions, $additionalOptions);
        }

        $response = $this->oauth2Client->request('POST', $config['token_url'], $requestOptions);
        $data = json_decode($response->getBody(), true);

        return new AccessToken($data['access_token'], $data['token_type'], $data);
    }

    /**
     * @param $method
     * @param $url
     * @param $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($method, $url, $params = array())
    {
        $request = new Request(
            $method,
            $url,
            ['Authorization' => 'Bearer ' . $this->accessToken->getToken()]
        );

        return $this->oauth2Client->send($request, ['form_params' => $params]);
    }
}
