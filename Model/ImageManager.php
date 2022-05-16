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

namespace Smolyan\CATAAS\Model;

use Smolyan\CATAAS\API\ApiManagerInterface;
use Smolyan\CATAAS\API\ImageManagerInterface;
use Smolyan\CATAAS\API\Data\ImageInterface;
use Smolyan\CATAAS\API\ImageMapperInterface;
use Smolyan\CATAAS\Helper\ConfigHelper;

/**
 * Class ImageManager
 * @package Smolyan\CATAAS\Model
 */
class ImageManager implements ImageManagerInterface
{
    private ApiManagerInterface $apiManager;
    private ImageMapperInterface $imageMapper;
    private ConfigHelper $configHelper;

    /**
     * @param ApiManagerInterface $apiManager
     * @param ImageMapperInterface $imageMapper
     * @param ConfigHelper $configHelper
     */
    public function __construct(
        ApiManagerInterface  $apiManager,
        ImageMapperInterface $imageMapper,
        ConfigHelper $configHelper
    ) {
        $this->apiManager = $apiManager;
        $this->imageMapper = $imageMapper;
        $this->configHelper = $configHelper;
    }

    /**
     * Magento will cache image by direct url on front side,
     * That's why need to execute behind the scene curl request and get unique
     * image path. It lets us show different images for products without disabling product cache
     * @return ImageInterface
     */
    public function getImageWithText(): ImageInterface
    {
        $response = $this->apiManager->callImage();
        $imageObject = $this->imageMapper->map($response);

        if ($imgUrl = $imageObject->getUrl()) {
            $imgUrl .= "/says/" . $this->configHelper->getCatText();
            $imageObject->setUrl($imgUrl);
        }

        return $imageObject;
    }
}
