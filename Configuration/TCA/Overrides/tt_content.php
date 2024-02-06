<?php

defined('TYPO3_MODE') or die();
call_user_func(function () {
	// Adds the content element to the "Type" dropdown
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
		'tt_content',
		'CType',
		[
			'LLL:EXT:call_to_actions/Resources/Private/Language/locallang.xlf:wizard.title',
			'call_to_actions',
			'liquidlight_call_to_actions',
		],
		'list',
		'after'
	);

	// Configure the default backend fields for the content element
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['call_to_actions'] = 'liquidlight_call_to_actions';
	$GLOBALS['TCA']['tt_content']['types']['call_to_actions'] = [
		'showitem' => '
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
				--palette--;;general,
				--palette--;;header,
				records,
			--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
				--palette--;;frames,
				--palette--;;appearanceLinks,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
				--palette--;;language,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
				--palette--;;hidden,
				--palette--;;access,
		',
	];
	$GLOBALS['TCA']['tt_content']['types']['call_to_actions']['columnsOverrides']['records']['config']['allowed'] = 'tx_calltoactions_domain_model_calltoactions';
});
