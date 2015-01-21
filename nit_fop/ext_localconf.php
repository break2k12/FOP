<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'NIT.' . $_EXTKEY,
	'Nitfop',
	array(
		'Datum' => 'showWeb, show,sendAllSms, list, new, create, edit, update, delete, newRow, createRow, sendSms',
		'Zeile' => 'list, show, new, create, edit, update, delete',
		'Projekt' => 'list, show, new, create, edit, update, delete',
		'Fahrzeug' => 'list, show, new, create, edit, update, delete',
		'Fahrer' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Datum' => 'show, create, update, delete',
		'Zeile' => 'create, update, delete',
		'Projekt' => 'create, update, delete',
		'Fahrzeug' => 'create, update, delete',
		'Fahrer' => 'create, update, delete',
		
	)
);
