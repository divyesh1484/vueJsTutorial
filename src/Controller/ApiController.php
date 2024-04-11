<?php

namespace App\Controller;

use App\Dto\RequestPayloadDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * 
 */
class ApiController extends AbstractController
{

	/**
	 * 
	 * @Route('/api/action', name: 'api_action', method: {"POST"})
	 */
	public function apiAction(Request $request)
	{
		// Deserialize the JSON payload into the DTO
        $name = $request->get('name');
        $email = $request->get('email');
        if ($name && $email) {
	        // Map the payload attributes to the DTO
	        $dto = new RequestPayloadDto();
	        $dto->setName($name ?? null);
	        $dto->setEmail($email ?? null);

	        return new JsonResponse(['message' => 'Request payload mapped successfully'], 200);
        }

        return $this->redirectToRoute("app_hello");

	}	
}