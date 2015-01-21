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
 * DatumController
 */
class DatumController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	
		/** @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	*/
	protected $configurationManager;
	
	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
	 * @inject
	 */
	protected $persistenceManager;

	/**
	 * datumRepository
	 *
	 * @var \NIT\NitFop\Domain\Repository\DatumRepository
	 * @inject
	 */
	protected $datumRepository = NULL;
	
	/**
	 * fahrzeugRepository
	 *
	 * @var \NIT\NitFop\Domain\Repository\FahrzeugRepository
	 * @inject
	 */
	protected $fahrzeugRepository = NULL;
	
	/**
	 * fahrerRepository
	 *
	 * @var \NIT\NitFop\Domain\Repository\FahrerRepository
	 * @inject
	 */
	protected $fahrerRepository = NULL;
	
	/**
	 * projektRepository
	 *
	 * @var \NIT\NitFop\Domain\Repository\ProjektRepository
	 * @inject
	 */
	protected $projektRepository = NULL;

	/**
	 * zeileRepository
	 *
	 * @var \NIT\NitFop\Domain\Repository\ZeileRepository
	 * @inject
	 */
	protected $zeileRepository = NULL;


	
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$data = $this->datumRepository->findAll();
		$this->view->assign('data', $data);
	}

	/**
	 * action show
	 *
	 * @return void
	 */
	public function showAction() {
		$this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="typo3conf/ext/nit_fop/Resources/Public/CSS/fop.css" />');

		if ($this->request->hasArgument('datefield')) {
			$heute = $this->request->getArgument('datefield');
		}
		else {
			$heute = date("d.m.Y");
			$heute = date("d.m.Y",strtotime('+1 day', strtotime($heute)));
		}
		
		
		
		$gestern = date("d.m.Y",strtotime('-1 day', strtotime($heute)));
		$morgen = date("d.m.Y",strtotime('+1 day', strtotime($heute)));
		
		
		$datum = $this->datumRepository->findOneByDatum($heute);
		if (!$datum) {
			$datum = $this->objectManager->get('NIT\\NitFop\\Domain\\Model\\Datum');
			$datum->setDatum($heute);
			$this->datumRepository->add($datum);
			$this->persistenceManager->persistAll();
		}
		
		$zeilen = $this->zeileRepository->findByDatum($datum);
		
	

		$this->view->assign('datum', $datum);
		$this->view->assign('gestern', $gestern);
		$this->view->assign('morgen', $morgen);
		$this->view->assign('heute', $heute);
		$this->view->assign('zeilen', $zeilen);
		
	}
	
	
	/**
	 * action showWeb
	 *
	 * @return void
	 */
	public function showWebAction() {
		$this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="typo3conf/ext/nit_fop/Resources/Public/CSS/fop_web.css" />');
  
		if ($this->request->hasArgument('admin')) {
			
			$admin = $this->request->getArgument('admin');
			if ($admin == '1'){
				$this->redirect('show');
				

			}
		}
		$this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="typo3conf/ext/nit_fop/Resources/Public/CSS/fop_web.css" />');
  
		if ($this->request->hasArgument('datefield')) {
			$heute = $this->request->getArgument('datefield');
		}
		else {
			$heute = date("d.m.Y");
			//$heute = date("d.m.Y",strtotime('+1 day', strtotime($heute)));
		}
		
		
		
		//$gestern = date("d.m.Y",strtotime('-1 day', strtotime($heute)));
		$morgen = date("d.m.Y",strtotime('+1 day', strtotime($heute)));
		
		
		$datumheute = $this->datumRepository->findOneByDatum($heute);
		$zeilenheute = $this->zeileRepository->findByDatum($datumheute);
		$datummorgen = $this->datumRepository->findOneByDatum($morgen);
		$zeilenmorgen = $this->zeileRepository->findByDatum($datummorgen);
		
	


		$this->view->assign('zeilenheute', $zeilenheute);
		$this->view->assign('zeilenmorgen', $zeilenmorgen);
		$this->view->assign('datumheute', $heute);
		$this->view->assign('datummorgen', $morgen);
	}
	
	
	

	/**
	 * action new
	 *
	 * @param \NIT\NitFop\Domain\Model\Datum $newDatum
	 * @ignorevalidation $newDatum
	 * @return void
	 */
	public function newAction(\NIT\NitFop\Domain\Model\Datum $newDatum = NULL) {
		$this->view->assign('newDatum', $newDatum);
	}

	
	/**
	 * action sendAllSms
	 *
	 *
	 *
	 * @return void
	 */
	public function sendAllSmsAction(\NIT\NitFop\Domain\Model\Datum $datum) {
		
		$recipients = $this->zeileRepository->findByDatum($datum);
		//$content = $mode .':'.$tag . '-'.$uhrzeit . " Projekt: ". $projektname . ' Kommentar: ' .$kommentar;
		foreach($recipients as $recipient) {
			$content = $recipient->getDatum()->getDatum() . ' '.$recipient->getUhrzeit() . ' Projekt: '.$recipient->getProjekt()->getProjektname().' Kommentar:'.$recipient->getBemerkung() ;
			mail('stange@pronetic.de', 'SMS Versand durch  Transporte',$content);
			
			
		}
		//$upd = $this->objectManager->get($datum);
		
		$datum->setSmssent('1');
		$this->datumRepository->update($datum);
		$this->persistenceManager->persistAll();
		
		/*
		mail('test@test.de', 'SMS Versand durch Transporte',$content);
		
		$user = urlencode("");
		$password = urlencode("");
		
		$bericht  = "0";
		$save = true;
		$text = substr(urlencode($content), 0, 160);
		$url = "";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$buffer = trim(curl_exec($ch));
		curl_close($ch);
		//$error = "Alles OK";
		if($buffer == "001") $error = "Authentifizierungsfehler (Benutzername oder Passwort falsch)";
		if($buffer == "002") $error = "Fehlende Parameter";
		if($buffer == "003") $error = "Route unterstützt Feature nicht (z.B. SMS-Absender bei Route 2)";
		if($buffer == "004") $error = "Schnittstelle aktuell deaktiviert - Über Einstellungen aktivieren";
		if($buffer == "005") $error = "Versandroute aktuell nicht verfügbar";
		if($buffer == "006") $error = "Zugriff verweigert (nicht erlaubte IP-Adresse)";
		if($buffer == "007") $error = "Benutzerdefiniertes Kostenlimit erreicht";
		if($buffer == "008") $error = "Ihr Kreditlimit ist 0";
		if($buffer == "009") $error = "Nicht erlaubte Absenderkennung";
		if($buffer == "010") $error = "Account gesperrt";
		if($error == "") $error = $buffer;
		$error = urlencode($error);
		*/
		//$this->view->assign('recipients', $recipients);
		
		
		$this->redirect('show');
		
	}
	
	/**
	 * action sendSms
	 *

	 * @return void
	 */
	public function sendSmsAction() {
		
		
		$mode = $this->request->getArgument('modus');
		$fahrzeug = $this->fahrzeugRepository->findOneByFahrzeugname($this->request->getArgument('fahrzeug'));
		$fahrer = $fahrzeug->getFahrer();
		$nummer = urlencode($fahrer->getHandynummer());
		$projektname = $this->request->getArgument('projektname');
		$tag = $this->request->getArgument('datum');
		$datum = $this->datumRepository->findOneByDatum($tag);
		$kommentar = $this->request->getArgument('kommentar');
		$uhrzeit = $this->request->getArgument('uhrzeit');
		$content = $mode .':'.$tag . '-'.$uhrzeit . " Projekt: ". $projektname . ' Kommentar: ' .$kommentar;
		mail('.de', 'SMS Versand durch  Transporte',$content);
		
		$user = urlencode("");
		$password = urlencode("");
		
		$bericht  = "0";
		$save = true;
		$text = substr(urlencode($content), 0, 160);
		$url = "";
		/*
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$buffer = trim(curl_exec($ch));
		curl_close($ch);
		*/
//$error = "Alles OK";
		if($buffer == "001") $error = "Authentifizierungsfehler (Benutzername oder Passwort falsch)";
		if($buffer == "002") $error = "Fehlende Parameter";
		if($buffer == "003") $error = "Route unterstützt Feature nicht (z.B. SMS-Absender bei Route 2)";
		if($buffer == "004") $error = "Schnittstelle aktuell deaktiviert - Über Einstellungen aktivieren";
		if($buffer == "005") $error = "Versandroute aktuell nicht verfügbar";
		if($buffer == "006") $error = "Zugriff verweigert (nicht erlaubte IP-Adresse)";
		if($buffer == "007") $error = "Benutzerdefiniertes Kostenlimit erreicht";
		if($buffer == "008") $error = "Ihr Kreditlimit ist 0";
		if($buffer == "009") $error = "Nicht erlaubte Absenderkennung";
		if($buffer == "010") $error = "Account gesperrt";
		if($error == "") $error = $buffer;
		$error = urlencode($error);
		
		$this->view->assign('fahrzeug',$error);

	}
	
	
	/**
	 * action newRow
	 *
	 * @param \NIT\NitFop\Domain\Model\Datum $datum
	 * @ignorevalidation $datum
	 * @return void
	 */
	public function newRowAction(\NIT\NitFop\Domain\Model\Datum $datum) {
		
		
		
		$fahrzeuge = $this->fahrzeugRepository->getNonBookedCars($datum->getUid());
		$projekte = $this->projektRepository->findAll();
		$this->view->assign('fahrzeuge', $fahrzeuge);
		$this->view->assign('projekte', $projekte);
		
		$this->view->assign('datum', $datum);
		
	}
	
	

	/**
	 * action create
	 *
	 * @param \NIT\NitFop\Domain\Model\Datum $newDatum
	 * @return void
	 */
	public function createAction(\NIT\NitFop\Domain\Model\Datum $newDatum) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->datumRepository->add($newDatum);
		$this->redirect('list');
	}
	
	/**
	 * action createRow
	 *
	 * @param \NIT\NitFop\Domain\Model\Datum $datum
	 * @param \NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug
	 * @return void
	 */
	public function createRowAction(\NIT\NitFop\Domain\Model\Datum $datum, \NIT\NitFop\Domain\Model\Fahrzeug $fahrzeug = NULL) {
		
		$projektname = $this->request->getArgument('projektname');
		$projekt = $this->projektRepository->findOneByProjektname($projektname);
		if (!$projekt){
			$projekt = $this->objectManager->get('NIT\\NitFop\\Domain\\Model\\Projekt');
			$projekt->setProjektname($this->request->getArgument('projektname'));
			$this->projektRepository->add($projekt);
		}
		
		$zeile = $this->objectManager->get('NIT\\NitFop\\Domain\\Model\\Zeile');
		If (!$fahrzeug){
			
			
		}
		else {
			$zeile->setFahrzeug($fahrzeug);
		}
		
		$zeile->setUhrzeit($this->request->getArgument('uhrzeit'));
		$zeile->setProjekt($projekt);
		$zeile->setBemerkung($this->request->getArgument('kommentar'));
		$this->zeileRepository->add($zeile);
		$datum->addZeile($zeile);
		$this->datumRepository->update($datum);
		$this->persistenceManager->persistAll();
		$arguments = array (
			'datefield' => $datum->getDatum(),
		);
		$this->redirect('show', $controlleName, $extensionName,$arguments);
	}
	

	/**
	 * action edit
	 *
	 * @param \NIT\NitFop\Domain\Model\Zeile $zeile
	 * @ignorevalidation $zeile
	 * @return void
	 */
	public function editAction(\NIT\NitFop\Domain\Model\Zeile $zeile) {
		if ($zeile->getFahrzeug()){
			$fahrzeug = $this->fahrzeugRepository->findByFahrzeugname($zeile->getFahrzeug());
		}
		$fahrzeuge = $this->fahrzeugRepository->getNonBookedCars($zeile->getDatum()->getUid());
		$projekte = $this->projektRepository->findAll();
		$datum = $zeile->getDatum();
		$this->view->assign('fahrzeuge', $fahrzeuge);
		$this->view->assign('datum', $datum);
		$this->view->assign('projekte', $projekte);
		$this->view->assign('zeile', $zeile);
	}


	
	
	/**
	 * action updateRow
	 *
	 * @param \NIT\NitFop\Domain\Model\Zeile $zeile
	 * @return void
	 */
	public function updateAction(\NIT\NitFop\Domain\Model\Zeile $zeile) {
		$projektname = $this->request->getArgument('projektname');
		$projekt = $this->projektRepository->findOneByProjektname($projektname);
		if (!$projekt){
			$projekt = $this->objectManager->get('NIT\\NitFop\\Domain\\Model\\Projekt');
			$projekt->setProjektname($this->request->getArgument('projektname'));
			$this->projektRepository->add($projekt);
		}
		
		if ($this->request->hasArgument('fahrzeug') ) {
			if ($this->request->getArgument('fahrzeug') != "-"){
				//$this->redirect('show');
				$kfz = $this->request->getArgument('fahrzeug');
				$fahrzeug = $this->fahrzeugRepository->findOneByUid($kfz);
				$zeile->setFahrzeug($fahrzeug);
			}
			else {
				$zeile->setFahrzeug();
				//$zeile->
				
			}
		}
		

		
		$zeile->setUhrzeit($this->request->getArgument('uhrzeit'));
		$zeile->setProjekt($projekt);
		$zeile->setBemerkung($this->request->getArgument('kommentar'));
		$this->zeileRepository->update($zeile);
		$this->persistenceManager->persistAll();
		$datum = $zeile->getDatum();
		$arguments = array (
			'datefield' => $datum->getDatum(),
		);
		$this->redirect('show', $controlleName, $extensionName,$arguments);
	}

	/**
	 * action delete
	 *
	 * @param \NIT\NitFop\Domain\Model\Zeile $zeile
	 * @return void
	 */
	public function deleteAction(\NIT\NitFop\Domain\Model\Zeile $zeile) {
		$datum = $zeile->getDatum();
		$arguments = array (
			'datefield' => $datum->getDatum(),
		);
		//$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->zeileRepository->remove($zeile);

		$this->redirect('show', $controlleName, $extensionName,$arguments);
	}

}