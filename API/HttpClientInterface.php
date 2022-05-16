<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3 (GPL 3.0)
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @category Smolyan
 * @package Smolyan_CATAAS
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3 (GPL 3.0)
 */

namespace Smolyan\CATAAS\API;

use Smolyan\CATAAS\API\Data\DTORequestInterface;
use Smolyan\CATAAS\API\Data\DTOResponseInterface;

/**
 * Interface HttpClientInterface
 * @package Smolyan\CATAAS\API
 */
interface HttpClientInterface
{
    /**
     * Make api call and return response
     * @param DTORequestInterface $request
     * @return DTOResponseInterface
     */
    public function call(DTORequestInterface $request): DTOResponseInterface;
}
