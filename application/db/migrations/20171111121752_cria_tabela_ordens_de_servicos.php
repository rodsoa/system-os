<?php


use Phinx\Migration\AbstractMigration;

class CriaTabelaOrdensDeServicos extends AbstractMigration
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
        $table = $this->table('ordens_de_servicos');
        $table->addColumn('descricao', 'text')
            ->addColumn('defeito', 'string', ['limit' => 150, 'null' => true])
            ->addColumn('observacoes', 'text', ['null' => true])
            ->addColumn('laudo_tecnico', 'text', ['null' => true])
            ->addColumn('garantia', 'text', ['null' => true])
            ->addColumn('situacao', 'boolean', ['default' => true, 'null' => true])
            ->addColumn('status', 'string', ['limit' => 150, 'default' => 'Aguardando Atendimento'])
            ->addColumn('valor_servico', 'float', ['null' => true])
            ->addColumn('valor_total', 'float', ['null' => true])
            ->addColumn('tecnico_id', 'integer', ['null' => true])
            ->addColumn('cliente_id', 'integer', ['null' => true])
            ->addColumn('data_inicial', 'date', ['null' => true])
            ->addColumn('data_final', 'date', ['null' => true])
            ->addColumn('criado_em', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('atualizado_em', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('tecnico_id', 'usuarios', 'id')
            ->addForeignKey('cliente_id', 'clientes', 'id')
            ->create();
    }
}
