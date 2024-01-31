<?php

namespace App\Http\Entity;

class StudentEntity
{
	private $id;
	private $name;
	private $nisn;

	// Constructor
	public function __construct($id, $name, $nisn)
	{
		$this->id = $id;
		$this->name = $name;
		$this->nisn = $nisn;
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
	 * Get the name.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
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
	 * Set the id.
	 *
	 * @return mixed
	 */
	public function setId($value)
	{
		$this->id = $value;
	}


	/**
	 * Set the name.
	 *
	 * @return mixed
	 */
	public function setName($value)
	{
		$this->name = $value;
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

	// Other necessary methods...
}
