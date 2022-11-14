<?php

namespace Christiancannata\PhpApi\Controllers;

use Christiancannata\PhpApi\Models\UserModel;
use Christiancannata\PhpApi\System\Request;
use Christiancannata\PhpApi\System\Response;

class UserController
{

    /*
     * Restituire tutte le risorse users
     */
    public function index(Request $request)
    {

        $loggedUser = $request->getLoggedUser();

        $userModel = new UserModel();
        $users = $userModel->findAll();

        $response = new Response();

        $response->renderJson($users, 200);

    }

    /*
     * Visualizzare una risorsa user
     */
    public function show(Request $request, $id)
    {

        $userModel = new UserModel();
        $user = $userModel->findById($id);

        $response = new Response();

        if (!$user) {
            $response->renderJson([], 404);
        }

        $response->renderJson($user, 200);

    }

    /*
     * Salvare una risorsa user
     */
    public function store(Request $request)
    {
        $params = $request->getBody();

        $errors = $request->validate([
            'email'
        ]);

        if (!empty($errors)) {
            $response = new Response();
            $response->renderJson([
                'errors' => $errors
            ], 400);
        }


        $userModel = new UserModel();
        $isInserted = $userModel->insert($params);

        // TUTTO OK RITORNO 201
        $response = new Response();
        if ($isInserted) {
            $response->renderJson([], 201);
        } else {
            // ERRORE RITORNO 400
            $response->renderJson([], 400);
        }

    }

    /*
     * Aggiornare una risorsa user
     */
    public function update(Request $request, $id)
    {
        $userModel = new UserModel();
        $user = $userModel->findById($id);

        $response = new Response();

        if (!$user) {
            $response->renderJson([], 404);
        }

        $params = $request->getBody();

        $isUpdated = $userModel->update($id, $params);

        // TUTTO OK RITORNO 204
        $response = new Response();
        if ($isUpdated) {
            $response->renderJson([], 204);
        } else {
            // ERRORE RITORNO 400
            $response->renderJson([], 400);
        }

    }

    /*
     * Cancellare una risorsa usera
     */
    public function delete(Request $request, $id)
    {
        $userModel = new UserModel();

        $user = $userModel->findById($id);

        $response = new Response();

        if (!$user) {
            $response->renderJson([], 404);
        }

        $isDeleted = $userModel->delete($id);

        // TUTTO OK RITORNO 204
        $response = new Response();
        if ($isDeleted) {
            $response->renderJson([], 204);
        } else {
            // ERRORE RITORNO 400
            $response->renderJson([], 400);
        }
    }


}