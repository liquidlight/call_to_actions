<?php

/**
 * Class 'CallToActionsElementPreviewRenderer' for the 'call_to_actions' extension.
 *
 * @author Mike Street <mike@liquidlight.co.uk>
 * @copyright Liquid Light Ltd.
 * @package TYPO3
 * @subpackage call_to_actions
 */

namespace LiquidLight\CallToActions\Hooks\PageLayoutView;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * Contains a preview rendering for the page module of CType="text"
 * @internal this is a concrete TYPO3 hook implementation and solely used for EXT:frontend and not part of TYPO3's Core API.
 */
class CallToActionsElementPreviewRenderer implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface
{
	/**
	 * TYPO3 Content Hook
	 *
	 * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
	 * @param bool $drawItem Whether to draw the item using the default functionalities
	 * @param string $headerContent Header content
	 * @param string $itemContent Item content
	 * @param array $row Record row of tt_content
	 */
	public function preProcess(
		\TYPO3\CMS\Backend\View\PageLayoutView &$parentObject,
		&$drawItem,
		&$headerContent,
		&$itemContent,
		array &$row
	) {
		// Is this a catalog plugin?
		if ($this->isCTAPlugin($row)) {
			// Prevent default rendering
			$content = $this->generatePreview($parentObject, $row);

			if ($content) {
				$drawItem = false;
				$headerContent = '<strong>Promo</strong><br>';
				$itemContent = $parentObject->linkEditContent($content, $row);
			}
		}
	}

	/**
	 * Are we dealing with a catalog plugin?
	 *
	 * @param array $row
	 * @return bool
	 * @access protected
	 */
	protected function isCTAPlugin($row)
	{
		return $row['CType'] === 'list' && $row['list_type'] === 'promos_pi';
	}

	protected function generatePreview($parentObject, $row)
	{
		$content = false;

		$flexFormData = GeneralUtility::makeInstance(FlexFormService::class)
			->convertFlexFormContentToArray($row['pi_flexform'])
		;

		if (is_array($flexFormData)) {
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
				->getQueryBuilderForTable('tx_promos')
			;
			$expr = $queryBuilder->expr();

			$promo = $queryBuilder
				->select('uid', 'label')
				->from('tx_promos')
				->where(
					$queryBuilder->expr()->in('uid', $queryBuilder->createNamedParameter($flexFormData['promos']))
				)
				->execute()
				->fetch()
			;

			if ($promo) {
				$content = $promo['label'];
			}
		}

		// Return the preview content
		return $content;
	}
}
