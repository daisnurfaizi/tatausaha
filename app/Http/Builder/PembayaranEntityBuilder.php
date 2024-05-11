<?php

namespace App\Http\Builder;

class PembayaranEntityBuilder
{
	private $id;
	private $tagihan_id;
	private $tanggal_pembayaran;
	private $metode_pembayaran;
	private $jumlah_pembayaran;
	private $sisa_tagihan;
	private $bukti_pembayaran;
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
	 * Set the tanggal_pembayaran.
	 *
	 * @param mixed $tanggal_pembayaran
	 * @return $this
	 */
	public function setTanggalPembayaran($tanggal_pembayaran)
	{
		$this->tanggal_pembayaran = $tanggal_pembayaran;
		return $this;
	}


	/**
	 * Set the metode_pembayaran.
	 *
	 * @param mixed $metode_pembayaran
	 * @return $this
	 */
	public function setMetodePembayaran($metode_pembayaran)
	{
		$this->metode_pembayaran = $metode_pembayaran;
		return $this;
	}


	/**
	 * Set the jumlah_pembayaran.
	 *
	 * @param mixed $jumlah_pembayaran
	 * @return $this
	 */
	public function setJumlahPembayaran($jumlah_pembayaran)
	{
		$this->jumlah_pembayaran = $jumlah_pembayaran;
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
	 * Set the bukti_pembayaran.
	 *
	 * @param mixed $bukti_pembayaran
	 * @return $this
	 */
	public function setBuktiPembayaran($bukti_pembayaran)
	{
		$this->bukti_pembayaran = $bukti_pembayaran;
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
    	 * @return \App\Http\Entity\PembayaranEntity
    	 */
    	public function build()
    	{
    		return new \App\Http\Entity\PembayaranEntity(
			$this->id,
			$this->tagihan_id,
			$this->tanggal_pembayaran,
			$this->metode_pembayaran,
			$this->jumlah_pembayaran,
			$this->sisa_tagihan,
			$this->bukti_pembayaran,
			$this->keterangan,
		);
	}
}
