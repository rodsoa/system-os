<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'DashboardController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * ROTAS DA APLICAÇÃO
 */

$route['login']['GET']   = 'Autenticacao/LoginController/login';
$route['login']['POST']  = 'Autenticacao/LoginController/loginUsuario';
$route['logout']['POST'] = 'Autenticacao/LogoutController/logout';

/** USUARIOS */
$route['usuarios']['GET']                = 'Administracao/UsuariosController/index';

$route['usuarios/adicionar']['GET']      = 'Administracao/UsuariosController/adicionar';
$route['usuarios']['POST']               = 'Administracao/UsuariosController/cadastrar';

$route['usuarios/(:num)/editar']['GET']  = 'Administracao/UsuariosController/editar/$1';
$route['usuarios/(:num)']['POST']        = 'Administracao/UsuariosController/atualizar/$1';

$route['usuarios/(:num)']['GET']         = 'Administracao/UsuariosController/exibir/$1';

$route['usuarios/(:num)']['DELETE']      = 'Administracao/UsuariosController/deletar/$1';

/** CLIENTES */
$route['clientes']['GET']                = 'Administracao/ClientesController/index';

$route['clientes/adicionar']['GET']      = 'Administracao/ClientesController/adicionar';
$route['clientes']['POST']               = 'Administracao/ClientesController/cadastrar';

$route['clientes/(:num)/editar']['GET']  = 'Administracao/ClientesController/editar/$1';
$route['clientes/(:num)']['POST']        = 'Administracao/ClientesController/atualizar/$1';

$route['clientes/(:num)']['GET']         = 'Administracao/ClientesController/exibir/$1';

$route['clientes/(:num)']['DELETE']      = 'Administracao/ClientesController/deletar/$1';

/** ORDENS DE SERVICOS */
$route['ordens-de-servicos']['GET'] = 'Administracao/OrdensDeServicosController/index';

$route['ordens-de-servicos/adicionar']['GET'] = 'Administracao/OrdensDeServicosController/adicionar';
$route['ordens-de-servicos']['POST']          = 'Administracao/OrdensDeServicosController/cadastrar';

/** PRODUTOS ORDENS DE SERVICOS */
$route['ordens-de-servicos/(:num)/produtos']['GET']                   = 'Estoque/GerenciarProdutosController/index/$1';
$route['ordens-de-servicos/(:num)/produtos/adicionar']['GET']         = 'Estoque/GerenciarProdutosController/adicionar/$1';
$route['ordens-de-servicos/(:num)/produtos']['POST']                  = 'Estoque/GerenciarProdutosController/cadastrar/$1';
$route['ordens-de-servicos/(:num)/produtos/(:num)/remover']['DELETE'] = 'Estoque/GerenciarProdutosController/deletar/$1/$2';

$route['ordens-de-servicos/(:num)/editar']['GET']         = 'Administracao/OrdensDeServicosController/editar/$1';
$route['ordens-de-servicos/(:num)']['POST']               = 'Administracao/OrdensDeServicosController/atualizar/$1';

$route['ordens-de-servicos/(:num)']['GET']                = 'Administracao/OrdensDeServicosController/exibir/$1';

$route['ordens-de-servicos/(:num)']['DELETE']             = 'Administracao/OrdensDeServicosController/deletar/$1';

/** FORNECEDORES */
$route['fornecedores']['GET']                = 'Estoque/FornecedoresController/index';

$route['fornecedores/adicionar']['GET']      = 'Estoque/FornecedoresController/adicionar';
$route['fornecedores']['POST']               = 'Estoque/FornecedoresController/cadastrar';

$route['fornecedores/(:num)/editar']['GET']  = 'Estoque/FornecedoresController/editar/$1';
$route['fornecedores/(:num)']['POST']        = 'Estoque/FornecedoresController/atualizar/$1';

$route['fornecedores/(:num)']['GET']         = 'Estoque/FornecedoresController/exibir/$1';

$route['fornecedores/(:num)']['DELETE']      = 'Estoque/FornecedoresController/deletar/$1';

/** PRODUTOS */
$route['produtos']['GET']                = 'Estoque/ProdutosController/index';

$route['produtos/adicionar']['GET']      = 'Estoque/ProdutosController/adicionar';
$route['produtos']['POST']               = 'Estoque/ProdutosController/cadastrar';

$route['produtos/(:num)/editar']['GET']  = 'Estoque/ProdutosController/editar/$1';
$route['produtos/(:num)']['POST']        = 'Estoque/ProdutosController/atualizar/$1';

$route['produtos/(:num)']['GET']         = 'Estoque/ProdutosController/exibir/$1';

$route['produtos/(:num)']['DELETE']      = 'Estoque/ProdutosController/deletar/$1';

/** EMAILS */
$route['email']['GET']  = 'Administracao/EnviarEmailsController/criarEmail';
$route['email']['POST'] = 'Administracao/EnviarEmailsController/enviar';

/** RELATORIOS */
$route['relatorios']['GET']                = 'Administracao/RelatoriosController/index';
$route['relatorios']['POST']               = 'Administracao/RelatoriosController/gerarPdf';
$route['relatorios/:num/ordem-de-servico'] = 'Administracao/RelatoriosController/gerarPdfOs/$1';