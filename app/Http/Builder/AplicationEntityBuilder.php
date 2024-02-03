<?php

namespace App\Http\Builder;

class AplicationEntityBuilder
{
	private $id;
	private $login_logo;
	private $sidebar_logo_small;
	private $sidebar_logo;
	private $title;
	private $owner;
	private $footer;


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
	 * Set the login_logo.
	 *
	 * @param mixed $login_logo
	 * @return $this
	 */
	public function setLoginLogo($login_logo)
	{
		$this->login_logo = $login_logo;
		return $this;
	}


	/**
	 * Set the sidebar_logo_small.
	 *
	 * @param mixed $sidebar_logo_small
	 * @return $this
	 */
	public function setSidebarLogoSmall($sidebar_logo_small)
	{
		$this->sidebar_logo_small = $sidebar_logo_small;
		return $this;
	}


	/**
	 * Set the sidebar_logo.
	 *
	 * @param mixed $sidebar_logo
	 * @return $this
	 */
	public function setSidebarLogo($sidebar_logo)
	{
		$this->sidebar_logo = $sidebar_logo;
		return $this;
	}


	/**
	 * Set the title.
	 *
	 * @param mixed $title
	 * @return $this
	 */
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}


	/**
	 * Set the owner.
	 *
	 * @param mixed $owner
	 * @return $this
	 */
	public function setOwner($owner)
	{
		$this->owner = $owner;
		return $this;
	}


	/**
	 * Set the footer.
	 *
	 * @param mixed $footer
	 * @return $this
	 */
	public function setFooter($footer)
	{
		$this->footer = $footer;
		return $this;
	}

	// Other necessary methods...

	/**
    	 * Build an instance of the entity with the values set in the builder.
    	 *
    	 * @return \App\Http\Entity\AplicationEntity
    	 */
    	public function build()
    	{
    		return new \App\Http\Entity\AplicationEntity(
			$this->id,
			$this->login_logo,
			$this->sidebar_logo_small,
			$this->sidebar_logo,
			$this->title,
			$this->owner,
			$this->footer,
		);
	}
}
