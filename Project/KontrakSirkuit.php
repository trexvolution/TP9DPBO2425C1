<?php
// FILE: KontrakSirkuit.php

interface KontrakModelSirkuit {
    public function getAllSirkuit(): array;
    public function getSirkuitById($id): ?array;
    public function addSirkuit($nama, $negara, $panjang, $tikungan): void;
    public function updateSirkuit($id, $nama, $negara, $panjang, $tikungan): void;
    public function deleteSirkuit($id): void;
}

interface KontrakViewSirkuit {
    public function tampilSirkuit($listSirkuit): string;
    public function tampilFormSirkuit($data = null): string;
}

interface KontrakPresenterSirkuit {
    public function tampilkanSirkuit(): string;
    public function tampilkanFormSirkuit($id = null): string;
    public function tambahSirkuit($nama, $negara, $panjang, $tikungan): void;
    public function ubahSirkuit($id, $nama, $negara, $panjang, $tikungan): void;
    public function hapusSirkuit($id): void;
}
?>