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
 * Test case for class NIT\NitFop\Controller\ProjektController.
 *
 */
class ProjektControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \NIT\NitFop\Controller\ProjektController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('NIT\\NitFop\\Controller\\ProjektController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllProjektsFromRepositoryAndAssignsThemToView() {

		$allProjekts = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$projektRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\ProjektRepository', array('findAll'), array(), '', FALSE);
		$projektRepository->expects($this->once())->method('findAll')->will($this->returnValue($allProjekts));
		$this->inject($this->subject, 'projektRepository', $projektRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('projekts', $allProjekts);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenProjektToView() {
		$projekt = new \NIT\NitFop\Domain\Model\Projekt();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('projekt', $projekt);

		$this->subject->showAction($projekt);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenProjektToView() {
		$projekt = new \NIT\NitFop\Domain\Model\Projekt();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newProjekt', $projekt);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($projekt);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenProjektToProjektRepository() {
		$projekt = new \NIT\NitFop\Domain\Model\Projekt();

		$projektRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\ProjektRepository', array('add'), array(), '', FALSE);
		$projektRepository->expects($this->once())->method('add')->with($projekt);
		$this->inject($this->subject, 'projektRepository', $projektRepository);

		$this->subject->createAction($projekt);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenProjektToView() {
		$projekt = new \NIT\NitFop\Domain\Model\Projekt();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('projekt', $projekt);

		$this->subject->editAction($projekt);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenProjektInProjektRepository() {
		$projekt = new \NIT\NitFop\Domain\Model\Projekt();

		$projektRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\ProjektRepository', array('update'), array(), '', FALSE);
		$projektRepository->expects($this->once())->method('update')->with($projekt);
		$this->inject($this->subject, 'projektRepository', $projektRepository);

		$this->subject->updateAction($projekt);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenProjektFromProjektRepository() {
		$projekt = new \NIT\NitFop\Domain\Model\Projekt();

		$projektRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\ProjektRepository', array('remove'), array(), '', FALSE);
		$projektRepository->expects($this->once())->method('remove')->with($projekt);
		$this->inject($this->subject, 'projektRepository', $projektRepository);

		$this->subject->deleteAction($projekt);
	}
}
