<?php 
namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="clientes")
 */
class Cliente {

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id")
     */
    protected $id;

    /** @Column(type="string", length=150 ,name="nome") */
    protected $nome;

    /** @Column(type="boolean", name="status") */
    protected $status;

    /** @Column(type="string", length=20 ,name="documento") */
    protected $documento;

    /** @Column(type="string", length=30 ,name="telefone") */
    protected $telefone;

    /** @Column(type="string", length=30 ,name="celular") */
    protected $celular;

    /** @Column(type="string", length=150 ,name="email") */
    protected $email;

    /** @Column(type="string", name="senha") */
    protected $senha;

    /** @Column(type="string", length=10 ,name="cep") */
    protected $cep;

    /** @Column(type="string", length=150 ,name="endereco") */
    protected $endereco;

    /** @Column(type="string", length=60 ,name="bairro") */
    protected $bairro;

    /** @Column(type="string", length=60 ,name="cidade") */
    protected $cidade;

    /** @Column(type="string", length=2 ,name="estado") */
    protected $estado;

    /** @Column(type="string", length=5 ,name="numero") */
    protected $numero;

    /** @Column(type="string", length=60 ,name="complemento") */        
    protected $complemento;

    /** @Column(type="datetime" ,name="criado_em") */
    protected $criadoEm;

    /**
     * @OneToMany(targetEntity="OrdemDeServico", mappedBy="cliente")
     */
    protected $ordensDeServicos;

    public function __construct() {
        $this->ordensDeServicos = new ArrayCollection();
    }

    /** GETTERS */

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDocumento() {
        return $this->documento;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function getCriadoEm() {
        return $this->criadoEm;
    }

    /** SETTERS */

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = md5($senha);
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function setCriadoEm($criadoEm) {
        $this->criadoEm = $criadoEm;
    }

    /** VALIDACAO */
    public function validaCPF() {
        
    }
}