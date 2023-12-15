<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Table\Column;

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
        $table->addColumn('username', 'string', array('limit' => 50, 'null' => false))
            ->addColumn('password', 'string', array('limit' => 255, 'null' => false))
            ->addColumn('profileurl', 'string', array('limit' => 2000))
            ->addColumn('email', 'string', array('limit' => 500))
            ->addIndex(array('username'), array('unique' => true))
            ->save();

        $roulette = $this->table('roulette', array('id' =>False));
        $roulette->addColumn('id', 'integer', array('null' => False, 'signed' => False))
            ->addColumn('geld', 'string', array('limit' => 50, 'null' => False))
            ->addForeignKey(['id'],
                            'user',
                            ['id'],
                            ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->save();

        $user = $this->table('userinfo', array('id' => false));
        $user->addColumn('id', 'integer', array('null' => false, 'signed' => false))
            ->addColumn('username', 'string', array('limit' => 50, 'null' => false))
            ->addColumn('name', 'string', array('limit' => 50, 'null' => true))
            ->addColumn('surname', 'string', array('limit' => 50, 'null' => true))
            ->addColumn('age', 'string', array('limit' => 100, 'null' =>true))
            ->addColumn('job', 'string', array('limit' => 50, 'null' => true))
            ->addColumn('profileurl', 'string', array('limit' => 2000))
            ->addForeignKey(['id'],
                            'user',
                            ['id'],
                            ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->save();
    }

    public function down()
    {

    }
}
