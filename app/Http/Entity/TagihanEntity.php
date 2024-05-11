<?php

namespace App\Http\Entity;

class TagihanEntity
{
	private $id;
	private $student_id;
	private $bulan_tagihan;
	private $tahun_tagihan;
	private $jumlah_tagihan;
	private $sisa_tagihan;
	private $status_tagihan;
	private $keterangan;

	// Constructor
	public function __construct($id, $student_id, $bulan_tagihan, $tahun_tagihan, $jumlah_tagihan, $sisa_tagihan, $status_tagihan, $keterangan)
	{
		$this->id = $id;
		$this->student_id = $student_id;
		$this->bulan_tagihan = $bulan_tagihan;
		$this->tahun_tagihan = $tahun_tagihan;
		$this->jumlah_tagihan = $jumlah_tagihan;
		$this->sisa_tagihan = $sisa_tagihan;
		$this->status_tagihan = $status_tagihan;
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
	 * Get the student_id.
	 *
	 * @return mixed
	 */
	public function getStudentId()
	{
		return $this->student_id;
	}


	/**
	 * Get the bulan_tagihan.
	 *
	 * @return mixed
	 */
	public function getBulanTagihan()
	{
		return $this->bulan_tagihan;
	}


	/**
	 * Get the tahun_tagihan.
	 *
	 * @return mixed
	 */
	public function getTahunTagihan()
	{
		return $this->tahun_tagihan;
	}


	/**
	 * Get the jumlah_tagihan.
	 *
	 * @return mixed
	 */
	public function getJumlahTagihan()
	{
		return $this->jumlah_tagihan;
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
	 * Get the status_tagihan.
	 *
	 * @return mixed
	 */
	public function getStatusTagihan()
	{
		return $this->status_tagihan;
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
	 * Set the student_id.
	 *
	 * @return mixed
	 */
	public function setStudentId($value)
	{
		$this->student_id = $value;
	}


	/**
	 * Set the bulan_tagihan.
	 *
	 * @return mixed
	 */
	public function setBulanTagihan($value)
	{
		$this->bulan_tagihan = $value;
	}


	/**
	 * Set the tahun_tagihan.
	 *
	 * @return mixed
	 */
	public function setTahunTagihan($value)
	{
		$this->tahun_tagihan = $value;
	}


	/**
	 * Set the jumlah_tagihan.
	 *
	 * @return mixed
	 */
	public function setJumlahTagihan($value)
	{
		$this->jumlah_tagihan = $value;
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
	 * Set the status_tagihan.
	 *
	 * @return mixed
	 */
	public function setStatusTagihan($value)
	{
		$this->status_tagihan = $value;
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
