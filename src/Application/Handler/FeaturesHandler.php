<?php

namespace Application\Handler;

use Framework\Handler\AbstractHandler;
use Framework\Template\TemplateRendererInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FeaturesHandler extends AbstractHandler
{
    public function __construct(
        readonly TemplateRendererInterface $renderer
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $html = $this->renderer->render(
            'features/index', [
                'route' => $request->getUri()->getPath(),
                'title' => 'Framework Twig Template',
                'heading' => 'Features'
            ]
        );

        return new HtmlResponse($html) ;
    }
}