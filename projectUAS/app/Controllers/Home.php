<?php

namespace App\Controllers;

use App\Models\AntrianModel;
use App\Models\LoketModel;

class Home extends BaseController
{
	public function index()
	{
		$loket = new LoketModel();
		$antrian = new AntrianModel();
		$data['loket'] = $loket->find();
		$cek  = $antrian->where('id_users !=', NULL)->orderBy('id', 'DESC')->find();
		if ($cek) {
			$data['dipanggil'] = $antrian->join('loket', 'loket.id = antrian.id_loket')->where('id_loket', $cek[0]['id_loket'])->orderBy('antrian.id', 'DESC')->find();
		} else {
			$data['dipanggil'] = NULL;
		}
		if ($data['loket']) {
			foreach ($data['loket'] as $key => $value) {
				$cek = $antrian->where('id_loket', $value['id'])->orderBy('id', 'DESC')->find();
				if ($cek) {
					$data['no_antrian'][$key] = $cek[0]['no_antrian'];
				} else {
					$data['no_antrian'][$key] = '-';
				}
			}
		}

		return view('dashboard/dashboard', $data);
	}
	public function Ambil()
	{
		if (session()->get('id')) {
			return redirect()->to('/');
		}
		$antrian = new AntrianModel();
		$date = date('Ymd');
		$cek = $antrian->where('tanggal', $date)->orderBy('id', 'DESC')->find();
		if ($cek) {
			$data['no'] = $cek[0]['no_antrian'] + 1;
		} else {
			$data['no'] = 1;
		}
		$antrian->insert([
			'no_antrian' => $data['no'],
			'tanggal' => $date
		]);
		return view('dashboard/ambil', $data);
	}

	//--------------------------------------------------------------------
}
