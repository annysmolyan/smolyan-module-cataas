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

namespace Smolyan\CATAAS\Model\Http;

use Exception;
use Magento\Framework\HTTP\Client\CurlFactory;
use Smolyan\CATAAS\API\Data\DTORequestInterface;
use Smolyan\CATAAS\API\Data\DTOResponseInterface;
use Smolyan\CATAAS\API\HttpClientInterface;
use Smolyan\CATAAS\API\DTOResponseMapperInterfaceFactory;

/**
 * Class HttpClient
 * @package Smolyan\CATAAS\Model\Http
 */
class HttpClient implements HttpClientInterface
{
    protected CurlFactory $curlFactory;
    private DTOResponseMapperInterfaceFactory $responseMapperFactory;

    /**
     * @param CurlFactory $curlFactory
     * @param DTOResponseMapperInterfaceFactory $responseMapperFactory
     */
    public function __construct(
        CurlFactory $curlFactory,
        DTOResponseMapperInterfaceFactory $responseMapperFactory
    ) {
        $this->curlFactory = $curlFactory;
        $this->responseMapperFactory = $responseMapperFactory;
    }

    /**
     * FOR FUTURE CUSTOM REQUESTS CREATE MAPPER FACTORY AND RESPONSE TYPE
     * Make api call and return response
     * @param DTORequestInterface $request
     * @return DTOResponseInterface
     * @throws Exception
     */
    public function call(DTORequestInterface $request): DTOResponseInterface
    {
        $curl = $this->curlFactory->create();

        $curl->get($request->getEndpoint());
        $statusCode = (int)$curl->getStatus();

        try {
            $responseBody = json_decode($curl->getBody());
        } catch (Exception $exception) {
            $responseBody = ['message' => $curl->getBody()];
        }

        $responseMapper = $this->responseMapperFactory->create();
        return $responseMapper->map($statusCode, (array)$responseBody);
    }
}
