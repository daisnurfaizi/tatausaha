<?php

namespace App\Http\Entity;

class PaymentEntity
{
	private $id;
	private $nisn;
	private $payment_date;
	private $month;
	private $payment_amount;
	private $payment_method;
	private $note;
	private $payment_file;
	private $user;

	// Constructor
	public function __construct($id, $nisn, $payment_date, $month, $payment_amount, $payment_method, $note, $payment_file, $user)
	{
		$this->id = $id;
		$this->nisn = $nisn;
		$this->payment_date = $payment_date;
		$this->month = $month;
		$this->payment_amount = $payment_amount;
		$this->payment_method = $payment_method;
		$this->note = $note;
		$this->payment_file = $payment_file;
		$this->user = $user;
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
	 * Get the nisn.
	 *
	 * @return mixed
	 */
	public function getNisn()
	{
		return $this->nisn;
	}


	/**
	 * Get the payment_date.
	 *
	 * @return mixed
	 */
	public function getPaymentDate()
	{
		return $this->payment_date;
	}


	/**
	 * Get the month.
	 *
	 * @return mixed
	 */
	public function getMonth()
	{
		return $this->month;
	}


	/**
	 * Get the payment_amount.
	 *
	 * @return mixed
	 */
	public function getPaymentAmount()
	{
		return $this->payment_amount;
	}


	/**
	 * Get the payment_method.
	 *
	 * @return mixed
	 */
	public function getPaymentMethod()
	{
		return $this->payment_method;
	}


	/**
	 * Get the note.
	 *
	 * @return mixed
	 */
	public function getNote()
	{
		return $this->note;
	}


	/**
	 * Get the payment_file.
	 *
	 * @return mixed
	 */
	public function getPaymentFile()
	{
		return $this->payment_file;
	}


	/**
	 * Get the user.
	 *
	 * @return mixed
	 */
	public function getUser()
	{
		return $this->user;
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
	 * Set the nisn.
	 *
	 * @return mixed
	 */
	public function setNisn($value)
	{
		$this->nisn = $value;
	}


	/**
	 * Set the payment_date.
	 *
	 * @return mixed
	 */
	public function setPaymentDate($value)
	{
		$this->payment_date = $value;
	}


	/**
	 * Set the month.
	 *
	 * @return mixed
	 */
	public function setMonth($value)
	{
		$this->month = $value;
	}


	/**
	 * Set the payment_amount.
	 *
	 * @return mixed
	 */
	public function setPaymentAmount($value)
	{
		$this->payment_amount = $value;
	}


	/**
	 * Set the payment_method.
	 *
	 * @return mixed
	 */
	public function setPaymentMethod($value)
	{
		$this->payment_method = $value;
	}


	/**
	 * Set the note.
	 *
	 * @return mixed
	 */
	public function setNote($value)
	{
		$this->note = $value;
	}


	/**
	 * Set the payment_file.
	 *
	 * @return mixed
	 */
	public function setPaymentFile($value)
	{
		$this->payment_file = $value;
	}


	/**
	 * Set the user.
	 *
	 * @return mixed
	 */
	public function setUser($value)
	{
		$this->user = $value;
	}

	// Other necessary methods...
}
