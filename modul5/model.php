<?php
require "Koneksi.php";

// ==================== BUKU ====================
function getAllBuku() {
    global $koneksi;
    $query = "SELECT * FROM buku";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getBukuById($id) {
    global $koneksi;
    $query = "SELECT * FROM buku WHERE id_buku = $id";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}

function insertBuku($judul, $penulis, $penerbit, $tahun) {
    global $koneksi;
    $query = "INSERT INTO buku (judul_buku, penulis, penerbit, tahun_terbit) 
              VALUES ('$judul', '$penulis', '$penerbit', '$tahun')";
    return mysqli_query($koneksi, $query);
}

function updateBuku($id, $judul, $penulis, $penerbit, $tahun) {
    global $koneksi;
    $query = "UPDATE buku SET 
              judul_buku='$judul', penulis='$penulis', 
              penerbit='$penerbit', tahun_terbit='$tahun' 
              WHERE id_buku=$id";
    return mysqli_query($koneksi, $query);
}

function deleteBuku($id) {
    global $koneksi;
    $query = "DELETE FROM buku WHERE id_buku = $id";
    return mysqli_query($koneksi, $query);
}

// ==================== MEMBER ====================
function getAllMember() {
    global $koneksi;
    $query = "SELECT * FROM member";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getMemberById($id) {
    global $koneksi;
    $query = "SELECT * FROM member WHERE id_member = $id";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}

function insertMember($nama, $nomor, $alamat, $tgl_mendaftar, $tgl_bayar) {
    global $koneksi;
    $query = "INSERT INTO member (nama_member, nomor_member, alamat, tgl_mendaftar, tgl_terkahir_bayar) 
              VALUES ('$nama', '$nomor', '$alamat', '$tgl_mendaftar', '$tgl_bayar')";
    return mysqli_query($koneksi, $query);
}

function updateMember($id, $nama, $nomor, $alamat, $tgl_mendaftar, $tgl_bayar) {
    global $koneksi;
    $query = "UPDATE member SET 
              nama_member='$nama', nomor_member='$nomor', alamat='$alamat',
              tgl_mendaftar='$tgl_mendaftar', tgl_terkahir_bayar='$tgl_bayar'
              WHERE id_member=$id";
    return mysqli_query($koneksi, $query);
}

function deleteMember($id) {
    global $koneksi;
    $query = "DELETE FROM member WHERE id_member = $id";
    return mysqli_query($koneksi, $query);
}

// ==================== PEMINJAMAN ====================
function getAllPeminjaman() {
    global $koneksi;
    $query = "SELECT p.*, m.nama_member, b.judul_buku 
              FROM peminjaman p
              JOIN member m ON p.id_member = m.id_member
              JOIN buku b ON p.id_buku = b.id_buku";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getPeminjamanById($id) {
    global $koneksi;
    $query = "SELECT * FROM peminjaman WHERE id_peminjaman = $id";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}

function insertPeminjaman($id_member, $id_buku, $tgl_pinjam, $tgl_kembali) {
    global $koneksi;
    $query = "INSERT INTO peminjaman (id_member, id_buku, tgl_pinjam, tgl_kembali) 
              VALUES ('$id_member', '$id_buku', '$tgl_pinjam', '$tgl_kembali')";
    return mysqli_query($koneksi, $query);
}

function updatePeminjaman($id, $id_member, $id_buku, $tgl_pinjam, $tgl_kembali) {
    global $koneksi;
    $query = "UPDATE peminjaman SET 
              id_member='$id_member', id_buku='$id_buku',
              tgl_pinjam='$tgl_pinjam', tgl_kembali='$tgl_kembali'
              WHERE id_peminjaman=$id";
    return mysqli_query($koneksi, $query);
}

function deletePeminjaman($id) {
    global $koneksi;
    $query = "DELETE FROM peminjaman WHERE id_peminjaman = $id";
    return mysqli_query($koneksi, $query);
}