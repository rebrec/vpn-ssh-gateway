<?php

//On initialise le timeZone
ini_set('date.timezone', 'Europe/Brussels');

//On ajoute l'autoloader
$loader = require_once __DIR__ . '/../vendor/autoload.php';

//dans l'autoloader nous ajoutons notre répertoire applicatif 
$loader->add("App",dirname(__DIR__));


//Nous instancions un objet Silex\Application
$app = new Silex\Application();
 
//en dev, nous voulons voir les erreurs
$app['debug'] = true;

//On indique où allez pour le chemin http://localhost/SilexSkeleton/public/
$app->mount("/", new App\Controller\IndexController());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    "twig.path" => dirname(__DIR__) . "/App/Views",
    'twig.options' => array('cache' => dirname(__DIR__).'/cache', 'strict_variables' => true)
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'dbname' => 'silex',
	'user' => 'silex',
	'password' => 'silex',
	'host' => '127.0.0.1',
	'driver' => 'pdo_mysql',
    ),
));


//On lance l'application
$app->run();
