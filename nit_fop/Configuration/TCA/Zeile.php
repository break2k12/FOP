<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_nitfop_domain_model_zeile'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_nitfop_domain_model_zeile']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, uhrzeit, bemerkung, datum, projekt, fahrzeug',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, uhrzeit, bemerkung, datum, projekt, fahrzeug, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_nitfop_domain_model_zeile',
				'foreign_table_where' => 'AND tx_nitfop_domain_model_zeile.pid=###CURRENT_PID### AND tx_nitfop_domain_model_zeile.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'uhrzeit' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:nit_fop/Resources/Private/Language/locallang_db.xlf:tx_nitfop_domain_model_zeile.uhrzeit',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bemerkung' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:nit_fop/Resources/Private/Language/locallang_db.xlf:tx_nitfop_domain_model_zeile.bemerkung',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'datum' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:nit_fop/Resources/Private/Language/locallang_db.xlf:tx_nitfop_domain_model_zeile.datum',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_nitfop_domain_model_datum',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'projekt' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:nit_fop/Resources/Private/Language/locallang_db.xlf:tx_nitfop_domain_model_zeile.projekt',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_nitfop_domain_model_projekt',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'fahrzeug' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:nit_fop/Resources/Private/Language/locallang_db.xlf:tx_nitfop_domain_model_zeile.fahrzeug',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_nitfop_domain_model_fahrzeug',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		
		'datum' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
