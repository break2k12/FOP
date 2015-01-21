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
 * Test case for class NIT\NitFop\Controller\ZeileController.
 *
 */
class ZeileControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \NIT\NitFop\Controller\ZeileController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('NIT\\NitFop\\Controller\\ZeileController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllZeilesFromRepositoryAndAssignsThemToView() {

		$allZeiles = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$zeileRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\ZeileRepository', array('findAll'), array(), '', FALSE);
		$zeileRepository->expects($this->once())->method('findAll')->will($this->returnValue($allZeiles));
		$this->inject($this->subject, 'zeileRepository', $zeileRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('zeiles', $allZeiles);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenZeileToView() {
		$zeile = new \NIT\NitFop\Domain\Model\Zeile();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('zeile', $zeile);

		$this->subject->showAction($zeile);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenZeileToView() {
		$zeile = new \NIT\NitFop\Domain\Model\Zeile();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newZeile', $zeile);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($zeile);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenZeileToZeileRepository() {
		$zeile = new \NIT\NitFop\Domain\Model\Zeile();

		$zeileRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\ZeileRepository', array('add'), array(), '', FALSE);
		$zeileRepository->expects($this->once())->method('add')->with($zeile);
		$this->inject($this->subject, 'zeileRepository', $zeileRepository);

		$this->subject->createAction($zeile);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenZeileToView() {
		$zeile = new \NIT\NitFop\Domain\Model\Zeile();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('zeile', $zeile);

		$this->subject->editAction($zeile);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenZeileInZeileRepository() {
		$zeile = new \NIT\NitFop\Domain\Model\Zeile();

		$zeileRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\ZeileRepository', array('update'), array(), '', FALSE);
		$zeileRepository->expects($this->once())->method('update')->with($zeile);
		$this->inject($this->subject, 'zeileRepository', $zeileRepository);

		$this->subject->updateAction($zeile);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenZeileFromZeileRepository() {
		$zeile = new \NIT\NitFop\Domain\Model\Zeile();

		$zeileRepository = $this->getMock('NIT\\NitFop\\Domain\\Repository\\ZeileRepository', array('remove'), array(), '', FALSE);
		$zeileRepository->expects($this->once())->method('remove')->with($zeile);
		$this->inject($this->subject, 'zeileRepository', $zeileRepository);

		$this->subject->deleteAction($zeile);
	}
}
