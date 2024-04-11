<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\EventDispatcher\EventDispatcher;
use App\Event\SomeEvent;


class HelloController extends AbstractController
{
    // function __construct(EventDispatcherInterface $dispatcher)
    // {
    //     $this->dispatcher = $dispatcher;
    // }

   #[Route('/home', name: 'app_hello')]
    public function index(): Response
    {
        $configValue = $this->getParameter('app.some_config_value');
        $env = $_SERVER['APP_ENV'];
        $databaseUrl = $_ENV['DATABASE_URL'];


        $event = new SomeEvent('some data');
        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->dispatch($event);


        return $this->render('hello/index.html.twig', [
            'message' => 'Hello, Symfony!',
            'db' => $configValue,
            'env' => $env,
            'databaseUrl' => $databaseUrl,
        ]);
    }
}
