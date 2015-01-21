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
 * Zeile
 */
class Zeile extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * uhrzeit
	 *
	 * @var string
	 */
	protected $uhrzeit = '';

	/**
	 * bemerkung
	 *
	 * @var string
	 */
	protected $bemerkung = '';

	/**
	 * datum
	 *
	 * @var \NIT\NitFop\Domain\Model\Datum
	 */
	protected $datum = NULL;

	/**
	 * projekt
	 *
	 * @var \NIT\NitFop\Domain\Model\Projekt
	 */
	protected $projekt = NULL;

	/**
	 * fahrzeug
	 *
	 * @var \NIT\NitFop\Domain\Model\Fahrzeug
	 */
	protected $fahrzeug = NULL;

	/**
	 * Returns the uhrzeit
	 *
	 * @return string $uhrzeit
	 */
	public function getUhrzeit() {
		return $this->uhrzeit;
	}

	/**
	 * Sets the uhrzeit
	 *
	 * @param string $uhrzeit
	 * @return void
	 */
	public function setUhrzeit($uhrzeit) {
		$this->uhrzeit = $uhrzeit;
	}

	/**
	 * Returns the bemerkung
	 *
	 * @return string $bemerkung
	 */
	public function getBemerkung() {
		return $this->bemerkung;
	}

	/**
	 * Sets the bemerkung
	 *
	 * @param string $bemerkung
	 * @return void
	 */
	public function setBemerkung($bemerkung) {
		$this->bemerkung = $bemerkung;
	}

	/**
	 * Returns the datum
	 *
	 * @return \NIT\NitFop\Domain\Model\Datum $datum
	 */
	public function getDatum() {
		return $this->datum;
	}

	/**
	 * Sets the datum
	 *
	 * @param \NIT\NitFop\Domain\Model\Datum $datum
	 * @return void
	 */
	public function setDatum(\NIT\NitFop\Domain\Model\Datum $datum) {
		$this->datum = $datum;
	}

	/**
	 * Returns the projekt
	 *
	 * @return \NIT\NitFop\Domain\Model\Projekt $projekt
	 */
	public function getProjekt() {
		return $this->projekt;
	}

	/**
	 * Sets the projekt
	 *
	 * @param \NIT\NitFop\Domain\Model\Projekt $projekt
	 * @return void
	 */
	public function setProjekt(\NIT\NitFop\Domain\Model\Projekt $projekt) {
		$this->projekt = $projekt;
	}

	/**
	 * Returns the fahrzeug
	 *
	 * @return \NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug
	 */
	public function getFahrzeug() {
		return $this->fahrzeug;
	}

	/**
	 * Sets the fahrzeug
	 *
	 * @param \NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug
	 * @return void
	 */
	public function setFahrzeug(\NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug = NULL) {
		if ($fahrzeug){
			$this->fahrzeug = $fahrzeug;
		}
		else {
			$this->fahrzeug = 0;
			
		}
	}

}