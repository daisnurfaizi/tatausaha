<?php

namespace App\Http\Builder;

class TagihanEntityBuilder
{
	private $id;
	private $student_id;
	private $bulan_tagihan;
	private $tahun_tagihan;
	private $jumlah_tagihan;
	private $sisa_tagihan;
	private $status_tagihan;
	private $keterangan;


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
	 * Set the student_id.
	 *
	 * @param mixed $student_id
	 * @return $this
	 */
	public function setStudentId($student_id)
	{
		$this->student_id = $student_id;
		return $this;
	}


	/**
	 * Set the bulan_tagihan.
	 *
	 * @param mixed $bulan_tagihan
	 * @return $this
	 */
	public function setBulanTagihan($bulan_tagihan)
	{
		$this->bulan_tagihan = $bulan_tagihan;
		return $this;
	}


	/**
	 * Set the tahun_tagihan.
	 *
	 * @param mixed $tahun_tagihan
	 * @return $this
	 */
	public function setTahunTagihan($tahun_tagihan)
	{
		$this->tahun_tagihan = $tahun_tagihan;
		return $this;
	}


	/**
	 * Set the jumlah_tagihan.
	 *
	 * @param mixed $jumlah_tagihan
	 * @return $this
	 */
	public function setJumlahTagihan($jumlah_tagihan)
	{
		$this->jumlah_tagihan = $jumlah_tagihan;
		return $this;
	}


	/**
	 * Set the sisa_tagihan.
	 *
	 * @param mixed $sisa_tagihan
	 * @return $this
	 */
	public function setSisaTagihan($sisa_tagihan)
	{
		$this->sisa_tagihan = $sisa_tagihan;
		return $this;
	}


	/**
	 * Set the status_tagihan.
	 *
	 * @param mixed $status_tagihan
	 * @return $this
	 */
	public function setStatusTagihan($status_tagihan)
	{
		$this->status_tagihan = $status_tagihan;
		return $this;
	}


	/**
	 * Set the keterangan.
	 *
	 * @param mixed $keterangan
	 * @return $this
	 */
	public function setKeterangan($keterangan)
	{
		$this->keterangan = $keterangan;
		return $this;
	}

	// Other necessary methods...

	/**
    	 * Build an instance of the entity with the values set in the builder.
    	 *
    	 * @return \App\Http\Entity\TagihanEntity
    	 */
    	public function build()
    	{
    		return new \App\Http\Entity\TagihanEntity(
			$this->id,
			$this->student_id,
			$this->bulan_tagihan,
			$this->tahun_tagihan,
			$this->jumlah_tagihan,
			$this->sisa_tagihan,
			$this->status_tagihan,
			$this->keterangan,
		);
	}
}
