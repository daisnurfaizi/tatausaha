<?php

namespace App\Http\Builder;

class PaymentEntityBuilder
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
	 * Set the nisn.
	 *
	 * @param mixed $nisn
	 * @return $this
	 */
	public function setNisn($nisn)
	{
		$this->nisn = $nisn;
		return $this;
	}


	/**
	 * Set the payment_date.
	 *
	 * @param mixed $payment_date
	 * @return $this
	 */
	public function setPaymentDate($payment_date)
	{
		$this->payment_date = $payment_date;
		return $this;
	}


	/**
	 * Set the month.
	 *
	 * @param mixed $month
	 * @return $this
	 */
	public function setMonth($month)
	{
		$this->month = $month;
		return $this;
	}


	/**
	 * Set the payment_amount.
	 *
	 * @param mixed $payment_amount
	 * @return $this
	 */
	public function setPaymentAmount($payment_amount)
	{
		$this->payment_amount = $payment_amount;
		return $this;
	}


	/**
	 * Set the payment_method.
	 *
	 * @param mixed $payment_method
	 * @return $this
	 */
	public function setPaymentMethod($payment_method)
	{
		$this->payment_method = $payment_method;
		return $this;
	}


	/**
	 * Set the note.
	 *
	 * @param mixed $note
	 * @return $this
	 */
	public function setNote($note)
	{
		$this->note = $note;
		return $this;
	}


	/**
	 * Set the payment_file.
	 *
	 * @param mixed $payment_file
	 * @return $this
	 */
	public function setPaymentFile($payment_file)
	{
		$this->payment_file = $payment_file;
		return $this;
	}


	/**
	 * Set the user.
	 *
	 * @param mixed $user
	 * @return $this
	 */
	public function setUser($user)
	{
		$this->user = $user;
		return $this;
	}

	// Other necessary methods...

	/**
    	 * Build an instance of the entity with the values set in the builder.
    	 *
    	 * @return \App\Http\Entity\PaymentEntity
    	 */
    	public function build()
    	{
    		return new \App\Http\Entity\PaymentEntity(
			$this->id,
			$this->nisn,
			$this->payment_date,
			$this->month,
			$this->payment_amount,
			$this->payment_method,
			$this->note,
			$this->payment_file,
			$this->user,
		);
	}
}
