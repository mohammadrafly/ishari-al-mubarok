<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Models\Orders;
use App\Models\Gallery;

class Dashboard extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    //Profile
    public function profile($email) 
    {
        $model = new Users();
        if ($this->request->isAJAX() && $this->request->getMethod(true) === 'POST') {
            $img = $this->request->getFile('picture');
            $randName = $img->getRandomName();
            $checkpoint = $model->where('email', $email)->first();
            if ($img->isValid() && ! $img->hasMoved()) {
                $img->move('./uploads',$randName);
                $data = [
                    'nama' => $this->request->getPost('nama'),
                    'username' => $this->request->getPost('username'),
                    'alamat' => $this->request->getPost('alamat'),
                    'nomor_hp' => $this->request->getPost('nomor_hp'),
                    'picture' => $randName,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $this->db->table('users')->set($data)->where('id', $checkpoint['id'])->update();
                return $this->response->setJSON([
                    'status' => true,
                    'icon' => 'success',
                    'title' => 'Update Berhasil!',
                    'text' => 'Pop up ini akan hilang dalam 3 detik.',
                ]);
            } else {
                $data = [
                    'nama' => $this->request->getPost('nama'),
                    'username' => $this->request->getPost('username'),
                    'alamat' => $this->request->getPost('alamat'),
                    'nomor_hp' => $this->request->getPost('nomor_hp'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $this->db->table('users')->set($data)->where('id', $checkpoint['id'])->update();
                return $this->response->setJSON([
                    'status' => true,
                    'icon' => 'success',
                    'title' => 'Update tanpa foto berhasil!',
                    'text' => 'Pop up ini akan hilang dalam 3 detik.',
                ]);
            }
            
        } else {
            $data = [
                'content' => $model->where('email', $email)->first(),
            ];
            if (session()->get('role') == 'client') {
                return view('pages/homeProfile', $data);
            } else {
                return view('pages/dashboardProfile', $data);
            }
        }
    }
    
    //Dashboard
    private function hitungPersenPendapatan()
    {
        $db = \Config\Database::connect();
        $currentMonth = date('m');
        $lastMonth = date('m', strtotime('-1 month'));
        
        $currentMonthMoney = $db->table('orders')->selectSum('harga')->where('MONTH(created_at)', $currentMonth)->get()->getRow()->harga;
        $lastMonthMoney = $db->table('orders')->selectSum('harga')->where('MONTH(created_at)', $lastMonth)->get()->getRow()->harga;
        
        $difference = $currentMonthMoney - $lastMonthMoney;
        
        if ($lastMonthMoney != 0) {
            $percentageIncrease = ($difference / $lastMonthMoney) * 100;
        } else {
            $percentageIncrease = 0;
        }
    
        $formattedPercentageIncrease = number_format($percentageIncrease) . '%';

        return $formattedPercentageIncrease;
    }

    private function hitungPersenOrderan()
    {
        $db = \Config\Database::connect();
        $currentYear = date('y');
        $lastYear = date('y', strtotime('-1 year'));

        $currentYearData = $db->table('orders')->select('id')->where('YEAR(created_at)', $currentYear)->get()->getResultArray();
        $lastYearData = $db->table('orders')->select('id')->where('YEAR(created_at)', $lastYear)->get()->getResultArray();

        $currentYearSum = array_sum(array_column($currentYearData, 'id'));
        $lastYearSum = array_sum(array_column($lastYearData, 'id'));

        $difference = $currentYearSum - $lastYearSum;

        if ($lastYearSum != 0) {
            $percentageIncrease = ($difference / $lastYearSum) * 100;
        } else {
            $percentageIncrease = 0;
        }

        $formattedPercentageIncrease = number_format($percentageIncrease) . '%';

        return $formattedPercentageIncrease;
    }

    private function hitungPersenOrderByMonth()
    {
        $db = \Config\Database::connect();
        $currentMonth = date('m');
        $lastMonth = date('m', strtotime('-1 month'));

        $currentMonthData = $db->table('orders')->select('id')->where('MONTH(created_at)', $currentMonth)->get()->getResultArray();
        $lastMonthData = $db->table('orders')->select('id')->where('MONTH(created_at)', $lastMonth)->get()->getResultArray();

        $currentMonthSum = array_sum(array_column($currentMonthData, 'id'));
        $lastMonthSum = array_sum(array_column($lastMonthData, 'id'));

        $difference = $currentMonthSum - $lastMonthSum;

        if ($lastMonthSum != 0) {
            $percentageIncrease = ($difference / $lastMonthSum) * 100;
        } else {
            $percentageIncrease = 0;
        }

        $formattedPercentageIncrease = number_format($percentageIncrease) . '%';

        return $formattedPercentageIncrease;
    }
    
    private function hitungPersenNewUser()
    {
        $db = \Config\Database::connect();
        $currentMonth = date('m');
        $lastMonth = date('m', strtotime('-1 month'));

        $currentMonthData = $db->table('users')->select('id')->where('MONTH(created_at)', $currentMonth)->get()->getResultArray();
        $lastMonthData = $db->table('users')->select('id')->where('MONTH(created_at)', $lastMonth)->get()->getResultArray();

        $currentMonthSum = array_sum(array_column($currentMonthData, 'id'));
        $lastMonthSum = array_sum(array_column($lastMonthData, 'id'));

        $difference = $currentMonthSum - $lastMonthSum;

        if ($lastMonthSum != 0) {
            $percentageIncrease = ($difference / $lastMonthSum) * 100;
        } else {
            $percentageIncrease = 0;
        }

        $formattedPercentageIncrease = number_format($percentageIncrease) . '%';

        return $formattedPercentageIncrease;
    }

    private function hitungPersenNewClient()
    {
        $db = \Config\Database::connect();
        $currentMonth = date('m');
        $lastMonth = date('m', strtotime('-1 month'));

        $currentMonthData = $db->table('users')
                    ->where('MONTH(created_at)', $currentMonth)
                    ->where('role', 'client')
                    ->get()->getResultArray();
        $lastMonthData = $db->table('users')
                    ->where('MONTH(created_at)', $lastMonth)
                    ->where('role', 'client')
                    ->get()->getResultArray();

        $currentMonthSum = array_sum(array_column($currentMonthData, 'id'));
        $lastMonthSum = array_sum(array_column($lastMonthData, 'id'));

        $difference = $currentMonthSum - $lastMonthSum;

        if ($lastMonthSum != 0) {
            $percentageIncrease = ($difference / $lastMonthSum) * 100;
        } else {
            $percentageIncrease = 0;
        }

        $formattedPercentageIncrease = number_format($percentageIncrease) . '%';

        return $formattedPercentageIncrease;
    }

    public function index()
    {
        helper('number');
        $user = new Users();
        $order = new Orders();
        $month = date('m');
        $condition = array('role' => 'client');
        $resultPendapatan = $order->selectSum('harga')
            ->where('MONTH(created_at)', $month)
            ->get()
            ->getRow();
        $year = date('Y'); // get the current year
        $counts = [];
        
        for ($i = 1; $i <= 12; $i++) {
          $month = str_pad($i, 2, '0', STR_PAD_LEFT); // pad the month with a leading zero if necessary
          $start = "$year-$month-01 00:00:00"; // set the start of the month
          $end = date('Y-m-t 23:59:59', strtotime($start)); // set the end of the month
          $count = $order->where('created_at >=', $start)->where('created_at <=', $end)->countAllResults(); // count the number of results for the month
          $counts[$i] = $count;
        }
        $data = [
            'user' => $user->countAllResults(),
            'order' => $order->countAllResults(),
            'client' => $user->where($condition)->countAllResults(),
            'pendapatan' => $resultPendapatan->harga,
            'selisih_pendapatan' => $this->hitungPersenPendapatan(),
            'selisih_orderan' => $this->hitungPersenOrderan(),
            'selisih_order_by_month' => $this->hitungPersenOrderByMonth(),
            'selisih_new_user' => $this->hitungPersenNewUser(),
            'selisih_new_client' => $this->hitungPersenNewClient(),
            'chart' => json_encode($counts),
        ];
        //dd($data);
        return view('pages/dashboard', $data);
    }
    
    //User CRUD
    public function listUsers()
    {
        $model = new Users();
        $data = [
            'content' => $model->paginate(5, 'users'),
            'pager' => $model->pager,
        ];
        return view('pages/dashboardListUsers', $data);
    }

    public function deleteUsers($id)
    {
        $model = new Users();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'isConfirm' => true,
        ]);
    }

    public function addUsers()
    {
        if ($this->request->isAJAX()) {
            $model = new Users();
            $data = [
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role'),
            ];
            $model->save($data);
            return $this->response->setJSON([
                'status' => true,
                'icon' => 'success',
                'title' => 'Tambah User Berhasil!',
                'text' => 'Pop up ini akan hilang dalam 3 detik.',
            ]);
        }
    }

    public function updateUsers($id)
    {
        $model = new Users();
        if ($this->request->isAJAX() && $this->request->getMethod(true) === 'POST') {
            $id = $this->request->getPost('id');
            $data = [
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'role' => $this->request->getPost('role'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $model->update($id, $data);
            return $this->response->setJSON([
                'status' => true,
                'icon' => 'success',
                'title' => 'Update Berhasil!',
                'text' => 'Pop up ini akan hilang dalam 3 detik.',
            ]);
        } else {
            return $this->response->setJSON([
                'data' => $model->where('id', $id)->first(),
            ]);
        }
    }

    //Galleries CRUD
    public function listGalleries()
    {
        $model = new Gallery();
        $data = [
            'content' => $model->paginate(5, 'galleries'),
            'pager' => $model->pager,
        ];
        return view('pages/dashboardListGalleries', $data);
    }

    public function deleteGalleries($id)
    {
        $model = new Gallery();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'isConfirm' => true,
        ]);
    }

    public function addGalleries()
    {
        $model = new Gallery();
        $img    = $this->request->getFile('picture');
        $randName = $img->getRandomName();
        if ($img->isValid() && ! $img->hasMoved()) {
            $img->move('./uploads',$randName);
            $model->insert([
                'picture' => $randName,
            ]);
            return $this->response->setJSON([
                'status' => true,
                'icon' => 'success',
                'title' => 'Upload Berhasil!',
                'text' => 'Pop up ini akan hilang dalam 3 detik.',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Upload gagal!',
                'text' => 'Pop up ini akan hilang dalam 3 detik.',
            ]);
        }
    }

    //Orders CRUD
    public function listOrders()
    {
        helper('number');
        $model = new Orders();
        $content = $model->select('
                            users.*,
                            orders.*,
                            orders.id as id_order
                        ')
                         ->join('users', 'users.username = orders.username')
                         ->paginate(200, 'orders');
        $data = [
            'content' => $content,
            'pager' => $model->pager,
        ];
        //dd($data);
        return view('pages/dashboardListOrders', $data);
    }

    public function updateOrders($id)
    {
        helper('number');
        $model = new Orders();
        $user = new Users();
        if ($this->request->isAJAX() && $this->request->getMethod(true) === 'POST') {
            $id = $this->request->getPost('id');
            $data = [
                'status' => $this->request->getPost('status'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $order = $model->where('id', $id)->first(); 
            $user = $user->where('username', $order['username'])->first();
            if ($model->update($id, $data)) {
                $data['get'] = [
                    'username'  => $order['username'],
                    'nama'      => $user['nama'],
                    'nomor_hp'  => $user['nomor_hp'],
                    'alamat'    => $user['alamat'],
                    'email'     => $user['email'],
                    'harga'     => $order['harga'],
                    'status'    => $this->request->getPost('status'),
                    'update'    => $order['updated_at'],
                    'id'        => $order['id'],
                    'date'      => date('Y-m-d H:i:s')
                ];
                $to = $user['email'];
                $subject = 'Notifikasi Order';
                $message = view('email/dashboardNotifikasi.php', $data);
                    
                $email = \Config\Services::email();
            
                $email->setMailType('html');
                $email->setTo($to);
                $email->setFrom('isharialmubarok@gmail.com', 'ISHARI AL MUBAROK');
                $email->setSubject($subject);
                $email->setMessage($message);
                $email->setNewLine("\r\n");
            
                if ($email->send("X-Priority: 1 (Highest)\n")) {
                    return $this->response->setJSON([
                        'status' => true,
                        'icon' => 'success',
                        'title' => 'Update Berhasil!',
                        'text' => 'Pop up ini akan hilang dalam 3 detik.',
                    ]);
                } else {
                    $data = $email->printDebugger(['headers']);
                    return $this->response->setJSON([
                        'status' => false,
                        'icon' => 'error',
                        'title' => 'Permintaan Gagal!',
                        'text' => $data,
                    ]); 
                }
            }
        } else {
            return $this->response->setJSON([
                'data' => $model->join('users', 'users.username = orders.username')
                                ->where('orders.id', $id)
                                ->select('
                                    orders.*,
                                    users.nama as nama
                                ')
                                ->first(),
            ]);
        }
    }

    public function updateStatus()
    {
        $id = $this->request->getVar('id');
        $newStatus = 'pending';
        $newHarga = $this->request->getVar('harga');
    
        $data = [
            'status' => $newStatus,
            'harga' => $newHarga,
        ];
        $model = new Orders();
        $model->update($id,$data);
    
        $response = [
            'status' => true,
            'message' => 'Berhasil update'
        ];
    
        return $this->response->setJSON($response);
    }     
}
