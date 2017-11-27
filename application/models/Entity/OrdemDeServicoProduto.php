<?php

namespace Entity;

/**
 * @Entity
 * @Table(name="ordens_de_servicos_produtos")
 */
class OrdemDeServicoProduto
{
    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="OrdemDeServico", inversedBy="produtos")
     * @JoinColumn(name="ordem_de_servico_id", referencedColumnName="id")
     */
    protected $ordemDeServico;

    /**
     * @ManyToOne(targetEntity="Produto", inversedBy="ordensDeServicos")
     * @JoinColumn(name="produto_id", referencedColumnName="id")
     */
    protected $produto;

    /** @Column(type="integer", name="quantidade") */
    protected $quantidade;

    public function getId() {
        return $this->id;
    }

    public function getOrdemDeServico() {
        return $this->ordemDeServico;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setId( $id ) {
        $this->id = $id;
    }

    public function setOrdemDeServico( $os ) {
        $this->ordemDeServico = $os;
    }

    public function setProduto( $produto ) {
        $this->produto = $produto;
    }

    public function setQuantidade( $qtd ) {
        $this->quantidade = $qtd;
    }


}