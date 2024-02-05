<?php

namespace App\Http\Entity;

class SuratKeluarModelEntity
{
	private $id;
	private $nomor_surat;
	private $tanggal_kirim;
	private $tujuan;
	private $perihal;
	private $keterangan;
	private $lampiran;
	private $status;

	// Constructor
	public function __construct($id, $nomor_surat, $tanggal_kirim, $tujuan, $perihal, $keterangan, $lampiran, $status)
	{
		$this->id = $id;
		$this->nomor_surat = $nomor_surat;
		$this->tanggal_kirim = $tanggal_kirim;
		$this->tujuan = $tujuan;
		$this->perihal = $perihal;
		$this->keterangan = $keterangan;
		$this->lampiran = $lampiran;
		$this->status = $status;
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
	 * Get the tanggal_kirim.
	 *
	 * @return mixed
	 */
	public function getTanggalKirim()
	{
		return $this->tanggal_kirim;
	}


	/**
	 * Get the tujuan.
	 *
	 * @return mixed
	 */
	public function getTujuan()
	{
		return $this->tujuan;
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
	 * Get the status.
	 *
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->status;
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
	 * Set the tanggal_kirim.
	 *
	 * @return mixed
	 */
	public function setTanggalKirim($value)
	{
		$this->tanggal_kirim = $value;
	}


	/**
	 * Set the tujuan.
	 *
	 * @return mixed
	 */
	public function setTujuan($value)
	{
		$this->tujuan = $value;
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


	/**
	 * Set the status.
	 *
	 * @return mixed
	 */
	public function setStatus($value)
	{
		$this->status = $value;
	}

	// Other necessary methods...
}
