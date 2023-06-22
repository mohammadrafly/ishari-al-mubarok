<?php

namespace App\Models;

use CodeIgniter\Model;

class Orders extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_pembayaran',
        'username',
        'tanggal_event',
        'waktu_event',
        'kategori_event',
        'harga',
        'lokasi_event',
        'detail_lokasi',
        'status',
        'no_hp',
        'jarak',
        'foto_pembayaran',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function getOrdersByUsername($username)
    {
        $query = $this->db->table('orders')
            ->select('
                orders.*,
                orders.id as id_order
            ')
            ->join('users', 'users.username = orders.username', 'left')
            ->where('orders.username', $username)
            ->get();
        return $query;
    }

    function checkpointDone($username)
    {
        $query = $this->db->table('orders')
            ->whereNotIn('status', ['done', 'ditolak'])
            ->where('username', $username)
            ->get();
            if(count($query->getResultArray())==1) {
                return $query->getRowArray();
            } else {
                return false;
            }
    }
}
