<?php declare(strict_types = 1);

namespace FrameworkTest\Action;

use DateTime;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;

use Framework\Action\Ping;

/**
 * PostOrdersTest
 *
 * @author Vasil Dakov <vasil.dakov@worldstores.co.uk>
 */
class PingTest extends \PHPUnit\Framework\TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject|ServerRequestInterface $request */
    protected $request;

    /** @var \PHPUnit_Framework_MockObject_MockObject|ResponseInterface $response */
    protected $response;

    /** @var \PHPUnit_Framework_MockObject_MockObject|DelegateInterface $delegate */
    protected $delegate;

    public function setUp()
    {
        $this->request  = $this->getMockForAbstractClass(ServerRequestInterface::class);
        $this->response = $this->getMockForAbstractClass(ResponseInterface::class);
        $this->delegate = $this->getMockForAbstractClass(DelegateInterface::class);
    }

    /**
     * @test
     */
    public function itCanBeConstructed()
    {
        $ping = new Ping(new DateTime());

        static::assertInstanceOf(Ping::class, $ping);
    }

    /**
     * @test
     */
    public function itCanBeProcessedWith()
    {
        $ping = new Ping(new DateTime());

        $response = $ping->process($this->request, $this->delegate);

        static::assertInstanceOf(ResponseInterface::class, $response);
    }

    /**
     * @test
     */
    public function itCanBeProcessedWithout()
    {
        $ping = new Ping(new DateTime());

        $response = $ping->process($this->request);

        static::assertInstanceOf(ResponseInterface::class, $response);
    }
}
