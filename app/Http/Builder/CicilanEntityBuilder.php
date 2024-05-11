<?php

namespace App\Http\Builder;

class CicilanEntityBuilder
{
	private $id;
	private $tagihan_id;
	private $tanggal_cicilan;
	private $jumlah_cicilan;
	private $bukti_cicilan;


	/**
	 * Set the id.
	 *
	 * @param mixed $id
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}


	/**
	 * Set the tagihan_id.
	 *
	 * @param mixed $tagihan_id
	 * @return $this
	 */
	public function setTagihanId($tagihan_id)
	{
		$this->tagihan_id = $tagihan_id;
		return $this;
	}


	/**
	 * Set the tanggal_cicilan.
	 *
	 * @param mixed $tanggal_cicilan
	 * @return $this
	 */
	public function setTanggalCicilan($tanggal_cicilan)
	{
		$this->tanggal_cicilan = $tanggal_cicilan;
		return $this;
	}


	/**
	 * Set the jumlah_cicilan.
	 *
	 * @param mixed $jumlah_cicilan
	 * @return $this
	 */
	public function setJumlahCicilan($jumlah_cicilan)
	{
		$this->jumlah_cicilan = $jumlah_cicilan;
		return $this;
	}


	/**
	 * Set the bukti_cicilan.
	 *
	 * @param mixed $bukti_cicilan
	 * @return $this
	 */
	public function setBuktiCicilan($bukti_cicilan)
	{
		$this->bukti_cicilan = $bukti_cicilan;
		return $this;
	}

	// Other necessary methods...

	/**
    	 * Build an instance of the entity with the values set in the builder.
    	 *
    	 * @return \App\Http\Entity\CicilanEntity
    	 */
    	public function build()
    	{
    		return new \App\Http\Entity\CicilanEntity(
			$this->id,
			$this->tagihan_id,
			$this->tanggal_cicilan,
			$this->jumlah_cicilan,
			$this->bukti_cicilan,
		);
	}
}
