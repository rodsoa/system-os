<?php
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager;
class Doctrine
{
    public $em;
    public function __construct()
    {
        // Carrega e aplica as configurações de banco de dados
        require APPPATH . 'config/database.php';
        $connection_options = array(
            'driver'        => 'pdo_mysql',
            'user'          => $db['default']['username'],
            'password'      => $db['default']['password'],
            'host'          => $db['default']['hostname'],
            'dbname'        => $db['default']['database'],
            'charset'       => $db['default']['char_set'],
            'driverOptions' => array(
                'charset'   => $db['default']['char_set'],
            ),
        );
        // As linhas a seguir definem o namespace padrão para os models e os diretórios onde esses se encontram
        // Ao definir o namespace como 'Entity' você deverá criar os models (as entidades como o Doctrine denomina) dentro do diretório 'models/Entity'
        $models_namespace = 'Entity';
        $models_path = APPPATH . 'models';
        $proxies_dir = APPPATH . 'models/Proxies';
        $metadata_paths = array(APPPATH . 'models');
        // Aplica as configurações com base nas informações definidas acima
        // Se $dev_mode for definido como TRUE o cache é desativado
        $config = Setup::createAnnotationMetadataConfiguration($metadata_paths, $dev_mode = true, $proxies_dir);
        $this->em = EntityManager::create($connection_options, $config);
        $loader = new ClassLoader($models_namespace, $models_path);
        $loader->register();
    }
}