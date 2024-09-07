<?php
namespace Trinity\CrudNative\Model;

class User{
    private int $id;
    private string $nome;
    private int $idade;

    public function __construct($id = 0) {
        $this->id = $id;
    }

    public function getId(){
        $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getNome(){
        $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getIdade(){
        $this->idade;
    }
    public function setIdade($idade){
        $this->idade = $idade;
    }
}