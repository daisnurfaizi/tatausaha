<?php

namespace App\Http\Builder;

class StudentEntityBuilder
{
	private $id;
	private $name;
	private $nisn;


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

	// Other necessary methods...

	/**
    	 * Build an instance of the entity with the values set in the builder.
    	 *
    	 * @return \App\Http\Entity\StudentEntity
    	 */
    	public function build()
    	{
    		return new \App\Http\Entity\StudentEntity(
			$this->id,
			$this->name,
			$this->nisn,
		);
	}
}
