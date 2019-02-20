<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRegistrationController
{
    public function index(Request $request)
    {
        try {
            $req = \App\Domain\Actions\RegisterUserRequest::fromRequest($request);
            $srv = new \App\Domain\Actions\RegisterUser();            
            $srv->execute($req);
        } catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
                
        $response = ['email' => $request->get('email'), 'name' => $request->get('name')];
        return new JsonResponse($response, Response::HTTP_CREATED);
    }
}