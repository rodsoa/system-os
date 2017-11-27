<?php
use Doctrine\ORM\Query\ResultSetMapping;

use Entity\Produto;
use Entity\OrdemDeServico;
use Entity\OrdemDeServicoProduto;


class GerenciarProdutosController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ( !$this->session->usuario ) {
            redirect('/login');
        }
        $this->twig->addGlobal('session', $this->session);
    }

    public function index( $id ) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $id );
        $produtos = $os->getProdutos();
        $this->twig->display('app/ordens_de_servico/produtos/index',[
            'produtos' => $produtos, 
            'os' => $os,
        ]);
    }

    public function adicionar( $id ) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $id );
        $produtos = $this->doctrine->em->createQuery('select p from Entity\Produto p where p.estoque > 0')->getResult();
        $this->twig->display('app/ordens_de_servico/produtos/adicionar', [
            'os' => $os,
            'produtos' => $produtos
        ]);
    }

    public function cadastrar( $id ) {
        $os      = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $id );
        $produto = $this->doctrine->em->getRepository(Produto::class)->find( $this->input->post('produto') );
        $qtd     = $this->input->post('quantidade');

        /** Variável responsável por guardar valores na tabela relacionada a produtos e ordens de serviços */
        $osProduto = new OrdemDeServicoProduto();

        if ( $produto->getEstoque() >= $qtd ) {
            if ( $this->doctrine->em->getRepository(OrdemDeServicoProduto::class)->findOneBy(['ordemDeServico' => $os->getId(), 'produto'=> $produto->getId()]) )
            {
                $osProduto = $this->doctrine->em->getRepository(OrdemDeServicoProduto::class)->findOneBy(['ordemDeServico' => $os->getId(), 'produto'=> $produto->getId()]);
                $osProduto->setQuantidade( $osProduto->getQuantidade() + $qtd );
            } else {
                $osProduto->setOrdemDeServico( $os );
                $osProduto->setProduto( $produto );
                $osProduto->setQuantidade( $qtd );
            }

            /** Debitando valor retirado no estoque */
            $produto->setEstoque( $produto->getEstoque() - $qtd );

            /** Incrementando valor total da os */
            $os->setValorTotal( $os->getValorTotal() + ( $produto->getPrecoVenda() * $qtd ) );

            /** Persistindo mudanças no banco de dados */
            $this->doctrine->em->persist( $os );
            $this->doctrine->em->persist( $produto );
            $this->doctrine->em->persist( $osProduto);
            $this->doctrine->em->flush();

            $this->session->set_flashdata('msg_sucesso', 'Produtos adicionados com sucesso!');
            redirect("/ordens-de-servicos/$id/produtos");
        } else {
            $this->session->set_flashdata('msg_erro', 'Ocorreu algum erro. Tente novamente.');
            redirect("/ordens-de-servicos/$id/produtos");
        }
    }

    public function remover( $os, $osProduto ) {

    }

    public function deletar( $os, $osProduto ) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $os);
        $osProduto = $this->doctrine->em->getRepository(OrdemDeServicoProduto::class)->find( $osProduto );
        $produto = $this->doctrine->em->getRepository(Produto::class)->find( ($osProduto->getProduto())->getId() );

        /** Diminuindo valores dos produtos ao preço final da ordem de serviço */
        $os->setValorTotal(
            $os->getValorTotal() - ( $produto->getPrecoVenda() * $osProduto->getQuantidade() )
        );

        /** Incrementando quantidade de peças no estoque */
        $produto->setEstoque(
            $produto->getEstoque() + $osProduto->getQuantidade()
        );

        /** Removendo registro dos produtos adicionados */
        $this->doctrine->em->remove( $osProduto );
        $this->doctrine->em->persist( $produto );
        $this->doctrine->em->persist( $os );

        $this->doctrine->em->flush();

        $this->session->set_flashdata('msg_sucesso', 'Produtos removidos com sucesso!');
        redirect("/ordens-de-servicos/$os/produtos");
    }
}