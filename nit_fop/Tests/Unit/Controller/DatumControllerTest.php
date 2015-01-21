<?php
namespace NIT\NitFop\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 
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
 * Test case for class NIT\NitFop\Controller\DatumController.
 *
 */
class DatumControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \NIT\NitFop\Controller\DatumController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('NIT\\NitFop\\Controller\\DatumController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllDataFromRepositoryAndAssignsThemToView() {

		$allData = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$datumRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\DatumRepository', array('findAll'), array(), '', FALSE);
		$datumRepository->expects($this->once())->method('findAll')->will($this->returnValue($allData));
		$this->inject($this->subject, 'datumRepository', $datumRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('data', $allData);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenDatumToView() {
		$datum = new \NIT\NitFop\Domain\Model\Datum();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('datum', $datum);

		$this->subject->showAction($datum);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenDatumToView() {
		$datum = new \NIT\NitFop\Domain\Model\Datum();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newDatum', $datum);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($datum);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenDatumToDatumRepository() {
		$datum = new \NIT\NitFop\Domain\Model\Datum();

		$datumRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\DatumRepository', array('add'), array(), '', FALSE);
		$datumRepository->expects($this->once())->method('add')->with($datum);
		$this->inject($this->subject, 'datumRepository', $datumRepository);

		$this->subject->createAction($datum);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenDatumToView() {
		$datum = new \NIT\NitFop\Domain\Model\Datum();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('datum', $datum);

		$this->subject->editAction($datum);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenDatumInDatumRepository() {
		$datum = new \NIT\NitFop\Domain\Model\Datum();

		$datumRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\DatumRepository', array('update'), array(), '', FALSE);
		$datumRepository->expects($this->once())->method('update')->with($datum);
		$this->inject($this->subject, 'datumRepository', $datumRepository);

		$this->subject->updateAction($datum);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenDatumFromDatumRepository() {
		$datum = new \NIT\NitFop\Domain\Model\Datum();

		$datumRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\DatumRepository', array('remove'), array(), '', FALSE);
		$datumRepository->expects($this->once())->method('remove')->with($datum);
		$this->inject($this->subject, 'datumRepository', $datumRepository);

		$this->subject->deleteAction($datum);
	}
}
