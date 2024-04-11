<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * 
 */
class ParticipatesController extends AbstractController
{
	#[Route('/participants', name: 'app_participants')]
	public function participant(): Response
	{

		$participants = [
            ['name' => 'John Doe', 'email' => 'john@example.com'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com'],
            ['name' => 'Alice Johnson', 'email' => 'alice@example.com'],
        ];

        return $this->render('participants/participants.html.twig', 
        	[ 'participants' => $participants 
        ]);
	}
}