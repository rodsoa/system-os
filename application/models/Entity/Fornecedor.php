<?php 
namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="fornecedores")
 */
class Fornecedor {

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id")
     */
    protected $id;

    /** @Column(type="string", length=150, unique=TRUE, name="nome") */
    protected $nome;

    /** @Column(type="string", length=20, unique=TRUE, name="cnpj") */
    protected $cnpj;

    /** @Column(type="string", length=30 ,name="telefone") */
    protected $telefone;

    /** @Column(type="string", length=30 ,name="celular") */
    protected $celular;

    /** @Column(type="string", length=150 ,unique=TRUE, name="email") */
    protected $email;

    /** @Column(type="string", length=150 ,name="endereco") */
    protected $endereco;

    /** @Column(type="string", length=5 ,name="numero") */
    protected $numero;

    /** @Column(type="string", length=60 ,name="bairro") */
    protected $bairro;

    /** @Column(type="string", length=10 ,name="cep") */
    protected $cep;

    /** @Column(type="string", length=60 ,name="cidade") */
    protected $cidade;

    /** @Column(type="string", length=2 ,name="estado") */
    protected $estado;

    /** @Column(type="datetime" ,name="criado_em") */
    protected $criadoEm;

    /** @Column(type="datetime", name="atualizado_em") */
    protected $atualizadoEm;

    /**
     * @OneToMany(targetEntity="Produto", mappedBy="fornecedor")
     */
    protected $produtos;

    public function __construct() {
        $this->produtos = new ArrayCollection();
    }

    /** GETTERS */
    public function getId() {
        return $this->id;
    }

    public function getProdutos() {
        return $this->produtos;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCnpj() {
        return $this->cnpj;
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

    public function getEndereco() {
        return $this->endereco;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCriadoEm() {
        return $this->criadoEm;
    }

    public function getAtualizadoEm() {
        return $this->atualizadoEm;
    }

    /** SETTERS */
    public function setId( $id ) {
        $this->id = $id;
    }

    public function setNome( $nome ) {
        $this->nome = $nome;
    }

    public function setCnpj( $cnpj ) {
        $this->cnpj = $cnpj;
    }

    public function setTelefone( $telefone ) {
        $this->telefone = $telefone;
    }

    public function setCelular( $celular ) {
        $this->celular = $celular;
    }

    public function setEmail( $email ) {
        $this->email = $email;
    }

    public function setEndereco( $endereco ) {
        $this->endereco = $endereco;
    }

    public function setNumero( $numero ) {
        $this->numero = $numero;
    }

    public function setbairro( $bairro ) {
        $this->bairro = $bairro;
    }

    public function setCep( $cep ) {
        $this->cep = $cep;
    }

    public function setCidade( $cidade ) {
        $this->cidade = $cidade;
    }

    public function setEstado( $estado ) {
        $this->estado = $estado;
    }

    public function setCriadoEm( $data ) {
        $this->criadoEm = $data;
    }

    public function setAtualizadoEm( $data ) {
        $this->atualizadoEm = $data;
    }
}