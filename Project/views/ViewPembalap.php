<?php

include_once ("KontrakView.php");
include_once ("models/Pembalap.php");

class ViewPembalap implements KontrakView{

    public function __construct(){
        // Konstruktor kosong
    }

    public function tampilPembalap($listPembalap): string {
        $tbody = '';
        $no = 1;
        foreach($listPembalap as $pembalap){
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">'. $no .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getNama()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getTim()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getNegara()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getPoinMusim()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getJumlahMenang()) .'</td>';
            
            // Kolom Aksi (Edit & Hapus)
            $tbody .= '<td class="col-actions">';
            $tbody .= '<a href="index.php?modul=pembalap&screen=edit&id='. $pembalap->getId() .'" class="btn btn-edit">Edit</a> ';
            $tbody .= '<form method="POST" action="index.php?modul=pembalap" style="display:inline;" onsubmit="return confirm(\'Hapus data ini?\');">';
            $tbody .= '<input type="hidden" name="action" value="delete">';
            $tbody .= '<input type="hidden" name="id" value="'. $pembalap->getId() .'">';
            $tbody .= '<button type="submit" class="btn btn-delete">Hapus</button>';
            $tbody .= '</form>';
            $tbody .= '</td>';
            
            $tbody .= '</tr>';
            $no++;
        }

        // Load template
        $templatePath = __DIR__ . '/../template/skin.html';
        
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            
            // PERBAIKAN: Menggunakan penanda yang lebih simpel "DATA_TABEL"
            // agar tidak error karena spasi/format komentar HTML
            $template = str_replace('DATA_TABEL', $tbody, $template);
            
            // Update Total Data
            $total = count($listPembalap);
            $template = str_replace('DATA_TOTAL', $total, $template);
            
            return $template;
        }

        // Fallback jika template tidak ada
        return $tbody;
    }

    public function tampilFormPembalap($data = null): string {
        // ... (Kode bagian form tetap sama seperti sebelumnya) ...
        // Agar tidak kepanjangan, pastikan bagian ini menggunakan form.html yang sudah diperbaiki sebelumnya
        $template = file_get_contents(__DIR__ . '/../template/form.html');
        // ... logic replace form ...
        if ($data) {
            $template = str_replace('value="add" id="pembalap-action"', 'value="edit" id="pembalap-action"', $template);
            $template = str_replace('value="" id="pembalap-id"', 'value="' . htmlspecialchars($data['id']) . '" id="pembalap-id"', $template);
            $template = str_replace('id="nama" name="nama" type="text" placeholder="Nama pembalap"', 'id="nama" name="nama" type="text" placeholder="Nama pembalap" value="' . htmlspecialchars($data['nama']) . '"', $template);
            $template = str_replace('id="tim" name="tim" type="text" placeholder="Nama tim"', 'id="tim" name="tim" type="text" placeholder="Nama tim" value="' . htmlspecialchars($data['tim']) . '"', $template);
            $template = str_replace('id="negara" name="negara" type="text" placeholder="Negara (mis. Indonesia)"', 'id="negara" name="negara" type="text" placeholder="Negara (mis. Indonesia)" value="' . htmlspecialchars($data['negara']) . '"', $template);
            $template = str_replace('id="poinMusim" name="poinMusim" type="number" min="0" step="1" placeholder="0"', 'id="poinMusim" name="poinMusim" type="number" min="0" step="1" placeholder="0" value="' . htmlspecialchars($data['poinMusim']) . '"', $template);
            $template = str_replace('id="jumlahMenang" name="jumlahMenang" type="number" min="0" step="1" placeholder="0"', 'id="jumlahMenang" name="jumlahMenang" type="number" min="0" step="1" placeholder="0" value="' . htmlspecialchars($data['jumlahMenang']) . '"', $template);
        }
        return $template;
    }
}
?>