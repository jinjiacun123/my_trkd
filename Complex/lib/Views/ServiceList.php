<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

/**
 * Provide a method to generate the list of the links to the samples pages.
 */
class Views_ServiceList
{
	/**
	 * Gets the formatted list of the links to the samples pages.
	 * 
	 * @param $rootDir the root directory where the samples pages reside.
	 * @return the filled unnumbered list HTML tag.
	 */
	public function getList($rootDir)
	{
		if ($this->endsWith($rootDir, DIRECTORY_SEPARATOR))
		{
			$rootDir = substr($rootDir, 0, strlen($rootDir) - 1);
		}
		$parentDir = opendir($rootDir);

		$menu = '<ul>';
		while (false !== ($parentFileName = readdir($parentDir)))
		{
			$parentFilePath = $rootDir . '/' . $parentFileName;
			if (is_dir($parentFilePath) &&
				$parentFileName != '.' && $parentFileName != '..' &&
				$this->startsWith($parentFileName, '.svn') !== true)
			{
				$menu .= '<li>' . $parentFileName;
				$childDir = opendir($parentFilePath);

				$menu .= '<ul>';
				while (false !== ($childFileName = readdir($childDir)))
				{
					if ($this->endsWith($childFileName, ".php"))
					{
						$operationName = substr($childFileName, 0, strlen($childFileName) - strlen('.php'));
						$menu .= '<li><a href="index.php?ws=' . $parentFileName . '&op=' . $operationName . '">' . $operationName . '</a>';
					}
				}
				$menu .= '</ul>';

				closedir($childDir);
				$menu .= '</li>';
			}
		}
		$menu .= '</ul>';

		closedir($parentDir);

		return $menu;
	}

	/**
	 * Checks whether the haystack string starts with needle substring. Case insensitive.
	 *
	 * @param $haystack the string to check.
	 * @param $needle the match string.
	 * @return <code>true</code> if the haystack string starts with needle substring;
	 * <code>false</code> otherwise.
	 */
	private function startsWith($haystack, $needle)
	{
		return stripos($haystack, $needle, 0) === 0;
	}

	/**
	 * Checks whether the haystack string ends with needle substring. Case insensitive.
	 *
	 * @param $haystack the string to check.
	 * @param $needle the match string.
	 * @return <code>true</code> if the haystack string ends with needle substring;
	 * <code>false</code> otherwise.
	 */
	private function endsWith($haystack, $needle)
	{
		$expectedPosition = strlen($haystack) - strlen($needle);

		return stripos($haystack, $needle, 0) === $expectedPosition;
	}
}