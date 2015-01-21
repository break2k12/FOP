<?php
namespace NIT\NitFop\Controller;


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
 * ProjektController
 */
class ProjektController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * projektRepository
	 *
	 * @var \NIT\NitFop\Domain\Repository\ProjektRepository
	 * @inject
	 */
	protected $projektRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$projekts = $this->projektRepository->findAll();
		$this->view->assign('projekts', $projekts);
	}

	/**
	 * action show
	 *
	 * @param \NIT\NitFop\Domain\Model\Projekt $projekt
	 * @return void
	 */
	public function showAction(\NIT\NitFop\Domain\Model\Projekt $projekt) {
		$this->view->assign('projekt', $projekt);
	}

	/**
	 * action new
	 *
	 * @param \NIT\NitFop\Domain\Model\Projekt $newProjekt
	 * @ignorevalidation $newProjekt
	 * @return void
	 */
	public function newAction(\NIT\NitFop\Domain\Model\Projekt $newProjekt = NULL) {
		$this->view->assign('newProjekt', $newProjekt);
	}

	/**
	 * action create
	 *
	 * @param \NIT\NitFop\Domain\Model\Projekt $newProjekt
	 * @return void
	 */
	public function createAction(\NIT\NitFop\Domain\Model\Projekt $newProjekt) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->projektRepository->add($newProjekt);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \NIT\NitFop\Domain\Model\Projekt $projekt
	 * @ignorevalidation $projekt
	 * @return void
	 */
	public function editAction(\NIT\NitFop\Domain\Model\Projekt $projekt) {
		$this->view->assign('projekt', $projekt);
	}

	/**
	 * action update
	 *
	 * @param \NIT\NitFop\Domain\Model\Projekt $projekt
	 * @return void
	 */
	public function updateAction(\NIT\NitFop\Domain\Model\Projekt $projekt) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->projektRepository->update($projekt);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \NIT\NitFop\Domain\Model\Projekt $projekt
	 * @return void
	 */
	public function deleteAction(\NIT\NitFop\Domain\Model\Projekt $projekt) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->projektRepository->remove($projekt);
		$this->redirect('list');
	}

}