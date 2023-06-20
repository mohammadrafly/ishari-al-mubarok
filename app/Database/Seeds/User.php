<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            'nama'     => 'admin tes',
            'username' => 'admin',
            'email'    => 'admintes@gmail.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'role'     => 'admin',
            'nomor_hp' => '089897654322',
            'alamat'  => 'besuki',
        ];
        $this->db->table('users')->insert($data);
    }
}
