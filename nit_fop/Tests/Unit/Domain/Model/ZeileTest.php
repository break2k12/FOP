<?php

namespace NIT\NitFop\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \NIT\NitFop\Domain\Model\Zeile.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ZeileTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \NIT\NitFop\Domain\Model\Zeile
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \NIT\NitFop\Domain\Model\Zeile();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getUhrzeitReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getUhrzeit()
		);
	}

	/**
	 * @test
	 */
	public function setUhrzeitForStringSetsUhrzeit() {
		$this->subject->setUhrzeit('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'uhrzeit',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBemerkungReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getBemerkung()
		);
	}

	/**
	 * @test
	 */
	public function setBemerkungForStringSetsBemerkung() {
		$this->subject->setBemerkung('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'bemerkung',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDatumReturnsInitialValueForDatum() {
		$this->assertEquals(
			NULL,
			$this->subject->getDatum()
		);
	}

	/**
	 * @test
	 */
	public function setDatumForDatumSetsDatum() {
		$datumFixture = new \NIT\NitFop\Domain\Model\Datum();
		$this->subject->setDatum($datumFixture);

		$this->assertAttributeEquals(
			$datumFixture,
			'datum',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProjektReturnsInitialValueForProjekt() {
		$this->assertEquals(
			NULL,
			$this->subject->getProjekt()
		);
	}

	/**
	 * @test
	 */
	public function setProjektForProjektSetsProjekt() {
		$projektFixture = new \NIT\NitFop\Domain\Model\Projekt();
		$this->subject->setProjekt($projektFixture);

		$this->assertAttributeEquals(
			$projektFixture,
			'projekt',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFahrzeugReturnsInitialValueForFahrzeug() {
		$this->assertEquals(
			NULL,
			$this->subject->getFahrzeug()
		);
	}

	/**
	 * @test
	 */
	public function setFahrzeugForFahrzeugSetsFahrzeug() {
		$fahrzeugFixture = new \NIT\NitFop\Domain\Model\Fahrzeug();
		$this->subject->setFahrzeug($fahrzeugFixture);

		$this->assertAttributeEquals(
			$fahrzeugFixture,
			'fahrzeug',
			$this->subject
		);
	}
}
