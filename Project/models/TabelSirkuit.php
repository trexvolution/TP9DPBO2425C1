<?php
include_once ("DB.php");
include_once (__DIR__ . "/../KontrakSirkuit.php"); // Sesuaikan path

class TabelSirkuit extends DB implements KontrakModelSirkuit {
    public function __construct($host, $db, $user, $pass) {
        parent::__construct($host, $db, $user, $pass);
    }

    public function getAllSirkuit(): array {
        $this->executeQuery("SELECT * FROM sirkuit");
        return $this->getAllResult();
    }

    public function getSirkuitById($id): ?array {
        $this->executeQuery("SELECT * FROM sirkuit WHERE id = :id", ['id' => $id]);
        $res = $this->getAllResult();
        return $res[0] ?? null;
    }

    public function addSirkuit($nama, $negara, $panjang, $tikungan): void {
        $q = "INSERT INTO sirkuit (nama, negara, panjang_km, jumlah_tikungan) VALUES (:n, :neg, :p, :t)";
        $this->executeQuery($q, ['n'=>$nama, 'neg'=>$negara, 'p'=>$panjang, 't'=>$tikungan]);
    }

    public function updateSirkuit($id, $nama, $negara, $panjang, $tikungan): void {
        $q = "UPDATE sirkuit SET nama=:n, negara=:neg, panjang_km=:p, jumlah_tikungan=:t WHERE id=:id";
        $this->executeQuery($q, ['id'=>$id, 'n'=>$nama, 'neg'=>$negara, 'p'=>$panjang, 't'=>$tikungan]);
    }

    public function deleteSirkuit($id): void {
        $this->executeQuery("DELETE FROM sirkuit WHERE id=:id", ['id'=>$id]);
    }
}
?>