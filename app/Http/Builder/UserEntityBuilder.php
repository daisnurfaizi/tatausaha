<?php

namespace App\Http\Builder;

class UserEntityBuilder
{
	private $id;
	private $name;
	private $email;
	private $password;
	private $photo;
	private $address;
	private $phone;


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
	 * Set the name.
	 *
	 * @param mixed $name
	 * @return $this
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}


	/**
	 * Set the email.
	 *
	 * @param mixed $email
	 * @return $this
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}


	/**
	 * Set the password.
	 *
	 * @param mixed $password
	 * @return $this
	 */
	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}


	/**
	 * Set the photo.
	 *
	 * @param mixed $photo
	 * @return $this
	 */
	public function setPhoto($photo)
	{
		$this->photo = $photo;
		return $this;
	}


	/**
	 * Set the address.
	 *
	 * @param mixed $address
	 * @return $this
	 */
	public function setAddress($address)
	{
		$this->address = $address;
		return $this;
	}


	/**
	 * Set the phone.
	 *
	 * @param mixed $phone
	 * @return $this
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;
		return $this;
	}

	// Other necessary methods...

	/**
    	 * Build an instance of the entity with the values set in the builder.
    	 *
    	 * @return \App\Http\Entity\UserEntity
    	 */
    	public function build()
    	{
    		return new \App\Http\Entity\UserEntity(
			$this->id,
			$this->name,
			$this->email,
			$this->password,
			$this->photo,
			$this->address,
			$this->phone,
		);
	}
}
