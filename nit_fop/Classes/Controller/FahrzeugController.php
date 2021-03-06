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
 * FahrzeugController
 */
class FahrzeugController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * fahrzeugRepository
	 *
	 * @var \NIT\NitFop\Domain\Repository\FahrzeugRepository
	 * @inject
	 */
	protected $fahrzeugRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$fahrzeugs = $this->fahrzeugRepository->findAll();
		$this->view->assign('fahrzeugs', $fahrzeugs);
	}

	/**
	 * action show
	 *
	 * @param \NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug
	 * @return void
	 */
	public function showAction(\NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug) {
		$this->view->assign('fahrzeug', $fahrzeug);
	}

	/**
	 * action new
	 *
	 * @param \NIT\NitFop\Domain\Model\Fahrzeug $newFahrzeug
	 * @ignorevalidation $newFahrzeug
	 * @return void
	 */
	public function newAction(\NIT\NitFop\Domain\Model\Fahrzeug $newFahrzeug = NULL) {
		$this->view->assign('newFahrzeug', $newFahrzeug);
	}

	/**
	 * action create
	 *
	 * @param \NIT\NitFop\Domain\Model\Fahrzeug $newFahrzeug
	 * @return void
	 */
	public function createAction(\NIT\NitFop\Domain\Model\Fahrzeug $newFahrzeug) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->fahrzeugRepository->add($newFahrzeug);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug
	 * @ignorevalidation $fahrzeug
	 * @return void
	 */
	public function editAction(\NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug) {
		$this->view->assign('fahrzeug', $fahrzeug);
	}

	/**
	 * action update
	 *
	 * @param \NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug
	 * @return void
	 */
	public function updateAction(\NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->fahrzeugRepository->update($fahrzeug);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug
	 * @return void
	 */
	public function deleteAction(\NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->fahrzeugRepository->remove($fahrzeug);
		$this->redirect('list');
	}

}