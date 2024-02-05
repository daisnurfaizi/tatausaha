<?php

namespace App\Http\Builder;

class SuratMasukEntityBuilder
{
	private $id;
	private $nomor_surat;
	private $tanggal_terima;
	private $pengirim;
	private $perihal;
	private $keterangan;
	private $lampiran;


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
	 * Set the tanggal_terima.
	 *
	 * @param mixed $tanggal_terima
	 * @return $this
	 */
	public function setTanggalTerima($tanggal_terima)
	{
		$this->tanggal_terima = $tanggal_terima;
		return $this;
	}


	/**
	 * Set the pengirim.
	 *
	 * @param mixed $pengirim
	 * @return $this
	 */
	public function setPengirim($pengirim)
	{
		$this->pengirim = $pengirim;
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

	// Other necessary methods...

	/**
    	 * Build an instance of the entity with the values set in the builder.
    	 *
    	 * @return \App\Http\Entity\SuratMasukEntity
    	 */
    	public function build()
    	{
    		return new \App\Http\Entity\SuratMasukEntity(
			$this->id,
			$this->nomor_surat,
			$this->tanggal_terima,
			$this->pengirim,
			$this->perihal,
			$this->keterangan,
			$this->lampiran,
		);
	}
}
