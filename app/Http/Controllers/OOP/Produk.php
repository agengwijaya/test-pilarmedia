<?php

class Produk
{
  private $nama;
  private $harga;

  public function __construct($nama, $harga)
  {
    $this->nama = $nama;
    $this->harga = $harga;
  }

  public function getNama()
  {
    return $this->nama;
  }

  public function getHarga()
  {
    return $this->harga;
  }
}
