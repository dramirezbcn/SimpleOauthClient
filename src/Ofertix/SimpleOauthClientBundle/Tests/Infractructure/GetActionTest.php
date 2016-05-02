<?php
namespace Ofertix\SimpleOauthClientBundle\Tests\Infrastructure;

use Component\OauthClient\Application\GetAction;
use Component\OauthClient\Application\Request\UrlRequest;
use Component\OauthClient\Domain\Model\MethodType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetActionTest extends KernelTestCase
{
    /** @var  GetAction */
    private $sut;

    public function setUp()
    {
        static::bootKernel();
    }

    public function testGetActionByPost()
    {
        $this->sut = static::$kernel->getContainer()->get('simple_oauth_client.get_url');

        $clientOauthRequest = new UrlRequest(
            MethodType::POST,
            "http://gat.ofertix.dev/app_dev.php/api/sections"
        );

        $result = $this->sut->execute($clientOauthRequest);
        $this->assertCount(2, $result);
    }
}
