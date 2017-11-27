<?php

use Entity\Fornecedor;
use Entity\Produto;

class ProdutosController extends CI_Controller
{
    public function __construct() {
        parent::__construct();

        if ( !$this->session->usuario ) {
            redirect('/login');
        }
        $this->twig->addGlobal('session', $this->session);

        /**
         * TODO: VALIDAÇÃO NÃO IMPLEMENTADA
         */
    }

    public function index() {
        $produtos = $this->doctrine->em->getRepository(Produto::class)->findAll();
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/produtos/index', ['produtos' => $produtos]);
    }

    public function adicionar() {
        $fornecedores = $this->doctrine->em->getRepository(Fornecedor::class)->findAll();
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/produtos/adicionar', ['fornecedores' => $fornecedores]);
    }

    public function cadastrar() {
        $produto = new Produto();
        $fornecedor = $this->doctrine->em->getRepository(Fornecedor::class)->find( $this->input->post('fornecedor'));
        
        foreach( $this->input->post() as $campo => $valor ) { 

            //Adição de modelo relacionado
            if ( $campo == 'fornecedor' ) {
                $produto->setFornecedor( $fornecedor );
                continue;
            }

            /** ucfirst capitaliza a primeira letra da string fornecida */     
            $setter = 'set' . ucfirst($campo);
            $produto->$setter( $valor );
        } 
        
        // Persistindo e salvando dados no banco
        $this->doctrine->em->persist( $produto );
        $this->doctrine->em->flush();
        
        $this->session->set_flashdata('msg_sucesso', 'Produto cadastrado com sucesso');
        redirect('/produtos');
    }

    public function editar( $id ) {
        $fornecedores = $this->doctrine->em->getRepository(Fornecedor::class)->findAll();
        $produto = $this->doctrine->em->getRepository(Produto::class)->find( $id );
        $this->twig->display('app/produtos/editar', [
            'fornecedores' => $fornecedores,
            'produto' => $produto
        ]);
    }

    public function atualizar( $id ) {
        $produto = $this->doctrine->em->getRepository(Produto::class)->find( $id );
        $fornecedor = $this->doctrine->em->getRepository(Fornecedor::class)->find( $this->input->post('fornecedor'));
        
        foreach( $this->input->post() as $campo => $valor ) { 

            //Adição de modelo relacionado
            if ( $campo == 'fornecedor' ) {
                $produto->setFornecedor( $fornecedor );
                continue;
            }

            /** ucfirst capitaliza a primeira letra da string fornecida */     
            $setter = 'set' . ucfirst($campo);
            $produto->$setter( $valor );
        } 
        
        // Persistindo e salvando dados no banco
        $this->doctrine->em->persist( $produto );
        $this->doctrine->em->flush();
        
        $this->session->set_flashdata('msg_sucesso', 'Produto editado com sucesso');
        redirect('/produtos');
    }

    /**
     * DELETE /produtos/(:num)
     */
    public function deletar( $id ){
        $produto = $this->doctrine->em->getRepository(Produto::class)->find($id);
        
        if ( $produto ) {
            $this->doctrine->em->remove( $produto );
            $this->doctrine->em->flush();
        
            $this->session->set_flashdata('msg_sucesso', 'Produto deletado com sucesso');
            redirect('/produtos');
        } else {
            $this->session->set_flashdata('msg_erro', 'Produto inexistente na base de dados');
            redirect('/produtos');
        }
    }
}