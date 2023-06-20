<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class Token extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'token' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'type' => [
                'type' => 'ENUM("forgot_password")',
                'default' => 'forgot_password',
                'null' => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('email');
        $this->forge->addKey('token');
        $this->forge->createTable('tokens');
    }

    public function down()
    {
        $this->forge->dropTable('tokens');
    }
}
