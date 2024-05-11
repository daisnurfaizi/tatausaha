<?php

namespace App\Http\Entity;

class CicilanEntity
{
	private $id;
	private $tagihan_id;
	private $tanggal_cicilan;
	private $jumlah_cicilan;
	private $bukti_cicilan;

	// Constructor
	public function __construct($id, $tagihan_id, $tanggal_cicilan, $jumlah_cicilan, $bukti_cicilan)
	{
		$this->id = $id;
		$this->tagihan_id = $tagihan_id;
		$this->tanggal_cicilan = $tanggal_cicilan;
		$this->jumlah_cicilan = $jumlah_cicilan;
		$this->bukti_cicilan = $bukti_cicilan;
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
	 * Get the tanggal_cicilan.
	 *
	 * @return mixed
	 */
	public function getTanggalCicilan()
	{
		return $this->tanggal_cicilan;
	}


	/**
	 * Get the jumlah_cicilan.
	 *
	 * @return mixed
	 */
	public function getJumlahCicilan()
	{
		return $this->jumlah_cicilan;
	}


	/**
	 * Get the bukti_cicilan.
	 *
	 * @return mixed
	 */
	public function getBuktiCicilan()
	{
		return $this->bukti_cicilan;
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
	 * Set the tanggal_cicilan.
	 *
	 * @return mixed
	 */
	public function setTanggalCicilan($value)
	{
		$this->tanggal_cicilan = $value;
	}


	/**
	 * Set the jumlah_cicilan.
	 *
	 * @return mixed
	 */
	public function setJumlahCicilan($value)
	{
		$this->jumlah_cicilan = $value;
	}


	/**
	 * Set the bukti_cicilan.
	 *
	 * @return mixed
	 */
	public function setBuktiCicilan($value)
	{
		$this->bukti_cicilan = $value;
	}

	// Other necessary methods...
}
