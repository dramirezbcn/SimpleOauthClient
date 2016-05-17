<?php
namespace SimpleOauthClient\Component\OauthClient\Application\Request;

use Psr\Http\Message\StreamInterface;

class UrlResponse
{
    /** @var int */
    private $statusCode;

    /** @var  array */
    protected $headers;

    /** @var  StreamInterface */
    protected $body;

    /**
     * UrlResponse constructor.
     * @param $statusCode
     * @param array $headers
     * @param StreamInterface $body
     */
    public function __construct($statusCode, $headers, $body)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function statusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function headers()
    {
        return $this->headers;
    }

    /**
     * @return StreamInterface
     */
    public function body()
    {
        return $this->body;
    }
}
