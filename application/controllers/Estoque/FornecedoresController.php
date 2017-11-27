<?php

use Entity\Fornecedor;

class FornecedoresController extends CI_Controller
{

    public function __construct() {
        parent::__construct();

        if ( !$this->session->usuario ) {
            redirect('/login');
        }
        $this->twig->addGlobal('session', $this->session);

        /** TODO: VALIDACÃO DOS DADOS! */
    }

    /**
     * GET /fornecedores
     */
    public function index() {
        $fornecedores = $this->doctrine->em->getRepository(Fornecedor::class)->findAll();
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/fornecedores/index',['fornecedores' => $fornecedores]);
    }

    /**
     * GET /fornecedores/adicionar
     */
    public function adicionar() {
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/fornecedores/adicionar');
    }

    /**
     * POST /fornecedores
     */
    public function cadastrar() {
        $fornecedor = new Fornecedor();
        
        foreach( $this->input->post() as $campo => $valor ) { 
            /** ucfirst capitaliza a primeira letra da string fornecida */     
            $setter = 'set' . ucfirst($campo);
            $fornecedor->$setter( $valor );
        }
              
        // Atribuindo valor para data de adição
        $fornecedor->setCriadoEm( new \DateTime('now'));
        $fornecedor->setAtualizadoEm( new \DateTime('now')); 
        
        // Persistindo e salvando dados no banco
        $this->doctrine->em->persist( $fornecedor );
        $this->doctrine->em->flush();
        
        $this->session->set_flashdata('msg_sucesso', 'Fornecedor cadastrado com sucesso');
        redirect('/fornecedores');
    }

    public function editar($id) {
        $fornecedor = $this->doctrine->em->getRepository(Fornecedor::class)->find($id);

        if ( $fornecedor ) {
            $this->twig->display('app/fornecedores/editar', ['fornecedor' => $fornecedor]);
        } else {
            $this->session->set_flashdata('msg_erro', 'Fornecedor inexistente na base de dados');
            redirect('/fornecedores');
        }
    }

    public function atualizar($id) {
        $fornecedor = $this->doctrine->em->getRepository(Fornecedor::class)->find($id);

        if ( $fornecedor ) {
            foreach( $this->input->post() as $campo => $valor ) { 
                /** ucfirst capitaliza a primeira letra da string fornecida */     
                $setter = 'set' . ucfirst($campo);
                $fornecedor->$setter( $valor );
            }
                  
            // Atribuindo valor para data de edição
            $fornecedor->setAtualizadoEm( new \DateTime('now')); 
            
            // Persistindo e salvando dados no banco
            $this->doctrine->em->persist( $fornecedor );
            $this->doctrine->em->flush();
            
            $this->session->set_flashdata('msg_sucesso', 'Fornecedor editado com sucesso');
            redirect('/fornecedores');
        } else {
            $this->session->set_flashdata('msg_erro', 'Fornecedor inexistente na base de dados');
            redirect('/fornecedores');
        }
    }

    /**
     * DELETE /fornecedores/(:num)
     */
    public function deletar( $id ){
        $fornecedor = $this->doctrine->em->getRepository(Fornecedor::class)->find($id);
        
        if ( $fornecedor ) {
            $this->doctrine->em->remove( $fornecedor );
            $this->doctrine->em->flush();
        
            $this->session->set_flashdata('msg_sucesso', 'Fornecedor deletado com sucesso');
            redirect('/fornecedores');
        } else {
            $this->session->set_flashdata('msg_erro', 'Fornecedor inexistente na base de dados');
            redirect('/fornecedores');
        }
    }
}