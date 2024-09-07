<?php
namespace Trinity\CrudNative\Model;

class User {
    private int $id;
    private string $nome;
    private int $idade;

    public function __construct($id = 0, $nome = '', $idade = 0) {
        $this->id = $id;
        $this->nome = $nome;
        $this->idade = $idade;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function setIdade($idade) {
        $this->idade = $idade;
    }
}
