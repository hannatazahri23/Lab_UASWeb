<?php

namespace App\Controllers;

use App\Models\LoketModel;
use CodeIgniter\I18n\Time;

class AuthController extends TamhorAuth
{
    public function login()
    {
        $input = $this->request->getVar('input');
        $password = $this->request->getVar('password');
        $data = $this->users->where('email', $input)->orWhere('username', $input)->first();

        if ($data != null) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);

            if ($verify_pass) {
                $sess_data = [
                    'id'       => $data['id'],
                    'email'     => $data['email'],
                    'username'    => $data['username'],
                    'fullname'    => $data['fullname'],
                    'logged_in'     => TRUE,
                    'role' => $data['role']
                ];
                $this->session->set($sess_data);
                $db      = \Config\Database::connect();
                $builder = $db->table('loket');
                $builder->set('status', 0);
                $builder->where('id_users', session()->get('id'));
                $builder->update();
                return redirect()->to('/');
            } else {
                $this->session->setFlashdata(
                    'msg',
                    $this->errors(
                        'Wrong Password'
                    )
                );
                return redirect()->to('/login');
            }
        } else {
            $this->session->setFlashdata(
                'msg',
                $this->errors(
                    'Email / Username not Found'
                )
            );
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('loket');
        $builder->set('status', 0);
        $builder->where('id_users', session()->get('id'));
        $builder->update();
        $this->session->destroy();
        $this->session->setFlashdata('msg', 'Your logout');
        return redirect()->to('/');
    }
}
