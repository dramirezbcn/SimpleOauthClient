<?php
namespace SimpleOauthClient\Component\OauthClient\Application\Request;

class UrlRequest
{
    /** @var  string */
    protected $method;

    /** @var  string */
    protected $url;

    /** @var  array */
    protected $params;

    /**
     * UrlRequest constructor.
     * @param string $method
     * @param string $url
     * @param array $params
     */
    public function __construct($method, $url, $params = array())
    {
        $this->method = $method;
        $this->url = $url;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function params()
    {
        return $this->params;
    }
}
