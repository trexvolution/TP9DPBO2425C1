<?php
include_once (__DIR__ . "/../models/Sirkuit.php");
include_once (__DIR__ . "/../KontrakSirkuit.php");

class PresenterSirkuit implements KontrakPresenterSirkuit {
    private $model;
    private $view;
    private $listSirkuit = [];

    public function __construct($model, $view){
        $this->model = $model;
        $this->view = $view;
    }

    public function tampilkanSirkuit(): string {
        $data = $this->model->getAllSirkuit();
        $this->listSirkuit = [];
        foreach($data as $row){
            $this->listSirkuit[] = new Sirkuit($row['id'], $row['nama'], $row['negara'], $row['panjang_km'], $row['jumlah_tikungan']);
        }
        return $this->view->tampilSirkuit($this->listSirkuit);
    }

    public function tampilkanFormSirkuit($id = null): string {
        $data = null;
        if($id) $data = $this->model->getSirkuitById($id);
        return $this->view->tampilFormSirkuit($data);
    }

    public function tambahSirkuit($n, $neg, $p, $t): void {
        $this->model->addSirkuit($n, $neg, $p, $t);
    }
    public function ubahSirkuit($id, $n, $neg, $p, $t): void {
        $this->model->updateSirkuit($id, $n, $neg, $p, $t);
    }
    public function hapusSirkuit($id): void {
        $this->model->deleteSirkuit($id);
    }
}
?>