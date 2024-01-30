<?php

namespace App\Http\Entity;

class UserEntity
{
	private $id;
	private $name;
	private $email;
	private $password;
	private $photo;

	// Constructor
	public function __construct($name, $email, $password, $photo, $id = null)
	{
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
		$this->photo = $photo;
		$this->id = $id;
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
	 * Get the photo.
	 *
	 * @return mixed
	 */
	public function getPhoto()
	{
		return $this->photo;
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


	/**
	 * Set the photo.
	 *
	 * @return mixed
	 */
	public function setPhoto($value)
	{
		$this->photo = $value;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($value)
	{
		$this->id = $value;
	}
	// Other necessary methods...
}
