<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;

class HelloController_email_backup extends AbstractController
{
   #[Route('/home', name: 'app_hello')]
    public function index(): Response
    {
        $configValue = $this->getParameter('app.some_config_value');
        $env = $_SERVER['APP_ENV'];
        $databaseUrl = $_ENV['DATABASE_URL'];

        $email = (new Email())
            ->from('hello@example.com')
            ->to(' divyesh.solanki@icreativetechnolabs.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');
        
        $dns =  'smtp://divyesh.solanki.814@gmail.com:51199897363@divyesh@smtp.gmail.com:587';

        $transport = Transport::fromDsn($dns);

        $mailer = new Mailer($transport);
        
        $mailer->send($email);
        
        return $this->render('hello/index.html.twig', [
            'message' => 'Hello, Symfony!',
            'db' => $configValue,
            'env' => $env,
            'databaseUrl' => $databaseUrl,
        ]);
    }
}
