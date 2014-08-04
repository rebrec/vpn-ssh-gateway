<?php
namespace App\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;


class IndexController implements ControllerProviderInterface
{


    
    public function index(Application $app)
    {
       return $app["twig"]->render("index/index.twig");
    }


    public function info() 
    {
        return phpinfo();
    }

    public function connect(Application $app)
    {
        // créer un nouveau controller basé sur la route par défaut
        $index = $app['controllers_factory'];
        $index->match("/", 'App\Controller\IndexController::index')->bind("index.index");
        $index->match("/info", 'App\Controller\IndexController::info')->bind("index.info");

        $index->match("/usertest", "App\Controller\IndexController::usertest");
        

        return $index;
    }
    
    public function usertest(Application $app)
    {
        $sql = "SELECT * FROM users WHERE id = 1";
        $user = $app['db']->fetchAssoc($sql, array((int) $id));
        
        return  "<h1>{$user['name']}</h1>".
            "<p>{$post['id']}</p>";
    }



}


