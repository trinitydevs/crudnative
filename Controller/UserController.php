<?php
namespace Trinity\CrudNative\Controller;
use Trinity\CrudNative\Model\User;

class UserController {
    private $users = [];

    public function __construct() {
        $this->users = [
            1 => new User(1, 'Trinity', 19),
            2 => new User(2, 'Neo', 35),
        ];
    }

    public function getUsers() {
        $userList = [];
        foreach ($this->users as $user) {
            $userList[] = [
                'id' => $user->getId(),
                'nome' => $user->getNome(),
                'idade' => $user->getIdade()
            ];
        }
        return $userList;
    }

    public function getUserById($id) {
        if (isset($this->users[$id])) {
            $user = $this->users[$id];
            return [
                'id' => $user->getId(),
                'nome' => $user->getNome(),
                'idade' => $user->getIdade()
            ];
        }
        return null;
    }

    public function insertUsers($data) {
        $newId = count($this->users) + 1;
        $idadeAjustada = $data['idade'] + 5;
        $newUser = new User($newId, $data['nome'], $idadeAjustada);
        $this->users[$newId] = $newUser;
        return [
            'id' => $newUser->getId(),
            'nome' => $newUser->getNome(),
            'idade' => $newUser->getIdade()
        ];
    }

    public function updateUsers($id, $data) {
        if (isset($this->users[$id])) {
            $user = $this->users[$id];
            if (isset($data['nome'])) {
                $user->setNome($data['nome']);
            }
            if (isset($data['idade'])) {
                $user->setIdade($data['idade'] + 5);
            }
            return [
                'id' => $user->getId(),
                'nome' => $user->getNome(),
                'idade' => $user->getIdade()
            ];
        }
        return ['status' => false, 'message' => 'Usuario nao encontrado'];
    }

    public function deleteUsers($id) {
        if (isset($this->users[$id])) {
            $user = $this->users[$id];
            $user->setIdade($user->getIdade() - 5);
            unset($this->users[$id]);
            return ['status' => true, 'message' => 'Usuario deletado com sucesso', 'idade_ajustada' => $user->getIdade()];
        }
        return ['status' => false, 'message' => 'Usuario não encontrado'];
    }
}
