<?php

namespace DoctrineProxies\__CG__\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Produto extends \Entity\Produto implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', 'id', 'nome', 'descricao', 'unidade', 'precoVenda', 'precoCompra', 'estoque', 'estoqueMinimo', 'fornecedor', 'ordensDeServicos'];
        }

        return ['__isInitialized__', 'id', 'nome', 'descricao', 'unidade', 'precoVenda', 'precoCompra', 'estoque', 'estoqueMinimo', 'fornecedor', 'ordensDeServicos'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Produto $proxy) {
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
    public function getNome()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNome', []);

        return parent::getNome();
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
    public function getUnidade()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUnidade', []);

        return parent::getUnidade();
    }

    /**
     * {@inheritDoc}
     */
    public function getPrecoVenda()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrecoVenda', []);

        return parent::getPrecoVenda();
    }

    /**
     * {@inheritDoc}
     */
    public function getPrecoVendaFormatado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrecoVendaFormatado', []);

        return parent::getPrecoVendaFormatado();
    }

    /**
     * {@inheritDoc}
     */
    public function getPrecoCompra()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrecoCompra', []);

        return parent::getPrecoCompra();
    }

    /**
     * {@inheritDoc}
     */
    public function getPrecoCompraFormatado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrecoCompraFormatado', []);

        return parent::getPrecoCompraFormatado();
    }

    /**
     * {@inheritDoc}
     */
    public function getEstoque()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEstoque', []);

        return parent::getEstoque();
    }

    /**
     * {@inheritDoc}
     */
    public function getEstoqueMinimo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEstoqueMinimo', []);

        return parent::getEstoqueMinimo();
    }

    /**
     * {@inheritDoc}
     */
    public function getFornecedor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFornecedor', []);

        return parent::getFornecedor();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrdensDeServicos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrdensDeServicos', []);

        return parent::getOrdensDeServicos();
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
    public function setNome($nome)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNome', [$nome]);

        return parent::setNome($nome);
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
    public function setUnidade($unidade)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUnidade', [$unidade]);

        return parent::setUnidade($unidade);
    }

    /**
     * {@inheritDoc}
     */
    public function setPrecoVenda($precoVenda)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrecoVenda', [$precoVenda]);

        return parent::setPrecoVenda($precoVenda);
    }

    /**
     * {@inheritDoc}
     */
    public function setPrecoCompra($precoCompra)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrecoCompra', [$precoCompra]);

        return parent::setPrecoCompra($precoCompra);
    }

    /**
     * {@inheritDoc}
     */
    public function setEstoque($estoque)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEstoque', [$estoque]);

        return parent::setEstoque($estoque);
    }

    /**
     * {@inheritDoc}
     */
    public function setEstoqueMinimo($estoqueMinimo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEstoqueMinimo', [$estoqueMinimo]);

        return parent::setEstoqueMinimo($estoqueMinimo);
    }

    /**
     * {@inheritDoc}
     */
    public function setFornecedor($fornecedor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFornecedor', [$fornecedor]);

        return parent::setFornecedor($fornecedor);
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
