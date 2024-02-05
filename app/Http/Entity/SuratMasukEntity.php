<?php

namespace App\Http\Entity;

class SuratMasukEntity
{
	private $id;
	private $nomor_surat;
	private $tanggal_terima;
	private $pengirim;
	private $perihal;
	private $keterangan;
	private $lampiran;

	// Constructor
	public function __construct($id, $nomor_surat, $tanggal_terima, $pengirim, $perihal, $keterangan, $lampiran)
	{
		$this->id = $id;
		$this->nomor_surat = $nomor_surat;
		$this->tanggal_terima = $tanggal_terima;
		$this->pengirim = $pengirim;
		$this->perihal = $perihal;
		$this->keterangan = $keterangan;
		$this->lampiran = $lampiran;
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
	 * Get the nomor_surat.
	 *
	 * @return mixed
	 */
	public function getNomorSurat()
	{
		return $this->nomor_surat;
	}


	/**
	 * Get the tanggal_terima.
	 *
	 * @return mixed
	 */
	public function getTanggalTerima()
	{
		return $this->tanggal_terima;
	}


	/**
	 * Get the pengirim.
	 *
	 * @return mixed
	 */
	public function getPengirim()
	{
		return $this->pengirim;
	}


	/**
	 * Get the perihal.
	 *
	 * @return mixed
	 */
	public function getPerihal()
	{
		return $this->perihal;
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
	 * Get the lampiran.
	 *
	 * @return mixed
	 */
	public function getLampiran()
	{
		return $this->lampiran;
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
	 * Set the nomor_surat.
	 *
	 * @return mixed
	 */
	public function setNomorSurat($value)
	{
		$this->nomor_surat = $value;
	}


	/**
	 * Set the tanggal_terima.
	 *
	 * @return mixed
	 */
	public function setTanggalTerima($value)
	{
		$this->tanggal_terima = $value;
	}


	/**
	 * Set the pengirim.
	 *
	 * @return mixed
	 */
	public function setPengirim($value)
	{
		$this->pengirim = $value;
	}


	/**
	 * Set the perihal.
	 *
	 * @return mixed
	 */
	public function setPerihal($value)
	{
		$this->perihal = $value;
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


	/**
	 * Set the lampiran.
	 *
	 * @return mixed
	 */
	public function setLampiran($value)
	{
		$this->lampiran = $value;
	}

	// Other necessary methods...
}
