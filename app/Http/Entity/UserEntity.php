<?php

namespace App\Http\Entity;

class UserEntity
{
	private $id;
	private $name;
	private $email;
	private $password;
	private $photo;
	private $address;
	private $phone;

	// Constructor
	public function __construct($id, $name, $email, $password, $photo, $address, $phone)
	{
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
		$this->photo = $photo;
		$this->address = $address;
		$this->phone = $phone;
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
	 * Get the address.
	 *
	 * @return mixed
	 */
	public function getAddress()
	{
		return $this->address;
	}


	/**
	 * Get the phone.
	 *
	 * @return mixed
	 */
	public function getPhone()
	{
		return $this->phone;
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


	/**
	 * Set the address.
	 *
	 * @return mixed
	 */
	public function setAddress($value)
	{
		$this->address = $value;
	}


	/**
	 * Set the phone.
	 *
	 * @return mixed
	 */
	public function setPhone($value)
	{
		$this->phone = $value;
	}

	// Other necessary methods...
}
