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

/* layout.html.twig */
class __TwigTemplate_8871d2e6b4da8373c2db65f1a049ef9e extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'content' => [$this, 'block_content'],
            'javascript' => [$this, 'block_javascript'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        echo "<!DOCTYPE html>
<html lang=\"en\" class=\"h-100\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <meta name=\"theme-color\" content=\"#7952b3\">
    <title>";
        // line 10
        $this->displayBlock('title', $context, $blocks);
        echo "</title>


    ";
        // line 13
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 17
        echo "</head>

<body class=\"d-flex h-100 text-center text-white bg-dark\">
    <div class=\"cover-container d-flex w-100 h-100 p-3 mx-auto flex-column\">
        <header class=\"mb-auto\">
            <div>
                <h3 class=\"float-md-start mb-0\">Nano</h3>
                <nav class=\"nav nav-masthead justify-content-center float-md-end\">
                    <a class=\"nav-link active\" aria-current=\"page\" href=\"#\">Home</a>
                    <a class=\"nav-link\" href=\"#\">Features</a>
                    <a class=\"nav-link\" href=\"#\">Contact</a>
                </nav>
            </div>
        </header>

        <main class=\"px-3\">

            ";
        // line 34
        $this->displayBlock('content', $context, $blocks);
        // line 36
        echo "        </main>

        <footer class=\"mt-auto text-white-50\">
            <p>Cover template for <a href=\"https://getbootstrap.com/\" class=\"text-white\">Bootstrap</a>, by <a href=\"https://twitter.com/mdo\" class=\"text-white\">@mdo</a>.</p>
        </footer>

        ";
        // line 42
        $this->displayBlock('javascript', $context, $blocks);
        // line 47
        echo "    </div>
</body>
</html>";
    }

    // line 10
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 10, $this->source); })()), "html", null, true);
        echo " ";
    }

    // line 13
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 14
        echo "        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65\" crossorigin=\"anonymous\">
        <link href=\"/css/style.css\" rel=\"stylesheet\">
    ";
    }

    // line 34
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        echo "            ";
    }

    // line 42
    public function block_javascript($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 43
        echo "        <script src=\"https://code.jquery.com/jquery-3.5.1.slim.min.js\" integrity=\"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj\" crossorigin=\"anonymous\"></script>
        <script src=\"https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js\" integrity=\"sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3\" crossorigin=\"anonymous\"></script>
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4\" crossorigin=\"anonymous\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  127 => 43,  123 => 42,  119 => 35,  115 => 34,  109 => 14,  105 => 13,  96 => 10,  90 => 47,  88 => 42,  80 => 36,  78 => 34,  59 => 17,  57 => 13,  51 => 10,  41 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# templates/layout.html.twig #}
<!DOCTYPE html>
<html lang=\"en\" class=\"h-100\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <meta name=\"theme-color\" content=\"#7952b3\">
    <title>{% block title %} {{ title }} {% endblock %}</title>


    {% block stylesheets %}
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65\" crossorigin=\"anonymous\">
        <link href=\"/css/style.css\" rel=\"stylesheet\">
    {% endblock %}
</head>

<body class=\"d-flex h-100 text-center text-white bg-dark\">
    <div class=\"cover-container d-flex w-100 h-100 p-3 mx-auto flex-column\">
        <header class=\"mb-auto\">
            <div>
                <h3 class=\"float-md-start mb-0\">Nano</h3>
                <nav class=\"nav nav-masthead justify-content-center float-md-end\">
                    <a class=\"nav-link active\" aria-current=\"page\" href=\"#\">Home</a>
                    <a class=\"nav-link\" href=\"#\">Features</a>
                    <a class=\"nav-link\" href=\"#\">Contact</a>
                </nav>
            </div>
        </header>

        <main class=\"px-3\">

            {% block content %}
            {% endblock %}
        </main>

        <footer class=\"mt-auto text-white-50\">
            <p>Cover template for <a href=\"https://getbootstrap.com/\" class=\"text-white\">Bootstrap</a>, by <a href=\"https://twitter.com/mdo\" class=\"text-white\">@mdo</a>.</p>
        </footer>

        {% block javascript %}
        <script src=\"https://code.jquery.com/jquery-3.5.1.slim.min.js\" integrity=\"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj\" crossorigin=\"anonymous\"></script>
        <script src=\"https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js\" integrity=\"sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3\" crossorigin=\"anonymous\"></script>
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4\" crossorigin=\"anonymous\"></script>
        {% endblock %}
    </div>
</body>
</html>", "layout.html.twig", "/Users/vasildakov/Dev/php/framework/templates/layout.html.twig");
    }
}
