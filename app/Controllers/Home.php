<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Orders;
use App\Models\Users;
use App\Models\Gallery;

class Home extends BaseController
{
    public function index()
    {
        $model = new Gallery();
        $pengurus = new Users();
        $role = 'pengurus';
        $data = [
            'content' => $model->findAll(),
            'pengurus' => $pengurus->getUserByRole($role)->getResult(),
        ];
        return view('pages/home', $data);
    }

    public function generateCode($panjang)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        
        $length = $panjang; // Panjang string yang diinginkan

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function MyOrders($email)
    {
        helper('number');
        $model = new Orders();
        $modelUser = new Users();
    
        if ($this->request->isAJAX() && $this->request->getMethod(true) === 'POST') {
            $date = $this->request->getPost('tanggal_event');
            $time = $this->request->getVar('waktu_event');
            $latitude = $this->request->getPost('latitude');
            $longitude = $this->request->getPost('longitude');
            $interval = 60; // Interval in minutes
    
            // Convert time to minutes for easier comparison
            $selectedTime = intval(substr($time, 0, 2)) * 60 + intval(substr($time, 3, 2));
    
            // Check if there is an existing order within the interval
            $existingOrders = $model->where('tanggal_event', $date)->findAll();
            foreach ($existingOrders as $order) {
                $orderTime = intval(substr($order['waktu_event'], 0, 2)) * 60 + intval(substr($order['waktu_event'], 3, 2));
                if (abs($orderTime - $selectedTime) <= $interval) {
                    $availableTime = date('H:i', strtotime($order['waktu_event']) + $interval * 60 + 60);
                    return $this->response->setJSON([
                        'status' => false,
                        'icon' => 'error',
                        'title' => 'Booking gagal!',
                        'text' => 'Jam yang Anda pilih harus memiliki interval 30 menit dari order sebelumnya. Silakan pilih jam lain. Waktu yang tersedia: ' . $availableTime,
                    ]);
                }
            }
    
            $data = [
                'kode_pembayaran' => $this->generateCode(10),
                'tanggal_event' => $date,
                'waktu_event' => $time,
                'kategori_event' => $this->request->getPost('kategori_event'),
                'lokasi_event' => $latitude,
                'detail_lokasi' => $longitude,
                'harga' => $this->request->getVar('harga'),
                'no_hp' => $this->request->getVar('no_hp'),
                'status' => 'pending',
                'username' => $email,
            ];
    
            $queryUser = $modelUser->where('username', $email)->first();
            $username = $queryUser['username'];
            $checkpointDone = $model->checkpointDone($username);
    
            if ($checkpointDone === false) {
                $model->save($data);
                return $this->response->setJSON([
                    'status' => true,
                    'icon' => 'success',
                    'title' => 'Booking Berhasil!',
                    'text' => 'Pop up ini akan hilang dalam 3 detik',
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'icon' => 'error',
                    'title' => 'Booking gagal!',
                    'text' => 'Anda dapat booking ketika pesanan yang sebelumnya sudah status DONE.',
                ]);
            }
        } else {
            $data = [
                'admin' => $modelUser->where('role', 'admin')->first(),
                'content' => $model->getOrdersByUsername(session()->get('username'))->getResult()
            ];
            return view('pages/homeOrders', $data);
        }
    }    

    public function bayar()
    {
        $id = $this->request->getVar('id');
        $user_id = $this->request->getVar('user_id');
    
        if ($this->request->getFile('fileInput')->isValid()) {
            $file = $this->request->getFile('fileInput');
            $uploadDir = FCPATH . 'uploads/fotopembayaran/';
            $extension = pathinfo($file->getName(), PATHINFO_EXTENSION);
            $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 8);
            $filename = $randomString . '.' . $extension;

            if ($file->move($uploadDir, $filename)) {
                $response = [
                    'status' => 'success',
                    'message' => 'File uploaded successfully.'
                ];
                $model = new Orders();
                $userModel = new Users();
                $order = $model->find($id);
                $user = $userModel->find($user_id);
                if ($model->update($id, [
                    'foto_pembayaran' => $filename,
                    'status' => 'on_progres'
                ])) {
                    $data['get'] = [
                        'username'  => $order['username'],
                        'nama'      => $user['nama'],
                        'nomor_hp'  => $user['nomor_hp'],
                        'alamat'    => $user['alamat'],
                        'email'     => $user['email'],
                        'harga'     => $order['harga'],
                        'status'    => $this->request->getPost('status'),
                        'update'    => $order['updated_at'],
                        'kode_pembayaran'=> $order['kode_pembayaran'],
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
                            'title' => 'Pembayaran Berhasil!',
                            'text' => 'Silahkan Check Email Anda.',
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
                $response = [
                    'status' => 'error',
                    'message' => 'Error uploading file.'
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No file uploaded.'
            ];
        }
    
        return $this->response->setJSON($response);
    }
}
