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
 * Test case for class NIT\NitFop\Controller\FahrzeugController.
 *
 */
class FahrzeugControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \NIT\NitFop\Controller\FahrzeugController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('NIT\\NitFop\\Controller\\FahrzeugController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllFahrzeugsFromRepositoryAndAssignsThemToView() {

		$allFahrzeugs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$fahrzeugRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\FahrzeugRepository', array('findAll'), array(), '', FALSE);
		$fahrzeugRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFahrzeugs));
		$this->inject($this->subject, 'fahrzeugRepository', $fahrzeugRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('fahrzeugs', $allFahrzeugs);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFahrzeugToView() {
		$fahrzeug = new \NIT\NitFop\Domain\Model\Fahrzeug();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('fahrzeug', $fahrzeug);

		$this->subject->showAction($fahrzeug);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenFahrzeugToView() {
		$fahrzeug = new \NIT\NitFop\Domain\Model\Fahrzeug();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newFahrzeug', $fahrzeug);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($fahrzeug);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenFahrzeugToFahrzeugRepository() {
		$fahrzeug = new \NIT\NitFop\Domain\Model\Fahrzeug();

		$fahrzeugRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\FahrzeugRepository', array('add'), array(), '', FALSE);
		$fahrzeugRepository->expects($this->once())->method('add')->with($fahrzeug);
		$this->inject($this->subject, 'fahrzeugRepository', $fahrzeugRepository);

		$this->subject->createAction($fahrzeug);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenFahrzeugToView() {
		$fahrzeug = new \NIT\NitFop\Domain\Model\Fahrzeug();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('fahrzeug', $fahrzeug);

		$this->subject->editAction($fahrzeug);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenFahrzeugInFahrzeugRepository() {
		$fahrzeug = new \NIT\NitFop\Domain\Model\Fahrzeug();

		$fahrzeugRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\FahrzeugRepository', array('update'), array(), '', FALSE);
		$fahrzeugRepository->expects($this->once())->method('update')->with($fahrzeug);
		$this->inject($this->subject, 'fahrzeugRepository', $fahrzeugRepository);

		$this->subject->updateAction($fahrzeug);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenFahrzeugFromFahrzeugRepository() {
		$fahrzeug = new \NIT\NitFop\Domain\Model\Fahrzeug();

		$fahrzeugRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\FahrzeugRepository', array('remove'), array(), '', FALSE);
		$fahrzeugRepository->expects($this->once())->method('remove')->with($fahrzeug);
		$this->inject($this->subject, 'fahrzeugRepository', $fahrzeugRepository);

		$this->subject->deleteAction($fahrzeug);
	}
}
