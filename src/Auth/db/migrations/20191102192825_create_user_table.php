<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{

    public function change()
    {
        $this->table('users')
            ->addColumn('username', 'string')
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addIndex(['email', 'username'], ['unique' => true])
            ->create();
    }
}
