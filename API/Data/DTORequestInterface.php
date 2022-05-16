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

namespace Smolyan\CATAAS\API\Data;

/**
 * Interface DTORequestInterface
 * @package Smolyan\CATAAS\API\Data
 */
interface DTORequestInterface
{
    /**
     * @param string $endpoint
     * @return void
     */
    public function setEndpoint(string $endpoint): void;

    /**
     * @return string
     */
    public function getEndpoint(): string;
}
