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

        if ( $this->form_validation->run('fornecedores') == FALSE ) {

            $this->session->set_flashdata('msg_erro', 'Campos não passaram pela validação');
            $this->session->set_flashdata('erros', $this->form_validation->error_array());
            redirect('/fornecedores/adicionar');

        } else {

            $fornecedor = new Fornecedor();
            
            foreach( $this->input->post() as $campo => $valor ) { 
                /** ucfirst capitaliza a primeira letra da string fornecida */     
                $setter = 'set' . ucfirst($campo);
                $fornecedor->$setter( $valor );
            }
                  
            // Atribuindo valor para data de adição
            $fornecedor->setCriadoEm( new \DateTime('now'));
            $fornecedor->setAtualizadoEm( new \DateTime('now')); 
            
            if ( $this->validaCNPJ( $fornecedor->getCnpj() ) ) {
                // Persistindo e salvando dados no banco
                $this->doctrine->em->persist( $fornecedor );
                $this->doctrine->em->flush();
                
                $this->session->set_flashdata('msg_sucesso', 'Fornecedor cadastrado com sucesso');
                redirect('/fornecedores');
            } else {
                $this->session->set_flashdata('msg_erro', 'CNPJ inválido');
                redirect('/fornecedores/adicionar');
            }
        }
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

    private function validaCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        // Lista de CNPJs inválidos
        $invalidos = [
            '00000000000000',
            '11111111111111',
            '22222222222222',
            '33333333333333',
            '44444444444444',
            '55555555555555',
            '66666666666666',
            '77777777777777',
            '88888888888888',
            '99999999999999'
        ];

        // Verifica se o CNPJ está na lista de inválidos
        if (in_array($cnpj, $invalidos)) {	
            return false;
        }

        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }
}