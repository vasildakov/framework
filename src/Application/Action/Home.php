<?php

declare(strict_types = 1);

namespace Application\Action;

use Fig\Http\Message\StatusCodeInterface;
use Framework\Handler\AbstractHandler;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Home extends AbstractHandler
{
    public function __construct()
    {
    }

    /**
     * @param  RequestInterface   $request
     * @return ResponseInterface  $response
     */
    public function __invoke(RequestInterface $request) : ResponseInterface
    {

    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function handle(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler = null): ResponseInterface
    {
        $loader = new \Twig\Loader\ArrayLoader([
            'index' => '{{ message }}',
        ]);
        $twig = new \Twig\Environment($loader);

        $html = $twig->render('index', ['message' => 'Hello from Twig!']);

        return new HtmlResponse($html) ;
    }
}
