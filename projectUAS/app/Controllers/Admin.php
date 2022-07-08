<?php

namespace App\Controllers;

use App\Models\AgendaModel;
use App\Models\AntrianModel;
use App\Models\LoketModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function __construct()
    {
        helper('form');
        if (!session()->get('id')) {
            return redirect()->to('/login');
        }
    }
    public function index()
    {
        return view('dashboard/dashboard');
    }
    public function antrian()
    {
        if (!session()->get('role') || session()->get('role') != 1) {
            return redirect()->to('/');
        }
        $loket = new LoketModel();
        $antrian = new AntrianModel();
        $id = session()->get('id');
        $data['own'] =  $loket->where('id_users', $id)->find();
        $data['no'] = '-';
        if ($data['own']) {
            if ($data['own'][0]['status'] == 1) {
                $data['antrian'] = $antrian->where('id_users', $id)->where('id_loket', $data['own'][0]['id'])->orderBy('id', 'DESC')->find();
                if ($data['antrian']) {
                    $data['no'] = $data['antrian'][0]['no_antrian'];
                }
            }
        } else {
            return redirect()->to('/');
        }
        $data['all'] =  $loket->where('id_users !=', $id)->find();
        if ($data['all']) {
            foreach ($data['all'] as $key => $value) {
                $cek = $antrian->where('id_loket', $value['id'])->orderBy('id', 'DESC')->find();
                if ($cek) {
                    $data['no_all'][$key] = $cek[0]['no_antrian'];
                } else {
                    $data['no_all'][$key] = '-';
                }
            }
        }

        echo view('dashboard/antrian', $data);
    }
    public function antrian_next($id)
    {
        if (!session()->get('role') || session()->get('role') != 1) {
            return redirect()->to('/login');
        }
        $loket = new LoketModel();
        $antrian = new AntrianModel();
        $tanggal = date('Ymd');
        $loket->update($id, ["status" => 1]);
        $cek = $antrian->where('tanggal', $tanggal)->where('id_loket', NULL)->where('id_users', NULL)->find();
        if ($cek) {
            echo "ok";
            $antrian->update($cek[0]['id'], [
                "id_loket" => $id,
                "id_users" => session()->get('id')
            ]);
        }
        return redirect()->to('/antrian');
    }
    public function laporan()
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $db = db_connect();
        $builder = $db->table("antrian");
        $builder->selectCount('id', 'total');
        $builder->select('tanggal');
        $builder->groupBy('tanggal');
        $query = $builder->get();
        $data['laporan'] = $query->getResult();
        return view('dashboard/laporan', $data);
    }
    public function laporan_hapus($tanggal)
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $antrian = new AntrianModel();
        $antrian->where('tanggal', $tanggal)->delete();
        return redirect()->to('/laporan');
    }
    public function loket()
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $loket = new LoketModel();
        $users = new UserModel();
        $data['loket'] = $loket->join('users', 'users.id = loket.id_users')->select('loket.id,loket,username,status')->find();
        $data['users'] = $users->where('role', 1)->select('users.id, username')->find();
        //print_r($data['users']);
        return view('dashboard/loket', $data);
    }
    public function loket_tambah()
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $loket = new LoketModel();
        $loket->insert([
            'loket' => $this->request->getVar('no'),
            'id_users' =>  $this->request->getVar('users')
        ]);
        return redirect()->to('/loket');
    }
    public function loket_edit($id)
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $loket = new LoketModel();
        $loket->update($id, [
            'loket' => $this->request->getVar('no'),
            'id_users' =>  $this->request->getVar('users')
        ]);
        return redirect()->to('/loket');
    }
    public function loket_hapus($id)
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $loket = new LoketModel();
        $loket->where('id', $id)->delete();
        return redirect()->to('/loket');
    }
    public function pelayan()
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $users = new UserModel();
        $data['users'] = $users->find();
        //print_r($data['users']);
        return view('dashboard/pelayan', $data);
    }
    public function pelayan_tambah()
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $users = new UserModel();
        $users->insert([
            'fullname'     => $this->request->getVar('fullname'),
            'email'    => $this->request->getVar('email'),
            'username'    => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'alamat'    => $this->request->getVar('alamat'),
            'telepon'    => $this->request->getVar('telepon'),
            'role'    => $this->request->getVar('role'),
        ]);
        return redirect()->to('/pelayan');
    }
    public function pelayan_edit($id)
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $users = new UserModel();
        if ($this->request->getVar('password')) {
            $users->update($id, [
                'fullname'     => $this->request->getVar('fullname'),
                'email'    => $this->request->getVar('email'),
                'username'    => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'alamat'    => $this->request->getVar('alamat'),
                'telepon'    => $this->request->getVar('telepon'),
                'role'    => $this->request->getVar('role'),
            ]);
        } else {
            $users->update($id, [
                'fullname'     => $this->request->getVar('fullname'),
                'email'    => $this->request->getVar('email'),
                'username'    => $this->request->getVar('username'),
                'alamat'    => $this->request->getVar('alamat'),
                'telepon'    => $this->request->getVar('telepon'),
                'role'    => $this->request->getVar('role'),
            ]);
        }

        return redirect()->to('/pelayan');
    }
    public function pelayan_hapus($id)
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $users = new UserModel();
        $users->where('id', $id)->delete();
        return redirect()->to('/pelayan');
    }
    public function agenda()
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $users = new AgendaModel();
        $data['agenda'] = $users->find();
        //print_r($data['users']);
        return view('dashboard/agenda', $data);
    }
    public function agenda_tambah()
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $avatar = $this->request->getFile('file');
        $namefile = date('dmyHis');
        $avatar->move(ROOTPATH . 'public/media/agenda', $namefile);
        $agenda = new AgendaModel();
        $agenda->insert([
            'nama'     => $this->request->getVar('nama'),
            'keterangan'    => $this->request->getVar('keterangan'),
            'file' => $namefile
        ]);
        return redirect()->to('/agenda');
    }
    public function agenda_edit($id)
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $avatar = $this->request->getFile('file');
        $namefile = date('dmyHis');
        $agenda = new AgendaModel();
        $avatar->move(ROOTPATH . 'public/media/agenda', $namefile);
        $agenda->update($id, [
            'nama'     => $this->request->getVar('nama'),
            'keterangan'    => $this->request->getVar('keterangan'),
            'file' => $namefile
        ]);

        return redirect()->to('/agenda');
    }
    public function agenda_hapus($id)
    {
        if (!session()->get('id') || session()->get('role') != 0) {
            return redirect()->to('/login');
        }
        $agenda = new AgendaModel();
        $agenda->where('id', $id)->delete();
        return redirect()->to('/agenda');
    }
}
