<?php
/**
 * Created by PhpStorm.
 * User: Tomeu
 * Date: 10/27/2015
 * Time: 3:13 AM
 */

namespace hotelbeds\hotel_api_sdk\messages;

use hotelbeds\hotel_api_sdk\helpers\ApiHelper;
use hotelbeds\hotel_api_sdk\types\ApiUri;
use Zend\Http\Request;
use Zend\Uri\Http;
use Zend\Stdlib\Parameters;
use hotelbeds\hotel_api_sdk\types\HotelSDKException;

/**
 * Class ApiRequest This is abstract request class define how prepare final HTTP Request
 * @package hotelbeds\hotel_api_sdk\messages
 */
abstract class ApiRequest implements ApiCallTypes
{
    /**
     * @var Request Contains a http request
     */
    protected $request;

    /**
     * @var Http Contains final URL with endpoint and extra parameters if is needed
     */
    protected $baseUri;

    /**
     * @var ApiUri Contains well formatted URI of call
     */
    private $dataRQ;

    /**
     * ApiRequest constructor.
     * @param ApiUri $baseUri Base URI of service
     * @param string $operation Endpoint name of operation
     */
    public function __construct(ApiUri $baseUri, $operation)
    {
        $this->request = new Request();
        $this->baseUri = new Http($baseUri);
        $this->baseUri->setPath($baseUri->getPath()."/".$operation);
    }

    /**
     * @param ApiHelper $dataRQ Set data request to request
     */
    protected function setDataRequest(ApiHelper $dataRQ)
    {
        $this->dataRQ = $dataRQ;
    }

    /**
     * @param string $apiKey    API Key of client
     * @param string $signature Computed signature for made this call
     *
     * @return Request Return well constructed HTTP Request
     * @throws HotelSDKException
     */
    public function prepare($apiKey, $signature)
    {
        if (empty($apiKey) || empty($signature))
            throw new \InvalidArgumentException("HotelApiClient cannot be created without specifying an API key and signature");

        $this->request->setUri($this->baseUri);
        $this->request->getHeaders()->addHeaders([
            'Api-Key' => $apiKey,
            'X-Signature' => $signature,
            'Accept' => 'application/json',
            'Accept-Charset' => 'utf-8',
            'Accept-Encoding' => 'gzip, deflate',
            'User-Agent' => 'hotel-api-sdk-php'
        ]);

        if (!empty($this->dataRQ)) {
            switch($this->request->getMethod()) {
                case Request::METHOD_GET:
                    $this->request->setQuery(new Parameters($this->dataRQ->toArray()));
                    break;

                case Request::METHOD_POST:
                case Request::METHOD_PUT:
                    $this->request->getHeaders()->addHeaders(['Content-Type' => 'application/json']);
                    $this->request->setContent("".$this->dataRQ);
                    break;

                default:
                    throw new HotelSDKException(
                        \sprintf('Request method "%s" is not supported!', $this->request->getMethod())
                    );
            }
        }

        return $this->request;
    }
}
