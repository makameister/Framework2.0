<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{

    public function change()
    {
        $this->table('users')
            ->addColumn('firstname', 'string')
            ->addColumn('lastname', 'string')
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }
}
