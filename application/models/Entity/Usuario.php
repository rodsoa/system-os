<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="usuarios")
 */
class Usuario {

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id")
     */
    protected $id;

    /** @Column(type="string", length=30, unique=true, name="cpf") */
    protected $cpf;

    /** @Column(type="string", length=150 ,name="nome") */
    protected $nome;

    /** @Column(type="string", unique=true, name="email") */
    protected $email;

    /** @Column(type="string", name="senha") */
    protected $senha;

    /** @Column(type="boolean", name="status") */
    protected $status;

    /** @Column(type="datetime", name="criado_em") */
    protected $criado_em;

    /**
     * @OneToMany(targetEntity="OrdemDeServico", mappedBy="tecnico")
     */
    protected $ordensDeServicos;

    public function __construct() {
        $this->ordensDeServicos = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = md5($senha);
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getCriadoEm() {
        return $this->criado_em;
    }

    public function setCriadoEm($criado_em) {
        $this->criado_em = $criado_em;
    }

}