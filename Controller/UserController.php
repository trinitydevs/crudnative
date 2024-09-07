<?php
namespace Trinity\CrudNative\Controller;
use Trinity\CrudNative\Model\User;

class UserController{

    public function getUsers(){
        return [
                ['nome'=> 'eux', 'idade'=> 15],
                ['nome'=> 'tu', 'idade'=> 16],
            ];
    }
    public function insertUsers($data){
        $user = new User();
        $idade = $data['idade'];
        $idade += 5;
        $user->setNome($data['nome']);
        $user->setIdade($idade);
        return ['nome'=> $user->getNome(), 'idade'=> $user->getIdade()];
        //+5 a idade
    }
    public function updateUsers($id){
        //+5 a idade
    }
    public function deleteUsers($id){
        //-5 a idade
    }
}