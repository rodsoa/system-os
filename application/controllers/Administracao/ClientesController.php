<?php

/** Importando classe referente ao modelo de cliente */
use Entity\Cliente;

class ClientesController extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ( !$this->session->usuario ) {
            redirect('/login');
        }

        $this->twig->addGlobal('session', $this->session);

        /** TODO: VALIDACÃO DOS DADOS! */
    }

    /** GET /clientes */
    public function index() {
        $clientes = $this->doctrine->em->getRepository('Entity\Cliente')->findAll();
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/clientes/index', ['clientes' => $clientes]);
    }

    /** GET /clientes/adicionar */
    public function adicionar() {
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/clientes/adicionar');
    }

    /** POST /clientes */
    public function cadastrar() {

        /** Executando validações dos campos */
        if ( $this->form_validation->run('clientes') == FALSE ) {

            $this->session->set_flashdata('msg_erro', 'Campos não passaram pela validação');
            $this->session->set_flashdata('erros', $this->form_validation->error_array());
            redirect('/clientes/adicionar');

        } else {

            $cliente = new \Entity\Cliente();
            
            foreach( $this->input->post() as $campo => $valor ) {
                if ( $campo === 'tipo' ) continue;
    
                $setter = 'set' . ucfirst($campo);
                $cliente->$setter( $valor );
            }
            
            // Atribuindo valor para data de adição
            $cliente->setCriadoEm( new \DateTime('now'));
            
            // Persistindo e salvando dados no banco
            $this->doctrine->em->persist( $cliente );
            $this->doctrine->em->flush();
            
            $this->session->set_flashdata('msg_sucesso', 'Cliente cadastrado com sucesso');
            redirect('/clientes');
        }
    }

    /** GET /clientes/(:num)/editar */
    public function editar($id) {
        $cliente = $this->doctrine->em->getRepository('Entity\Cliente')->find($id);

        if ($cliente) {
            $this->twig->display('app/clientes/editar', ['cliente' => $cliente]);
        } else {
            $this->session->set_flashdata('msg_erro', 'Cliente não cadastrado na base de dados');
            redirect('/clientes');
        }
    }

    /** POST|PUT /clientes/(:num) */
    public function atualizar($id) {
        $cliente = $this->doctrine->em->getRepository('Entity\Cliente')->find($id);

        foreach( $this->input->post() as $campo => $valor ) {
            if ( $campo === 'tipo' ) continue;
            if ( $campo === 'senha' && $valor === "" ) continue;

            $setter = 'set' . ucfirst($campo);
            $cliente->$setter( $valor );
        }

        // Persistindo e salvando dados no banco
        $this->doctrine->em->persist( $cliente );
        $this->doctrine->em->flush();

        $this->session->set_flashdata('msg_sucesso', 'Cliente editado com sucesso');
        redirect('/clientes');

    }

    /** DELETE /clientes/(:num) */
    public function deletar($id){
        $cliente = $this->doctrine->em->getRepository('Entity\Cliente')->find($id);

        if ( $cliente ) {
            $this->doctrine->em->remove( $cliente );
            $this->doctrine->em->flush();

            $this->session->set_flashdata('msg_sucesso', 'Cliente deletado com sucesso');
            redirect('/clientes');
        } else {
            $this->session->set_flashdata('msg_erro', 'Cliente inexistente na base de dados');
            redirect('/clientes');
        }
    }
}