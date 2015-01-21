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
 * Test case for class \NIT\NitFop\Domain\Model\Datum.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class DatumTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \NIT\NitFop\Domain\Model\Datum
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \NIT\NitFop\Domain\Model\Datum();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getDatumReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDatum()
		);
	}

	/**
	 * @test
	 */
	public function setDatumForStringSetsDatum() {
		$this->subject->setDatum('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'datum',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZeileReturnsInitialValueForZeile() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getZeile()
		);
	}

	/**
	 * @test
	 */
	public function setZeileForObjectStorageContainingZeileSetsZeile() {
		$zeile = new \NIT\NitFop\Domain\Model\Zeile();
		$objectStorageHoldingExactlyOneZeile = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneZeile->attach($zeile);
		$this->subject->setZeile($objectStorageHoldingExactlyOneZeile);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneZeile,
			'zeile',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addZeileToObjectStorageHoldingZeile() {
		$zeile = new \NIT\NitFop\Domain\Model\Zeile();
		$zeileObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$zeileObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($zeile));
		$this->inject($this->subject, 'zeile', $zeileObjectStorageMock);

		$this->subject->addZeile($zeile);
	}

	/**
	 * @test
	 */
	public function removeZeileFromObjectStorageHoldingZeile() {
		$zeile = new \NIT\NitFop\Domain\Model\Zeile();
		$zeileObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$zeileObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($zeile));
		$this->inject($this->subject, 'zeile', $zeileObjectStorageMock);

		$this->subject->removeZeile($zeile);

	}
}
