<?php

include 'Produk.php';
include 'Diskon.php';

class Buku extends Produk implements Diskon
{
  private $penulis;

  public function __construct($nama, $harga, $penulis)
  {
    parent::__construct($nama, $harga);
    $this->penulis = $penulis;
  }

  public function getInfo()
  {
    return 'Nama Buku ' . $this->getNama() . ' dengan harga Rp ' . number_format($this->getHarga(), 0, ',', '.') . ' Penulis ' . $this->penulis;
  }

  public function hitungDiskon()
  {
    return $this->getHarga() * 0.5;
  }
}
