<?php

declare(strict_types = 1);

namespace Framework;

use Fig\Http\Message\StatusCodeInterface;
use Framework\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
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
    private RouterInterface $router;

    /**
     * @var array
     */
    private array $routes = [];

    /**
     * @var EmitterInterface
     */
    private EmitterInterface $emitter;

    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

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
        $this->router  = $router;
        $this->emitter = $emitter;
    }

    public function getEmitter(): EmitterInterface|SapiEmitter
    {
        if (!$this->emitter) {
            $this->emitter = new SapiEmitter();
        }
        return $this->emitter;
    }

    /**
     * Emitting responses
     *
     * @param ServerRequestInterface|null $request
     */
    public function run(ServerRequestInterface $request = null): void
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
    public function route(
        string $path,
        string $handler,
        string $method,
        string $name
    ): Router\Route {
        $route = new Router\Route($path, $handler, $method, $name);
        $this->router->add($route);
        return $route;
    }

    /**
     * Process
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface $response
     */
    public function process(ServerRequestInterface $request): ResponseInterface
    {
        $route = $this->router->match($request);

        if ($route) {
            if (!$route->handler instanceof RequestHandlerInterface) {
                throw new \RuntimeException();
            }
            return $route->handler->handle($request);
        }
        return new Response\JsonResponse([
            'error' => 404,
            'message' => 'Not Found'
        ], StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
