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
 * Test case for class NIT\NitFop\Controller\FahrerController.
 *
 */
class FahrerControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \NIT\NitFop\Controller\FahrerController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('NIT\\NitFop\\Controller\\FahrerController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllFahrersFromRepositoryAndAssignsThemToView() {

		$allFahrers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$fahrerRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\FahrerRepository', array('findAll'), array(), '', FALSE);
		$fahrerRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFahrers));
		$this->inject($this->subject, 'fahrerRepository', $fahrerRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('fahrers', $allFahrers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFahrerToView() {
		$fahrer = new \NIT\NitFop\Domain\Model\Fahrer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('fahrer', $fahrer);

		$this->subject->showAction($fahrer);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenFahrerToView() {
		$fahrer = new \NIT\NitFop\Domain\Model\Fahrer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newFahrer', $fahrer);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($fahrer);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenFahrerToFahrerRepository() {
		$fahrer = new \NIT\NitFop\Domain\Model\Fahrer();

		$fahrerRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\FahrerRepository', array('add'), array(), '', FALSE);
		$fahrerRepository->expects($this->once())->method('add')->with($fahrer);
		$this->inject($this->subject, 'fahrerRepository', $fahrerRepository);

		$this->subject->createAction($fahrer);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenFahrerToView() {
		$fahrer = new \NIT\NitFop\Domain\Model\Fahrer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('fahrer', $fahrer);

		$this->subject->editAction($fahrer);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenFahrerInFahrerRepository() {
		$fahrer = new \NIT\NitFop\Domain\Model\Fahrer();

		$fahrerRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\FahrerRepository', array('update'), array(), '', FALSE);
		$fahrerRepository->expects($this->once())->method('update')->with($fahrer);
		$this->inject($this->subject, 'fahrerRepository', $fahrerRepository);

		$this->subject->updateAction($fahrer);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenFahrerFromFahrerRepository() {
		$fahrer = new \NIT\NitFop\Domain\Model\Fahrer();

		$fahrerRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\FahrerRepository', array('remove'), array(), '', FALSE);
		$fahrerRepository->expects($this->once())->method('remove')->with($fahrer);
		$this->inject($this->subject, 'fahrerRepository', $fahrerRepository);

		$this->subject->deleteAction($fahrer);
	}
}
