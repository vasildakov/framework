<?php

declare(strict_types = 1);

namespace Application\Handler;

use Framework\Handler\AbstractHandler;
use Framework\Template\TemplateRendererInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Home extends AbstractHandler
{
    public function __construct(
        readonly TemplateRendererInterface $renderer
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $html = $this->renderer->render(
            'home/index', [
                'title' => 'Framework Twig Template',
                'message' => 'Nano Framework'
            ]
        );

        return new HtmlResponse($html) ;
    }
}
