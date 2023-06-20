<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\Token;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    private function setUserSession($data)
    {
        session()->set([
            'LoginTrue' => TRUE,
            'id'        => $data['id'],
            'nama'      => $data['nama'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'nomor_hp'  => $data['nomor_hp'],
            'alamat'    => $data['alamat'],
            'picture'   => $data['picture'],
            'role'      => $data['role'],
            'created_at'=> $data['created_at'],
        ]);
        return true;
    }

    public function SignIn()
    {
        $model = new Users();
        if ($this->request->isAJAX()) {
            $username = $this->request->getPost('username');
            $password = $this->request->getVar('password');
            $checkpointData = $model->where('username', $username)
                                    ->orWhere('email', $username)
                                    ->first();
            if (!empty($checkpointData)) {
                if (password_verify($password, $checkpointData['password'])) {
                    $this->setUserSession($checkpointData);
                    return $this->response->setJSON([
                        'status' => true,
                        'icon' => 'success',
                        'title' => 'Login Berhasil!',
                        'text' => 'Anda akan diarahkan dalam 3 detik.',
                        'sessionRole' => $checkpointData['role'],
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => false,
                        'icon' => 'error',
                        'title' => 'Oops....',
                        'text' => 'Password salah!',
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'icon' => 'error',
                    'title' => 'Oops....',
                    'text' => 'Username atau email tidak ada!',
                ]);
            }
        }
        return view('pages/auth/homeSignIn');
    }

    public function SignOut()
    {
        session()->destroy();
        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Logout Berhasil!',
            'text' => 'Anda akan diarahkan dalam 3 detik.'
        ]);
    }

    public function SignUp()
    {
        $model = new Users();
        if ($this->request->isAJAX()) {
            $data = [
                'nama'      => $this->request->getPost('nama'),
                'username'  => $this->request->getPost('username'),
                'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'email'     => $this->request->getPost('email'),
                'nomor_hp'  => $this->request->getPost('nomor_hp'),
                'role'      => 'client',
            ];
            $checkpointUsername = $model->where('username', $data['username'])->first();
            $checkpointEmail    = $model->where('email', $data['email'])->first();
            $checkpointNomor    = $model->where('nomor_hp', $data['nomor_hp'])->first();
            if ($checkpointUsername) {
                return $this->response->setJSON([
                    'status' => false,
                    'icon' => 'error',
                    'title' => 'Register gagal!',
                    'text' => 'Username telah digunakan',
                ]);
            } else if ($checkpointEmail) {
                return $this->response->setJSON([
                    'status' => false,
                    'icon' => 'error',
                    'title' => 'Register gagal!',
                    'text' => 'Email telah digunakan',
                ]);
            } else if ($checkpointNomor) {
                return $this->response->setJSON([
                    'status' => false,
                    'icon' => 'error',
                    'title' => 'Register gagal!',
                    'text' => 'Nomor HP telah digunakan',
                ]);
            } else {
                $model->save($data);
                return $this->response->setJSON([
                    'status' => true,
                    'icon' => 'success',
                    'title' => 'Register berhasil!',
                    'text' => 'Anda akan diarahkan dalam 3 detik.',
                ]); 
            }
        }
        return view('pages/auth/homeSignUp');
    }

    public function ForgotPassword()
    {
        $model = new Users();
        $modelToken = new Token();
        if ($this->request->isAJAX()) {
            $email = $this->request->getPost('email');
            $checkpointEmail = $model->verifyEmail($email);
            if (empty($modelToken->where('email', $email)->first())) {
                if (!empty($checkpointEmail)) {
                    $token = md5(uniqid(rand(), true));
                    $dataToken = [
                        'token' => $token,
                        'email' => $email
                    ];
                    if ($modelToken->save($dataToken)) {
                        $data['get'] = [
                            'email' => $email,
                            'nama'  => $checkpointEmail->nama,
                            'username'=> $checkpointEmail->username,
                            'token' => $token
                        ];
                        $to = $email;
                        $subject = 'Reset Password';
                        $message = view('email/authResetPassword.php', $data);
                            
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
                                'title' => 'Permintaan Berhasil!',
                                'text' => 'Silahkan cek email anda.',
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
                        'status' => false,
                        'icon' => 'error',
                        'title' => 'Permintaan Gagal!',
                        'text' => 'Email yang ada input tidak ada di database.',
                    ]); 
                }
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'icon' => 'error',
                    'title' => 'Permintaan Gagal!',
                    'text' => 'Anda tidak dapat melakukan permintaan ini 2 kali.',
                ]); 
            }
        }
        return view('pages/auth/homeForgotPassword');
    }

    public function NewPassword($token, $username)
    {
        $model = new Users();
        $modelToken = new Token();
        $verifyTokenFirst = $modelToken->where('token', $token)->first();
        if ($this->request->isAJAX() && $this->request->getMethod(true) === 'POST') {
            $checkpointToken = $modelToken->verifyToken($token);
            if ($checkpointToken) {
                $data = [
                    'password'   => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $user = $model->where('username', $username)->first();
                $id = $user['id'];
                if ($model->update($id, $data)) {
                    $idToken = $modelToken->where('token', $token)->first();
                    $deleteToken = $modelToken->where('id', $idToken['id'])->delete($idToken['id']);
                    if ($deleteToken) {
                        return $this->response->setJSON([
                            'status' => true,
                            'icon' => 'success',
                            'title' => 'Update Berhasil!',
                            'text' => 'Pop up ini akan hilang dalam 3 detik.',
                        ]);
                    } else {
                        return $this->response->setJSON([
                            'status' => false,
                            'icon' => 'error',
                            'title' => 'Delete Token Fail!',
                            'text' => 'Pop up ini akan hilang dalam 3 detik.',
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'status' => false,
                        'icon' => 'error',
                        'title' => 'Update Gagal!',
                        'text' => 'Pop up ini akan hilang dalam 3 detik.',
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'icon' => 'error',
                    'title' => 'Update Gagal!',
                    'text' => 'Pop up ini akan hilang dalam 3 detik.',
                ]);
            }
        } elseif ($verifyTokenFirst) {
            $data = [
                'token' => $token,
                'username' => $username
            ];
            return view('pages/auth/homeNewPassword', $data);
        } else {
            session()->setFlashdata('error', 'Token Invalid.');
            return redirect()->to('signin');
        }
    }
}
