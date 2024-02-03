<?php

namespace App\Http\Entity;

class AplicationEntity
{
	private $id;
	private $login_logo;
	private $sidebar_logo_small;
	private $sidebar_logo;
	private $title;
	private $owner;
	private $footer;

	// Constructor
	public function __construct($id, $login_logo, $sidebar_logo_small, $sidebar_logo, $title, $owner, $footer)
	{
		$this->id = $id;
		$this->login_logo = $login_logo;
		$this->sidebar_logo_small = $sidebar_logo_small;
		$this->sidebar_logo = $sidebar_logo;
		$this->title = $title;
		$this->owner = $owner;
		$this->footer = $footer;
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
	 * Get the login_logo.
	 *
	 * @return mixed
	 */
	public function getLoginLogo()
	{
		return $this->login_logo;
	}


	/**
	 * Get the sidebar_logo_small.
	 *
	 * @return mixed
	 */
	public function getSidebarLogoSmall()
	{
		return $this->sidebar_logo_small;
	}


	/**
	 * Get the sidebar_logo.
	 *
	 * @return mixed
	 */
	public function getSidebarLogo()
	{
		return $this->sidebar_logo;
	}


	/**
	 * Get the title.
	 *
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}


	/**
	 * Get the owner.
	 *
	 * @return mixed
	 */
	public function getOwner()
	{
		return $this->owner;
	}


	/**
	 * Get the footer.
	 *
	 * @return mixed
	 */
	public function getFooter()
	{
		return $this->footer;
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
	 * Set the login_logo.
	 *
	 * @return mixed
	 */
	public function setLoginLogo($value)
	{
		$this->login_logo = $value;
	}


	/**
	 * Set the sidebar_logo_small.
	 *
	 * @return mixed
	 */
	public function setSidebarLogoSmall($value)
	{
		$this->sidebar_logo_small = $value;
	}


	/**
	 * Set the sidebar_logo.
	 *
	 * @return mixed
	 */
	public function setSidebarLogo($value)
	{
		$this->sidebar_logo = $value;
	}


	/**
	 * Set the title.
	 *
	 * @return mixed
	 */
	public function setTitle($value)
	{
		$this->title = $value;
	}


	/**
	 * Set the owner.
	 *
	 * @return mixed
	 */
	public function setOwner($value)
	{
		$this->owner = $value;
	}


	/**
	 * Set the footer.
	 *
	 * @return mixed
	 */
	public function setFooter($value)
	{
		$this->footer = $value;
	}

	// Other necessary methods...
}
