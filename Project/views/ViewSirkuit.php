<?php
include_once (__DIR__ . "/../KontrakSirkuit.php");

class ViewSirkuit implements KontrakViewSirkuit {

    public function tampilSirkuit($listSirkuit): string {
        // Header Navigasi Sederhana
        $html = '<div style="margin-bottom: 20px;">
                    <a href="index.php?modul=pembalap" class="btn">Data Pembalap</a> | 
                    <a href="index.php?modul=sirkuit" class="btn" style="font-weight:bold">Data Sirkuit</a>
                 </div>';
        
        $html .= '<h3>Daftar Sirkuit</h3>';
        $html .= '<a href="index.php?modul=sirkuit&screen=add" class="btn btn-add">Tambah Sirkuit</a>';
        $html .= '<table border="1" cellpadding="10" cellspacing="0" width="100%">';
        $html .= '<thead><tr><th>No</th><th>Nama</th><th>Negara</th><th>Panjang (KM)</th><th>Tikungan</th><th>Aksi</th></tr></thead><tbody>';
        
        $no = 1;
        foreach($listSirkuit as $s) {
            $html .= '<tr>';
            $html .= '<td>'.$no++.'</td>';
            $html .= '<td>'.htmlspecialchars($s->getNama()).'</td>';
            $html .= '<td>'.htmlspecialchars($s->getNegara()).'</td>';
            $html .= '<td>'.htmlspecialchars($s->getPanjang()).'</td>';
            $html .= '<td>'.htmlspecialchars($s->getTikungan()).'</td>';
            $html .= '<td>
                        <a href="index.php?modul=sirkuit&screen=edit&id='.$s->getId().'">Edit</a> | 
                        <form method="POST" action="index.php?modul=sirkuit" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="'.$s->getId().'">
                            <button type="submit" onclick="return confirm(\'Yakin?\')">Hapus</button>
                        </form>
                      </td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';
        return $html;
    }

    public function tampilFormSirkuit($data = null): string {
        $actionVal = $data ? 'edit' : 'add';
        $idVal = $data ? $data['id'] : '';
        $namaVal = $data ? $data['nama'] : '';
        $negVal = $data ? $data['negara'] : '';
        $panjangVal = $data ? $data['panjang_km'] : '';
        $tikunganVal = $data ? $data['jumlah_tikungan'] : '';

        $html = '<h3>Form Sirkuit</h3>';
        $html .= '<form action="index.php?modul=sirkuit" method="POST">';
        $html .= '<input type="hidden" name="action" value="'.$actionVal.'">';
        if($data) $html .= '<input type="hidden" name="id" value="'.$idVal.'">';
        
        $html .= '<label>Nama Sirkuit:</label><br><input type="text" name="nama" value="'.$namaVal.'" required><br><br>';
        $html .= '<label>Negara:</label><br><input type="text" name="negara" value="'.$negVal.'" required><br><br>';
        $html .= '<label>Panjang (KM):</label><br><input type="number" step="0.01" name="panjang" value="'.$panjangVal.'" required><br><br>';
        $html .= '<label>Jumlah Tikungan:</label><br><input type="number" name="tikungan" value="'.$tikunganVal.'" required><br><br>';
        
        $html .= '<button type="submit">Simpan</button> <a href="index.php?modul=sirkuit">Batal</a>';
        $html .= '</form>';

        return $html;
    }
}
?>