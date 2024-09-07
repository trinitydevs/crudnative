<?php
namespace Trinity\CrudNative;
use Trinity\CrudNative\Controller\UserController;

require_once '../vendor/autoload.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

switch($method){
    case 'GET':
        switch($uri){
            case '/users':
                $users = new UserController();
                $resposta = $users->getUsers();
                if($resposta){
                    http_response_code(200);
                    echo json_encode(
                        ['status'=> true, 'message'=> 'Recebido com sucesso','Usuarios'=> $resposta]
                    );
                }else{
                    http_response_code(204);
                    echo json_encode(
                        ['status'=> false, 'message'=> 'Recebido com sucesso','Usuarios'=> []]
                    );
                }
                
                break;
            case '/produtos':
                http_response_code(200);
                echo json_encode(['status'=> true, 'message'=> 'Recebido com sucesso', 'uri'=> $uri]);
                break;
            default:
                echo json_encode(["URI invalido"]);
        }
    break;
    case 'POST': 
        switch($uri){
            case '/users':
                $data = json_decode(file_get_contents('php://input'), true);
                
                $users = new UserController();
                $resposta = $users->insertUsers($data);
                http_response_code(200);
                echo json_encode(['status'=> true, 'message'=> 'Recebido com sucesso','dados'=> $data]);
                break;
            case '/produtos':
                $data = json_decode(file_get_contents('php://input'), true);
                http_response_code(200);
                echo json_encode(['status'=> true, 'message'=> 'Recebido com sucesso', 'dados'=> $data]);
                break;
            default:
                echo json_encode(["URI invalido"]);
        }
    break;
    case 'PUT': 
        case '/produtos':
            if(preg_match('/\/users\/(\d+)/', $uri, $match)){
                $id = $match[1];
                $data = json_decode(file_get_contents('php://input'), true);
                http_response_code(200);
                echo json_encode(['status'=> true, 'message'=> 'Recebido com sucesso', 'id'=> $id]);
                break;
            }
    break;
    case 'DELETE':
        case '/produtos':
            if(preg_match('/\/users\/(\d+)/', $uri, $match)){
                var_dump($match);exit;
                $id = $match[1];
                $data = json_decode(file_get_contents('php://input'), true);
                http_response_code(200);
                echo json_encode(['status'=> true, 'message'=> 'Recebido com sucesso', 'id'=> $id]);
                break;
            }
    break;
    default:
    echo json_encode(["Método invalido"]);
}
