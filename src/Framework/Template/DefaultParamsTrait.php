<?php

namespace Framework\Template;

use Framework\Template\Exception\InvalidArgumentException;
use Framework\Template\TemplateRendererInterface;

trait DefaultParamsTrait
{
    /** @var array<string, array<string, mixed>> */
    private $defaultParams = [];

    /**
     * Add a default parameter to use with a template.
     *
     * Use this method to provide a default parameter to use when a template is
     * rendered. The parameter may be overridden by providing it when calling
     * `render()`, or by calling this method again with a null value.
     *
     * The parameter will be specific to the template name provided. To make
     * the parameter available to any template, pass the TEMPLATE_ALL constant
     * for the template name.
     *
     * If the default parameter existed previously, subsequent invocations with
     * the same template name and parameter name will overwrite.
     *
     * @param string $templateName Name of template to which the param applies;
     *     use TEMPLATE_ALL to apply to all templates.
     * @param string $param Param name.
     * @throws InvalidArgumentException
     */
    public function addDefaultParam(string $templateName, string $param, mixed $value): void
    {
        if (! $templateName) {
            throw new InvalidArgumentException('$templateName must be a non-empty string');
        }

        if (! $param) {
            throw new InvalidArgumentException('$param must be a non-empty string');
        }

        if (! isset($this->defaultParams[$templateName])) {
            $this->defaultParams[$templateName] = [];
        }

        $this->defaultParams[$templateName][$param] = $value;
    }

    /**
     * Returns merged global, template-specific and given params
     */
    private function mergeParams(string $template, array $params): array
    {
        $globalDefaults   = $this->defaultParams[TemplateRendererInterface::TEMPLATE_ALL] ?? [];
        $templateDefaults = $this->defaultParams[$template] ?? [];

        return array_replace_recursive($globalDefaults, $templateDefaults, $params);
    }
}