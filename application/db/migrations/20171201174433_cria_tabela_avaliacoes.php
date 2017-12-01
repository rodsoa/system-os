<?php


use Phinx\Migration\AbstractMigration;

class CriaTabelaAvaliacoes extends AbstractMigration
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
        $table = $this->table('avaliacoes');
        $table->addColumn('ordem_de_servico_id', 'integer')
            ->addColumn('cliente_id', 'integer')
            ->addColumn('tecnico_id', 'integer')
            ->addColumn('avaliacao', 'string', ['default' => 'SEM AVALIAÇÃO','null' => true])
            ->addColumn('comentario', 'text', ['null' => true])
            ->addForeignKey('ordem_de_servico_id', 'ordens_de_servicos', 'id')
            ->addForeignKey('cliente_id', 'clientes', 'id')
            ->addForeignKey('tecnico_id', 'usuarios', 'id')
            ->create();
    }
}
