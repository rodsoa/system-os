<?php 
namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\Produto;

/**
 * @Entity
 * @Table(name="ordens_de_servicos")
 */
class OrdemDeServico {

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Cliente", inversedBy="ordensDeServicos")
     * @JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    protected $cliente;

    /**
     * @ManyToOne(targetEntity="Usuario", inversedBy="ordensDeServicos")
     * @JoinColumn(name="tecnico_id", referencedColumnName="id")
     */
    protected $tecnico;

    /** 
     * @OneToMany(targetEntity="OrdemDeServicoProduto", mappedBy="ordemDeServico", cascade={"remove"})
     */
    protected $produtos;

    /**
     * @OneToOne(targetEntity="Avaliacao", mappedBy="ordemDeServico", cascade={"remove"})
     */
    protected $avaliacao;

    /** @Column(type="text", name="descricao") */
    protected $descricao;

    /** @Column(type="string", length=150, name="defeito") */
    protected $defeito;

    /** @Column(type="text", name="observacoes") */
    protected $observacoes;

    /** @Column(type="text", name="laudo_tecnico") */
    protected $laudoTecnico;

    /** @Column(type="text", name="garantia") */
    protected $garantia;

    /** @Column(type="boolean", name="situacao") */
    protected $situacao;

    /** @Column(type="string", length=15, name="status") */
    protected $status;

    /** @Column(type="float", name="valor_servico") */
    protected $valorServico;

    /** @Column(type="float", name="valor_total") */
    protected $valorTotal;

    /** @Column(type="date", name="data_inicial") */
    protected $dataInicial;

    /** @Column(type="date", name="data_final") */
    protected $dataFinal;

    /** @Column(type="datetime", name="criado_em") */
    protected $criadoEm;

    /** @Column(type="datetime", name="atualizado_em") */
    protected $atualizadoEm;

    public function __construct() {
        $this->produtos = new ArrayCollection();
    }

    /** GETTERS */

    public function getId() {
        return $this->id;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getTecnico() {
        return $this->tecnico;
    }

    public function getProdutos() {
        return $this->produtos;
    }

    public function getAvaliacao() {
        return $this->avaliacao;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getDefeito() {
        return $this->defeito;
    }

    public function getObservacoes() {
        return $this->observacoes;
    }

    public function getLaudoTecnico() {
        return $this->laudoTecnico;
    }

    public function getGarantia() {
        return $this->garantia;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getValorServico() {
        return $this->valorServico;
    }

    public function getValorPecas () {
        $valor = 0;
        foreach ( $this->getProdutos() as $item) {
            $valor += ($item->getProduto())->getPrecoVenda() * $item->getQuantidade();
        }

        return $valor;
    }

    public function getValorPecasFormatado () {
        return number_format($this->getValorPecas(), 2, ',', '.');
    }
    
    public function getValorTotal() {
        return number_format($this->getValorPecas() + $this->getValorServico(), 2, ',', '.'); 
    }

    public function getDataFinal() {
        return $this->dataFinal;
    }

    public function getDataInicial() {
        return $this->dataInicial;
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

    public function setCliente( $cliente ) {
        $this->cliente = $cliente;
    }

    public function setTecnico( $tecnico ) {
        $this->tecnico = $tecnico;
    }

    public function setDescricao( $descricao ) {
        $this->descricao = $descricao;
    }

    public function setDefeito( $defeito ) {
        $this->defeito = $defeito;
    }

    public function setObservacoes( $observacoes ) {
        $this->observacoes = $observacoes;
    }

    public function setLaudoTecnico( $laudo ) {
        $this->laudoTecnico = $laudo;
    }

    public function setGarantia( $garantia ) {
        $this->garantia = $garantia;
    }

    public function setSituacao( $situacao ) {
        $this->situacao = $situacao;
    }

    public function setStatus( $status ) {
        $this->status = $status;
    }

    public function setValorServico( $valor ) {
        $valor = $this->moeda( $valor );
        $this->valorServico = $valor;
    }

    public function setValorTotal( $valor ) {
        $this->valorTotal = $valor;
    }

    public function setDataFinal( $data ) {
        $this->dataFinal = $data;
    }

    public function setDataInicial( $data ) {
        $this->dataInicial = $data;
    }

    public function setCriadoEm( $data ) {
        $this->criadoEm = $data;
    }

    public function setAtualizadoEm( $data ) {
        $this->atualizadoEm = $data;
    }

    /** FUNÇÕES HELPERS */
    function moeda($get_valor) {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }
}

