<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MyNewMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table= $this->table('user', array('id' =>True, 'primary_key' => array('id')));
        $table->addColumn('id', 'Biginteger')
            ->addColumn('username', 'string', array('limit' => 50))
            ->addColumn('password', 'string', array('limit' => 255))
            ->addColumn('profileurl', 'string', array('limit' => 255))
            ->addIndex(array('username'), array('unique' => true))
            ->update();

    }

    public function down()
    {

    }
}