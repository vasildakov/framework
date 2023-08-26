<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* home/index.html.twig */
class __TwigTemplate_365f0da9c5b8890c98ebc060de453a6e extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 3
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.html.twig", "home/index.html.twig", 3);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <h1>";
        echo twig_escape_filter($this->env, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 6, $this->source); })()), "html", null, true);
        echo "</h1>
    <p class=\"lead\">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
    <p class=\"lead\">
        <a href=\"#\" class=\"btn btn-lg btn-secondary fw-bold border-white bg-white\">Learn more</a>
    </p>
";
    }

    public function getTemplateName()
    {
        return "home/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 6,  46 => 5,  35 => 3,);
    }

    public function getSourceContext()
    {
        return new Source("{# templates/home/index.html.twig #}

{% extends \"layout.html.twig\" %}

{% block content %}
    <h1>{{ message }}</h1>
    <p class=\"lead\">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
    <p class=\"lead\">
        <a href=\"#\" class=\"btn btn-lg btn-secondary fw-bold border-white bg-white\">Learn more</a>
    </p>
{% endblock %}
", "home/index.html.twig", "/Users/vasildakov/Dev/php/framework/templates/home/index.html.twig");
    }
}
