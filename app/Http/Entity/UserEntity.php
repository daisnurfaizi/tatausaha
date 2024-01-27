<?php

namespace App\Http\Entity;

class UserEntity
{
	private $name;
	private $email;
	private $password;

	// Constructor
	public function __construct($name, $email, $password)
	{
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
}
