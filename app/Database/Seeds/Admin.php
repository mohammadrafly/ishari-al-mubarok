<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Admin extends Seeder
{
    public function run()
    {
        $data = [
            'nama'      => 'admin',
            'username'  => 'admin',
            'email'     => 'admin@admin',
            'password'  => password_hash('admin', PASSWORD_DEFAULT),
            'role'      => 'admin',
        ];
        $this->db->table('users')->insert($data);
    }
}
