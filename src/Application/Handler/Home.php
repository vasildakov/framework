<?php

declare(strict_types = 1);

namespace Application\Handler;

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

final class Home extends AbstractHandler
{
    public function __construct()
    {
        // TemplateInterface
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $loader = new \Twig\Loader\ArrayLoader([
            'index' => '<h3>{{ message }}</h3>',
        ]);
        $twig = new \Twig\Environment($loader);

        $html = $twig->render('index', ['message' => 'Hello Twig!']);

        return new HtmlResponse($html) ;
    }
}
