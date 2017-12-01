<?php

namespace Entity;

/**
 * @Entity
 * @Table(name="avaliacoes")
 */
class Avaliacao
{
    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Cliente", inversedBy="avaliacoes")
     * @JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    protected $cliente;

    /**
     * @ManyToOne(targetEntity="Usuario", inversedBy="avaliacoes")
     * @JoinColumn(name="tecnico_id", referencedColumnName="id")
     */
    protected $tecnico;

    /**
     * @OneToOne(targetEntity="OrdemDeServico", inversedBy="avaliacao")
     * @JoinColumn(name="ordem_de_servico_id", referencedColumnName="id")
     */
    protected $ordemDeServico;

    /** @Column(type="string", length=150, name="avaliacao") */
    protected $avaliacao;

    /** @Column(type="text", name="comentario") */
    protected $comentario;

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

    public function getOrdemDeServico() {
        return $this->ordemDeServico;
    }

    public function getAvaliacao() {
        return $this->avaliacao;
    }

    public function getComentario() {
        return $this->comentario;
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

    public function setOrdemDeServico( $os ) {
        $this->ordemDeServico = $os;
    }

    public function setAvaliacao( $avaliacao ) {
        $this->avaliacao = $avaliacao;
    }

    public function setComentario( $comentario ) {
        $this->comentario = $comentario;
    }
}
