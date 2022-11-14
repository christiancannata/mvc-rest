<?php

namespace Christiancannata\PhpApi\Controllers;

use Christiancannata\PhpApi\Models\UserModel;
use Christiancannata\PhpApi\System\Request;
use Christiancannata\PhpApi\System\Response;
use Firebase\JWT\JWT;

class LoginController
{

    public function doLogin(Request $request)
    {

        $body = $request->getBody();

        $userModel = new UserModel();
        $user = $userModel->getLoggedUser($body['email'], $body['password']);

        if (!$user) {
            $response = new Response();
            $response->renderJson([], 401);
        }

        $key = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../config/private_key.key');

        $payload = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role_id']
        ];


        $jwt = JWT::encode($payload, $key, 'HS256');

        $response = new Response();
        $response->renderJson([
            'type' => 'Bearer',
            'token' => $jwt
        ], 200);

    }


}