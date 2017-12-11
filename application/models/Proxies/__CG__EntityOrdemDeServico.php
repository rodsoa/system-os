<?php

namespace DoctrineProxies\__CG__\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class OrdemDeServico extends \Entity\OrdemDeServico implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'id', 'cliente', 'tecnico', 'produtos', 'avaliacao', 'descricao', 'defeito', 'observacoes', 'laudoTecnico', 'garantia', 'situacao', 'status', 'valorServico', 'valorTotal', 'dataInicial', 'dataFinal', 'criadoEm', 'atualizadoEm'];
        }

        return ['__isInitialized__', 'id', 'cliente', 'tecnico', 'produtos', 'avaliacao', 'descricao', 'defeito', 'observacoes', 'laudoTecnico', 'garantia', 'situacao', 'status', 'valorServico', 'valorTotal', 'dataInicial', 'dataFinal', 'criadoEm', 'atualizadoEm'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (OrdemDeServico $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getCliente()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCliente', []);

        return parent::getCliente();
    }

    /**
     * {@inheritDoc}
     */
    public function getTecnico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTecnico', []);

        return parent::getTecnico();
    }

    /**
     * {@inheritDoc}
     */
    public function getProdutos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProdutos', []);

        return parent::getProdutos();
    }

    /**
     * {@inheritDoc}
     */
    public function getAvaliacao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAvaliacao', []);

        return parent::getAvaliacao();
    }

    /**
     * {@inheritDoc}
     */
    public function getDescricao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescricao', []);

        return parent::getDescricao();
    }

    /**
     * {@inheritDoc}
     */
    public function getDefeito()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDefeito', []);

        return parent::getDefeito();
    }

    /**
     * {@inheritDoc}
     */
    public function getObservacoes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getObservacoes', []);

        return parent::getObservacoes();
    }

    /**
     * {@inheritDoc}
     */
    public function getLaudoTecnico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLaudoTecnico', []);

        return parent::getLaudoTecnico();
    }

    /**
     * {@inheritDoc}
     */
    public function getGarantia()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGarantia', []);

        return parent::getGarantia();
    }

    /**
     * {@inheritDoc}
     */
    public function getSituacao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSituacao', []);

        return parent::getSituacao();
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', []);

        return parent::getStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function getValorServico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getValorServico', []);

        return parent::getValorServico();
    }

    /**
     * {@inheritDoc}
     */
    public function getValorPecas()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getValorPecas', []);

        return parent::getValorPecas();
    }

    /**
     * {@inheritDoc}
     */
    public function getValorPecasFormatado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getValorPecasFormatado', []);

        return parent::getValorPecasFormatado();
    }

    /**
     * {@inheritDoc}
     */
    public function getValorTotal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getValorTotal', []);

        return parent::getValorTotal();
    }

    /**
     * {@inheritDoc}
     */
    public function getDataFinal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDataFinal', []);

        return parent::getDataFinal();
    }

    /**
     * {@inheritDoc}
     */
    public function getDataInicial()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDataInicial', []);

        return parent::getDataInicial();
    }

    /**
     * {@inheritDoc}
     */
    public function getCriadoEm()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCriadoEm', []);

        return parent::getCriadoEm();
    }

    /**
     * {@inheritDoc}
     */
    public function getAtualizadoEm()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAtualizadoEm', []);

        return parent::getAtualizadoEm();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function setCliente($cliente)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCliente', [$cliente]);

        return parent::setCliente($cliente);
    }

    /**
     * {@inheritDoc}
     */
    public function setTecnico($tecnico)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTecnico', [$tecnico]);

        return parent::setTecnico($tecnico);
    }

    /**
     * {@inheritDoc}
     */
    public function setDescricao($descricao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescricao', [$descricao]);

        return parent::setDescricao($descricao);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefeito($defeito)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDefeito', [$defeito]);

        return parent::setDefeito($defeito);
    }

    /**
     * {@inheritDoc}
     */
    public function setObservacoes($observacoes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setObservacoes', [$observacoes]);

        return parent::setObservacoes($observacoes);
    }

    /**
     * {@inheritDoc}
     */
    public function setLaudoTecnico($laudo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLaudoTecnico', [$laudo]);

        return parent::setLaudoTecnico($laudo);
    }

    /**
     * {@inheritDoc}
     */
    public function setGarantia($garantia)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGarantia', [$garantia]);

        return parent::setGarantia($garantia);
    }

    /**
     * {@inheritDoc}
     */
    public function setSituacao($situacao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSituacao', [$situacao]);

        return parent::setSituacao($situacao);
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus($status)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', [$status]);

        return parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function setValorServico($valor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setValorServico', [$valor]);

        return parent::setValorServico($valor);
    }

    /**
     * {@inheritDoc}
     */
    public function setValorTotal($valor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setValorTotal', [$valor]);

        return parent::setValorTotal($valor);
    }

    /**
     * {@inheritDoc}
     */
    public function setDataFinal($data)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDataFinal', [$data]);

        return parent::setDataFinal($data);
    }

    /**
     * {@inheritDoc}
     */
    public function setDataInicial($data)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDataInicial', [$data]);

        return parent::setDataInicial($data);
    }

    /**
     * {@inheritDoc}
     */
    public function setCriadoEm($data)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCriadoEm', [$data]);

        return parent::setCriadoEm($data);
    }

    /**
     * {@inheritDoc}
     */
    public function setAtualizadoEm($data)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAtualizadoEm', [$data]);

        return parent::setAtualizadoEm($data);
    }

    /**
     * {@inheritDoc}
     */
    public function moeda($get_valor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'moeda', [$get_valor]);

        return parent::moeda($get_valor);
    }

}
