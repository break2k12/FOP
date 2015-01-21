<?php
namespace NIT\NitFop\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Datum
 */
class Datum extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * datum
	 *
	 * @var string
	 */
	protected $datum = '';
	
	/**
	 * smssent
	 *
	 * @var string
	 */
	protected $smssent = '';

	/**
	 * zeile
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NIT\NitFop\Domain\Model\Zeile>
	 * @cascade remove
	 */
	protected $zeile = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->zeile = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the datum
	 *
	 * @return string $datum
	 */
	public function getDatum() {
		return $this->datum;
	}

	/**
	 * Sets the datum
	 *
	 * @param string $datum
	 * @return void
	 */
	public function setDatum($datum) {
		$this->datum = $datum;
	}
	
		/**
	 * Returns the smssent
	 *
	 * @return string $smssent
	 */
	public function getSmssent() {
		return $this->smssent;
	}

	/**
	 * Sets the smssent
	 *
	 * @param string $smssent
	 * @return void
	 */
	public function setSmssent($smssent) {
		$this->smssent = $smssent;
	}
	
	

	/**
	 * Adds a Zeile
	 *
	 * @param \NIT\NitFop\Domain\Model\Zeile $zeile
	 * @return void
	 */
	public function addZeile(\NIT\NitFop\Domain\Model\Zeile $zeile) {
		$this->zeile->attach($zeile);
	}

	/**
	 * Removes a Zeile
	 *
	 * @param \NIT\NitFop\Domain\Model\Zeile $zeileToRemove The Zeile to be removed
	 * @return void
	 */
	public function removeZeile(\NIT\NitFop\Domain\Model\Zeile $zeileToRemove) {
		$this->zeile->detach($zeileToRemove);
	}

	/**
	 * Returns the zeile
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NIT\NitFop\Domain\Model\Zeile> $zeile
	 */
	public function getZeile() {
		return $this->zeile;
	}

	/**
	 * Sets the zeile
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NIT\NitFop\Domain\Model\Zeile> $zeile
	 * @return void
	 */
	public function setZeile(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $zeile) {
		$this->zeile = $zeile;
	}

}