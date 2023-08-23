<?php declare(strict_types = 1);

namespace Framework;

use Framework\Router\RouterInterface;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\Response;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

/*
 * Application
 */
class Application implements ApplicationInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var EmitterInterface
     */
    private $emitter;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Constructor
     *
     * @param RouterInterface|null    $router
     * @param EmitterInterface|null   $emitter
     */
    public function __construct(
        RouterInterface $router = null,
        EmitterInterface $emitter = null
    ) {
        $this->router     = $router;
        $this->emitter    = $emitter;
    }

    public function getEmitter()
    {
        if (!$this->emitter) {
            $this->emitter = new SapiEmitter();
        }
        return $this->emitter;
    }

    /**
     * Emitting responses
     *
     * @param ServerRequestInterface
     */
    public function run(ServerRequestInterface $request = null)
    {
        $request = $request ?: ServerRequestFactory::fromGlobals();

        $response = $this->process($request);

        $emitter = $this->getEmitter();
        $emitter->emit($response);
    }


    /**
     * Route
     *
     * @param  string $path
     * @param  string $handler
     * @param  string $method
     * @param  string $name
     * @return Router\Route
     */
    public function route($path, $handler, $method, $name)
    {
        $route = new Router\Route($path, $handler, $method, $name);
        $this->router->add($route);

        return $route;
    }


    /**
     * Process
     *
     * @param  ServerRequestInterface $request
     * @return ResponseInterface $response
     */
    public function process(ServerRequestInterface $request)
    {
        $route = $this->router->match($request);

        if ($route) {
            $middleware = $route->handler;
            return $middleware->process($request);
        }
        return new Response\EmptyResponse();
    }
}
