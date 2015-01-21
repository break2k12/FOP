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
 * Fahrer
 */
class Fahrer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * fahrername
	 *
	 * @var string
	 */
	protected $fahrername = '';

	/**
	 * handynummer
	 *
	 * @var string
	 */
	protected $handynummer = '';

	/**
	 * Returns the fahrername
	 *
	 * @return string $fahrername
	 */
	public function getFahrername() {
		return $this->fahrername;
	}

	/**
	 * Sets the fahrername
	 *
	 * @param string $fahrername
	 * @return void
	 */
	public function setFahrername($fahrername) {
		$this->fahrername = $fahrername;
	}

	/**
	 * Returns the handynummer
	 *
	 * @return string $handynummer
	 */
	public function getHandynummer() {
		return $this->handynummer;
	}

	/**
	 * Sets the handynummer
	 *
	 * @param string $handynummer
	 * @return void
	 */
	public function setHandynummer($handynummer) {
		$this->handynummer = $handynummer;
	}

}