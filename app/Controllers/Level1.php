<?php

namespace App\Controllers;

use App\Models\KebunModel;

class Level1 extends BaseController
{
    protected $kebunModel;
    public function __construct()
    {
        $this->kebunModel = new KebunModel();
    }

    public function index()
    {
        $data = [
            'title' => 'NBEx | Level 1',
            'kebunB' => $this->kebunModel->kebunbarat(),
            'kebunT' => $this->kebunModel->kebuntimur(),
            'allkebun' => $this->kebunModel->kebunAll(),
        ];

        return view('level1/index', $data);
    }

    public function nilai()
    {
        $tahun = $_GET['tahun'];
        echo json_encode($this->kebunModel->nilailevel1($tahun));
    }
}
