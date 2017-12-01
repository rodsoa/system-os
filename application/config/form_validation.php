<?php 

$config = [
    'usuarios' => [
        [
            'field'=>'nome',
            'label'=>'Nome',
            'rules'=>'required|trim|xss_clean|is_unique[usuarios.nome]'
        ],
        [
            'field'=>'cpf',
            'label'=>'CPF',
            'rules'=>'required|trim|xss_clean|is_unique[usuarios.cpf]'
        ],
        [
            'field'=>'email',
            'label'=>'Email',
            'rules'=>'required|trim|valid_email|xss_clean|is_unique[usuarios.email]'
        ],
        [
            'field'=>'senha',
            'label'=>'Senha',
            'rules'=>'required|trim|xss_clean'
        ],
        [
            'field'=>'confirme_senha',
            'label'=>'Confirme a senha',
            'rules'=>'required|trim|matches[senha]|xss_clean'
        ],
    ],

    'clientes' => [
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|unique[clientes.nome]',
        ],
        [
            'field' => 'documento',
            'label' => 'Documento',
            'rules' => 'required|unique[clientes.documento]',
        ],
        [
            'field' => 'telefone',
            'label' => 'Telefone',
            'rules' => 'required',
        ],
        [
            'field' => 'celular',
            'label' => 'Celular',
            'rules' => 'required',
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|email|unique[clientes.email]',
        ],
        [
            'field' => 'cep',
            'label' => 'Cep',
            'rules' => 'required',
        ],
        [
            'field' => 'bairro',
            'label' => 'Bairro',
            'rules' => 'required',
        ],
        [
            'field' => 'numero',
            'label' => 'Número',
            'rules' => 'required',
        ],
        [
            'field' => 'cidade',
            'label' => 'Cidade',
            'rules' => 'required',
        ],
        [
            'field' => 'estado',
            'label' => 'Estado',
            'rules' => 'required',
        ],
    ],

    'fornecedores' => [

    ],

    'produtos' => [

    ],

    'os_produtos' => [

    ],

    'os' => [

    ]
];