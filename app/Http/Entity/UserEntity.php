<?php

namespace App\Http\Entity;

class UserEntity
{
	private $id;
	private $name;
	private $email;
	private $password;

	// Constructor
	public function __construct($id, $name, $email, $password)
	{
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
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
	 * Get the email.
	 *
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}


	/**
	 * Get the password.
	 *
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
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
	 * Set the email.
	 *
	 * @return mixed
	 */
	public function setEmail($value)
	{
		$this->email = $value;
	}


	/**
	 * Set the password.
	 *
	 * @return mixed
	 */
	public function setPassword($value)
	{
		$this->password = $value;
	}

	// Other necessary methods...

	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}
}
