<?php

// Include semua file yang diperlukan
include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("models/TabelSirkuit.php");

include_once("views/ViewPembalap.php");
include_once("views/ViewSirkuit.php");

include_once("presenters/PresenterPembalap.php");
include_once("presenters/PresenterSirkuit.php");

// Routing Sederhana menggunakan Query Parameter 'modul'
$modul = $_GET['modul'] ?? 'pembalap'; // Default ke pembalap

// HEADER NAVIGASI (Agar bisa pindah antar modul)
echo '<div style="padding: 10px; background: #eee; margin-bottom:20px; font-family: sans-serif;">
        <strong>APP BALAPAN MVP</strong> | 
        <a href="index.php?modul=pembalap">Pembalap</a> | 
        <a href="index.php?modul=sirkuit">Sirkuit</a>
      </div>';

// === LOGIC PEMBALAP ===
if ($modul == 'pembalap') {
    $model = new TabelPembalap('localhost', 'mvp_db', 'root', '');
    $view = new ViewPembalap();
    $presenter = new PresenterPembalap($model, $view);

    // Handle POST Action (Create/Update/Delete)
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $presenter->tambahPembalap($_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->ubahPembalap($_POST['id'], $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'delete' || isset($_POST['delete_id'])) { 
            // Handle delete via form or button logic
            $id = $_POST['id'] ?? $_POST['delete_id']; // sesuaikan dengan name di form
            $presenter->hapusPembalap($id);
        }
        // Redirect clean
        header("Location: index.php?modul=pembalap");
        exit();
    }

    // Handle GET Screen (View List / Form)
    $screen = $_GET['screen'] ?? 'list';
    $id = $_GET['id'] ?? null;

    if ($screen == 'add') {
        echo $presenter->tampilkanFormPembalap();
    } elseif ($screen == 'edit' && $id) {
        echo $presenter->tampilkanFormPembalap($id);
    } else {
        echo $presenter->tampilkanPembalap();
    }
} 

// === LOGIC SIRKUIT ===
elseif ($modul == 'sirkuit') {
    $model = new TabelSirkuit('localhost', 'mvp_db', 'root', '');
    $view = new ViewSirkuit();
    $presenter = new PresenterSirkuit($model, $view);

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $presenter->tambahSirkuit($_POST['nama'], $_POST['negara'], $_POST['panjang'], $_POST['tikungan']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->ubahSirkuit($_POST['id'], $_POST['nama'], $_POST['negara'], $_POST['panjang'], $_POST['tikungan']);
        } elseif ($_POST['action'] == 'delete') {
            $presenter->hapusSirkuit($_POST['id']);
        }
        header("Location: index.php?modul=sirkuit");
        exit();
    }

    $screen = $_GET['screen'] ?? 'list';
    $id = $_GET['id'] ?? null;

    if ($screen == 'add') {
        echo $presenter->tampilkanFormSirkuit();
    } elseif ($screen == 'edit' && $id) {
        echo $presenter->tampilkanFormSirkuit($id);
    } else {
        echo $presenter->tampilkanSirkuit();
    }
}
?>