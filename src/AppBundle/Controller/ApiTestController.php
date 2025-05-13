<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiTestController extends Controller
{
    /**
     * @Route("/api/test", name="api_test")
     */
    public function testAction()
    {
        return new JsonResponse(['message' => 'JWT Protected API Works']);
    }
}
