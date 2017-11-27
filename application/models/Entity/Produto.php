<?

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="produtos")
 */
class Produto 
{
    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id")
     */
    protected $id;

    /** @Column(type="string", length=150, name="nome") */
    protected $nome;

    /** @Column(type="string", length=255, name="descricao") */
    protected $descricao;

    /** @Column(type="string", length=2, name="unidade") */
    protected $unidade;

    /** @Column(type="float", name="preco_venda") */
    protected $precoVenda;

    /** @Column(type="float", name="preco_compra") */
    protected $precoCompra;

    /** @Column(type="integer", name="estoque") */
    protected $estoque;

    /** @Column(type="integer", name="estoque_minimo") */
    protected $estoqueMinimo;
    
    /**
     * @ManyToOne(targetEntity="Fornecedor", inversedBy="produtos")
     * @JoinColumn(name="fornecedor_id", referencedColumnName="id")
     */
    protected $fornecedor;

    /** 
     * @OneToMany(targetEntity="OrdemDeServicoProduto", mappedBy="produto")
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

    public function getDescricao() {
        return $this->descricao;
    }

    public function getUnidade() {
        return $this->unidade;
    }

    public function getPrecoVenda() {
        return $this->precoVenda;
    }

    public function getPrecoCompra() {
        return $this->precoCompra;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function getEstoqueMinimo() {
        return $this->estoqueMinimo;
    }

    public function getFornecedor() {
        return $this->fornecedor;
    }

    public function getOrdensDeServicos() {
        return $this->ordensDeServicos;
    }

    /** SETTERS */
    public function setId( $id ) {
        $this->id = $id;
    }

    public function setNome( $nome ) {
        $this->nome = $nome;
    }

    public function setDescricao( $descricao) {
        $this->descricao = $descricao;
    }

    public function setUnidade( $unidade ) {
        $this->unidade = $unidade;
    }

    public function setPrecoVenda( $precoVenda) {
        $this->precoVenda = $precoVenda;
    }

    public function setPrecoCompra( $precoCompra ) {
        $this->precoCompra = $precoCompra;
    }

    public function setEstoque( $estoque ) {
        $this->estoque = $estoque;
    }

    public function setEstoqueMinimo( $estoqueMinimo ) {
        $this->estoqueMinimo = $estoqueMinimo;
    }

    public function setFornecedor( $fornecedor ) {
        $this->fornecedor = $fornecedor;
    }
}