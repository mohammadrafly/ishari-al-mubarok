<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class Orders extends Migration
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
            'kode_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_event' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'waktu_event' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'kategori_event' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'harga' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'default' => '300000',
            ],
            'lokasi_event' => [
                'type' => 'TEXT',
                'constraint' => '255',
            ],
            'detail_lokasi' => [
                'type' => 'TEXT',
                'constraint' => '255',
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'foto_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type' => 'ENUM("pending","on_progres","done", "dalam_pemeriksaan")',
                'default' => 'pending',
                'null' => false,
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
        $this->forge->addKey('username');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
