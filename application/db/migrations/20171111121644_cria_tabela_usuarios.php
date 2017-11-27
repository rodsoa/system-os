<?php


use Phinx\Migration\AbstractMigration;

class CriaTabelaUsuarios extends AbstractMigration
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
        $table = $this->table('usuarios');
        $table->addColumn('cpf', 'string', ['limit' => 30])
            ->addColumn('nome', 'string', ['limit' => 150] )
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('senha', 'string', ['limit' => 255])
            ->addColumn('status', 'boolean')
            ->addColumn('criado_em', 'datetime')
            ->create();
    }
}
