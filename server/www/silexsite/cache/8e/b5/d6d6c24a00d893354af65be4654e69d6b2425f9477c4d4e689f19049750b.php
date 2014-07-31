<?php

/* layout.twig */
class __TwigTemplate_8eb5d6d6c24a00d893354af65be4654e69d6b2425f9477c4d4e689f19049750b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>

<html lang=\"fr-FR\">
<head>
    <meta charset=\"UTF-8\">
    <title>SilexSkeleton</title>
    <link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("index.index"), "html", null, true);
        echo "bootstrap/css/bootstrap.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("index.index"), "html", null, true);
        echo "css/default.css\">

    <script type=\"text/javascript\" src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("index.index"), "html", null, true);
        echo "bootstrap/js/bootstrap.js\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("index.index"), "html", null, true);
        echo "bootstrap/js/jquery-1.11.1.min.js\"></script>


</head>
<body>
<header>
    <body data-spy=\"scroll\" data-target=\".navbar\">

    <div class=\"navbar navbar-inverse navbar-fixed-top\">
        <div class=\"navbar-inner\"><section id=\"I-F\" noNumber=\"1\">

            <div class=\"container\">
                <a class=\"brand\" href=\"#\">SilexSkeleton</a>

                <div class=\"nav-collapse collapse\">
                    <p class=\"navbar-text pull-right\">

                        <b>Nous sommes le ";
        // line 28
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d/m/Y"), "html", null, true);
        echo " </b>
                    </p>
                    <ul class=\"nav\" role=\"navigation\">
                        <li><a href=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("index.index"), "html", null, true);
        echo "\">Accueil</a></li>
                        <li><a href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("index.info"), "html", null, true);
        echo "\">Info</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>


</header>
<div id=\"content\">

    ";
        // line 44
        $this->displayBlock('content', $context, $blocks);
        // line 46
        echo "
</div>

<footer>

</footer>

</body>
</html>";
    }

    // line 44
    public function block_content($context, array $blocks = array())
    {
        echo "ls 
    ";
    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 44,  88 => 46,  86 => 44,  71 => 32,  67 => 31,  61 => 28,  41 => 11,  37 => 10,  32 => 8,  28 => 7,  20 => 1,);
    }
}
