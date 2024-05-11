<?php

namespace App\Http\Entity;

class PembayaranEntity
{
	private $id;
	private $tagihan_id;
	private $tanggal_pembayaran;
	private $metode_pembayaran;
	private $jumlah_pembayaran;
	private $sisa_tagihan;
	private $bukti_pembayaran;
	private $keterangan;

	// Constructor
	public function __construct($id, $tagihan_id, $tanggal_pembayaran, $metode_pembayaran, $jumlah_pembayaran, $sisa_tagihan, $bukti_pembayaran, $keterangan)
	{
		$this->id = $id;
		$this->tagihan_id = $tagihan_id;
		$this->tanggal_pembayaran = $tanggal_pembayaran;
		$this->metode_pembayaran = $metode_pembayaran;
		$this->jumlah_pembayaran = $jumlah_pembayaran;
		$this->sisa_tagihan = $sisa_tagihan;
		$this->bukti_pembayaran = $bukti_pembayaran;
		$this->keterangan = $keterangan;
	}


	/**
	 * Get the id.
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Get the tagihan_id.
	 *
	 * @return mixed
	 */
	public function getTagihanId()
	{
		return $this->tagihan_id;
	}


	/**
	 * Get the tanggal_pembayaran.
	 *
	 * @return mixed
	 */
	public function getTanggalPembayaran()
	{
		return $this->tanggal_pembayaran;
	}


	/**
	 * Get the metode_pembayaran.
	 *
	 * @return mixed
	 */
	public function getMetodePembayaran()
	{
		return $this->metode_pembayaran;
	}


	/**
	 * Get the jumlah_pembayaran.
	 *
	 * @return mixed
	 */
	public function getJumlahPembayaran()
	{
		return $this->jumlah_pembayaran;
	}


	/**
	 * Get the sisa_tagihan.
	 *
	 * @return mixed
	 */
	public function getSisaTagihan()
	{
		return $this->sisa_tagihan;
	}


	/**
	 * Get the bukti_pembayaran.
	 *
	 * @return mixed
	 */
	public function getBuktiPembayaran()
	{
		return $this->bukti_pembayaran;
	}


	/**
	 * Get the keterangan.
	 *
	 * @return mixed
	 */
	public function getKeterangan()
	{
		return $this->keterangan;
	}


	/**
	 * Set the id.
	 *
	 * @return mixed
	 */
	public function setId($value)
	{
		$this->id = $value;
	}


	/**
	 * Set the tagihan_id.
	 *
	 * @return mixed
	 */
	public function setTagihanId($value)
	{
		$this->tagihan_id = $value;
	}


	/**
	 * Set the tanggal_pembayaran.
	 *
	 * @return mixed
	 */
	public function setTanggalPembayaran($value)
	{
		$this->tanggal_pembayaran = $value;
	}


	/**
	 * Set the metode_pembayaran.
	 *
	 * @return mixed
	 */
	public function setMetodePembayaran($value)
	{
		$this->metode_pembayaran = $value;
	}


	/**
	 * Set the jumlah_pembayaran.
	 *
	 * @return mixed
	 */
	public function setJumlahPembayaran($value)
	{
		$this->jumlah_pembayaran = $value;
	}


	/**
	 * Set the sisa_tagihan.
	 *
	 * @return mixed
	 */
	public function setSisaTagihan($value)
	{
		$this->sisa_tagihan = $value;
	}


	/**
	 * Set the bukti_pembayaran.
	 *
	 * @return mixed
	 */
	public function setBuktiPembayaran($value)
	{
		$this->bukti_pembayaran = $value;
	}


	/**
	 * Set the keterangan.
	 *
	 * @return mixed
	 */
	public function setKeterangan($value)
	{
		$this->keterangan = $value;
	}

	// Other necessary methods...
}
