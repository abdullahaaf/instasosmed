<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    
    /**
     * fungsi strip_tags() digunakan untuk mencegah html injection
     */

    public function login()
    {
        return view('login');
    }

    public function feed()
    {
        return view('feed');
    }

    public function register()
    {
        return view('register');
    }

    public function prosesLogin()
    {
        $user = new UserModel();
        $data_login =  array(
            'email' => strip_tags($this->request->getPost('email')),
            'password' => strip_tags($this->request->getPost('password'))
        );
        $cek_login = $user->loginUser($data_login['email']);
        if ($cek_login == true) {
            if (password_verify($data_login['password'], $cek_login['password'])) {
                session()->set('userid',$cek_login['id']);
                session()->set('first_name',$cek_login['first_name']);
                session()->set('last_name',$cek_login['last_name']);
                session()->set('email',$cek_login['email']);
                session()->set('logged_in',TRUE);

                return redirect()->to(base_url('member/feed'));
            }else {
                session()->setFlashData('errors',[
                    ''=>'Password yang anda masukkan salah'
                ]);
                return redirect()->to(base_url('login'));
            }
        }else {
            session()->setFlashData('errors',[
                ''=>'Email not found'
            ]);
            return redirect()->to(base_url('login'));
        }
    }

    public function storeRegister()
    {
        $validation = \Config\Services::validation();

        $user = new UserModel();

        $data_user = array(
            'first_name' => strip_tags($this->request->getPost('first_name')),
            'last_name' => strip_tags($this->request->getPost('last_name')),
            'email' => strip_tags($this->request->getPost('email')),
            'password' => strip_tags(password_hash($this->request->getPost('password'), PASSWORD_DEFAULT))
        );

        if ($validation->run($data_user,'user') == false) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }else {
            $simpan_user = $user->insert($data_user);
            if ($simpan_user) {
                session()->setFlashdata('success', 'Registration success, you can login now');
                return redirect()->to(base_url('register')); 
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
