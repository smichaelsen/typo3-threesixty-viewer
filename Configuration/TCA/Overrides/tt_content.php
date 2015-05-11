<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$plugins = array(
	'360Viewer',
);

$_EXTKEY = 'threesixty_viewer';
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);

foreach($plugins as $plugin) {
	$pluginSignature = strtolower($extensionName) . '_' . strtolower($plugin);
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' . strtolower($plugin) . '.xml');
}
