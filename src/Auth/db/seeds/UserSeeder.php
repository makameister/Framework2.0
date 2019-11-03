<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $this->table('users')
            ->insert([
                'firstname' => 'Franke',
                'lastname' => 'Guillaume',
                'email'    => 'admin@admin.fr',
                'password' => password_hash('admin', PASSWORD_DEFAULT)
            ])
            ->insert([
                'firstname' => 'Franke',
                'lastname' => 'Guillaume',
                'email'    => 'user@user.fr',
                'password' => password_hash('admin', PASSWORD_DEFAULT)
            ])
            ->save();
    }
}
