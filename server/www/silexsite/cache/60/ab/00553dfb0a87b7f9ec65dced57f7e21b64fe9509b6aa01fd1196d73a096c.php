<?php

/* index/index.twig */
class __TwigTemplate_60ab00553dfb0a87b7f9ec65dced57f7e21b64fe9509b6aa01fd1196d73a096c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("index.index"), "html", null, true);
        echo "bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
      <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->
  </head>
  <body>
    <h1>Hello, world!</h1>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("index.index"), "html", null, true);
        echo "bootstrap/js/jquery-1.11.1.min.js\"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("index.index"), "html", null, true);
        echo "bootstrap/js/bootstrap.min.js\"></script>
  </body>
</html>";
    }

    public function getTemplateName()
    {
        return "index/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 25,  46 => 23,  30 => 10,  19 => 1,);
    }
}
