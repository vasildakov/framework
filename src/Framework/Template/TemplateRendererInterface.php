<?php

namespace Framework\Template;


/**
 * Interface TemplateRendererInterface
 *
 * @author Vasil Dakov <vasildakov@gmail.com>
 * @copyright 2009-2022 Neutrino.bg
 * @version 1.0
 */
interface TemplateRendererInterface
{
    public const TEMPLATE_ALL = '*';

    public function render(string $name, $params = []) : string;
}