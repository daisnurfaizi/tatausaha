<?php

namespace App\Http\Builder;

class UserEntityBuilder
{
	private $name;
	private $email;
	private $password;


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

	// Other necessary methods...

	/**
    	 * Build an instance of the entity with the values set in the builder.
    	 *
    	 * @return \App\Http\Entity\UserEntity
    	 */
    	public function build()
    	{
    		return new \App\Http\Entity\UserEntity(
			$this->name,
			$this->email,
			$this->password,
		);
	}
}
