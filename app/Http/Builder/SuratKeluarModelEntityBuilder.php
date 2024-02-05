<?php

namespace App\Http\Builder;

class SuratKeluarModelEntityBuilder
{
	private $id;
	private $nomor_surat;
	private $tanggal_kirim;
	private $tujuan;
	private $perihal;
	private $keterangan;
	private $lampiran;
	private $status;


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
	 * Set the nomor_surat.
	 *
	 * @param mixed $nomor_surat
	 * @return $this
	 */
	public function setNomorSurat($nomor_surat)
	{
		$this->nomor_surat = $nomor_surat;
		return $this;
	}


	/**
	 * Set the tanggal_kirim.
	 *
	 * @param mixed $tanggal_kirim
	 * @return $this
	 */
	public function setTanggalKirim($tanggal_kirim)
	{
		$this->tanggal_kirim = $tanggal_kirim;
		return $this;
	}


	/**
	 * Set the tujuan.
	 *
	 * @param mixed $tujuan
	 * @return $this
	 */
	public function setTujuan($tujuan)
	{
		$this->tujuan = $tujuan;
		return $this;
	}


	/**
	 * Set the perihal.
	 *
	 * @param mixed $perihal
	 * @return $this
	 */
	public function setPerihal($perihal)
	{
		$this->perihal = $perihal;
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


	/**
	 * Set the lampiran.
	 *
	 * @param mixed $lampiran
	 * @return $this
	 */
	public function setLampiran($lampiran)
	{
		$this->lampiran = $lampiran;
		return $this;
	}


	/**
	 * Set the status.
	 *
	 * @param mixed $status
	 * @return $this
	 */
	public function setStatus($status)
	{
		$this->status = $status;
		return $this;
	}

	// Other necessary methods...

	/**
    	 * Build an instance of the entity with the values set in the builder.
    	 *
    	 * @return \App\Http\Entity\SuratKeluarModelEntity
    	 */
    	public function build()
    	{
    		return new \App\Http\Entity\SuratKeluarModelEntity(
			$this->id,
			$this->nomor_surat,
			$this->tanggal_kirim,
			$this->tujuan,
			$this->perihal,
			$this->keterangan,
			$this->lampiran,
			$this->status,
		);
	}
}
