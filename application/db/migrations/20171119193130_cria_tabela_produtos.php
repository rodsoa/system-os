<?php


use Phinx\Migration\AbstractMigration;

class CriaTabelaProdutos extends AbstractMigration
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
        $table = $this->table('produtos');
        $table->addColumn('nome', 'string', ['limit' => 150])
              ->addColumn('descricao', 'string')
              ->addColumn('unidade', 'string', ['limit' => 2])
              ->addColumn('preco_venda', 'float')
              ->addColumn('preco_compra', 'float')
              ->addColumn('estoque', 'integer')
              ->addColumn('estoque_minimo', 'integer')
              ->addColumn('fornecedor_id', 'integer')
              ->addForeignKey('fornecedor_id', 'fornecedores', 'id')
              ->addIndex(['nome'], ['unique' => true, 'name' => 'idx_unique_produtos_nome'])
              ->create();
    }
}
