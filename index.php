<?php
namespace Trinity\CrudNative;
use Trinity\CrudNative\Controller\UserController;

require_once '../vendor/autoload.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$users = new UserController();
var_dump($method, $uri);

switch($method){
    case 'GET':
        if ($uri === '/users') {
            $resposta = $users->getUsers();
            if($resposta){
                http_response_code(200);
                echo json_encode(
                    ['status'=> true, 'message'=> 'Recebido com sucesso','Usuarios'=> $resposta]
                );
            } else {
                http_response_code(204);
                echo json_encode(
                    ['status'=> false, 'message'=> 'Nenhum usuario encontrado', 'Usuarios'=> []]
                );
            }
        } elseif (preg_match('/\/users\/(\d+)/', $uri, $match)) {
            $id = $match[1];
            $user = $users->getUserById($id);
            if($user){
                http_response_code(200);
                echo json_encode(
                    ['status'=> true, 'message'=> 'Usuario encontrado', 'Usuario'=> $user]
                );
            } else {
                http_response_code(404);
                echo json_encode(['status'=> false, 'message'=> 'Usuario nao encontrado']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['status'=> false, 'message'=> 'URI invalida']);
        }
        break;

    case 'POST':
        if ($uri === '/users') {
            $data = json_decode(file_get_contents('php://input'), true);
            if($data){
                $resposta = $users->insertUsers($data);
                http_response_code(201);
                echo json_encode(['status'=> true, 'message'=> 'Usuario criado com sucesso', 'dados'=> $resposta]);
            } else {
                http_response_code(400);
                echo json_encode(['status'=> false, 'message'=> 'Dados invalidos']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['status'=> false, 'message'=> 'URI invalida']);
        }
        break;

    case 'PUT':
        if (preg_match('/\/users\/(\d+)/', $uri, $match)) {
            $id = $match[1];
            $data = json_decode(file_get_contents('php://input'), true);
            if($data){
                $resposta = $users->updateUsers($id, $data);
                http_response_code(200);
                echo json_encode(['status'=> true, 'message'=> 'Usuario atualizado com sucesso', 'dados'=> $resposta]);
            } else {
                http_response_code(400);
                echo json_encode(['status'=> false, 'message'=> 'Dados invalidos']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['status'=> false, 'message'=> 'URI invalida']);
        }
        break;

    case 'DELETE':
        if (preg_match('/\/users\/(\d+)/', $uri, $match)) {
            $id = $match[1];
            $resposta = $users->deleteUsers($id);
            if($resposta['status']){
                http_response_code(200);
                echo json_encode(['status'=> true, 'message'=> $resposta['message'], 'idade_ajustada'=> $resposta['idade_ajustada']]);
            } else {
                http_response_code(404);
                echo json_encode(['status'=> false, 'message'=> $resposta['message']]);
            }
        } else {
            http_response_code(404);
            echo json_encode(['status'=> false, 'message'=> 'URI invalida']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['status'=> false, 'message'=> 'Metodo nao permitido']);
}
