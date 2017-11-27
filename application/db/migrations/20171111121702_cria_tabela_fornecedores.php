<?php


use Phinx\Migration\AbstractMigration;

class CriaTabelaFornecedores extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('fornecedores');
        $table->addColumn('nome', 'string', ['limit' => 150])
            ->addColumn('cnpj', 'string', ['limit' => 20])
            ->addColumn('telefone', 'string', ['limit' => 30, 'null' => true])
            ->addColumn('celular', 'string', ['limit' => 30, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 150])
            ->addColumn('cep', 'string', ['limit' => 10, 'null' => true])
            ->addColumn('endereco', 'string', ['limit' => 150, 'null' => true])
            ->addColumn('bairro', 'string', ['limit' => 60, 'null' => true])
            ->addColumn('cidade', 'string', ['limit' => 60, 'null' => true])
            ->addColumn('estado', 'string', ['limit' => 2, 'null' => true])
            ->addColumn('numero', 'string', ['limit' => 5, 'null' => true])
            ->addColumn('criado_em', 'datetime')
            ->addColumn('atualizado_em', 'datetime')
            ->addIndex(['email'], ['unique' => true, 'name' => 'idx_unique_fornecedores_email'])
            ->addIndex(['cnpj'], ['unique' => true, 'name' => 'idx_unique_fornecedores_cnpj'])
            ->addIndex(['nome'], ['unique' => true, 'name' => 'idx_unique_fornecedores_nome'])
            ->create();
    }
}
