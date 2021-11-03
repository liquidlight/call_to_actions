<?php

namespace LiquidLight\CallToActions\Userfunc;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Backend\Utility\BackendUtility;

class Tca implements SingletonInterface
{
	public function getCallToActionLabel(&$parameters, $parentObject)
	{
		$type = $parameters['row']['type'] ?? false;
		$type = ucfirst(is_array($type) ? $type[0] : $type);

		$theme = $parameters['row']['theme'] ?? false;
		$theme = ucfirst(is_array($theme) ? $theme[0] : $theme);

		$parameters['title'] = $parameters['row']['label'];
		$meta = $type . ($type && $theme ? ' - ' : '') . $theme;

		$parameters['title'] .= (trim($meta) ? ' [' . $meta . ']' : '');
	}
}
