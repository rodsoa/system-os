<?php


use Phinx\Migration\AbstractMigration;

class CriaTabelaOrdensDeServicosProdutos extends AbstractMigration
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
        $table = $this->table('ordens_de_servicos_produtos');
        $table->addColumn('ordem_de_servico_id', 'integer')
              ->addColumn('produto_id', 'integer')
              ->addColumn('quantidade', 'integer')
              ->addForeignKey('ordem_de_servico_id', 'ordens_de_servicos', 'id')
              ->addForeignKey('produto_id', 'produtos', 'id')
              ->create();
    }
}
