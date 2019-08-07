<?php

namespace hotelbeds\hotel_api_sdk\messages;

use Zend\Http\Request;
use hotelbeds\hotel_api_sdk\types\ApiUri;

/**
 * @package hotelbeds\hotel_api_sdk\messages
 */
class BookingDetailRQ extends ApiRequest
{
    /**
     * BookingConfirmRQ constructor.
     *
     * @param ApiUri $baseUri Base uri when the request does not include payment data
     * @param string $bookingId
     */
    public function __construct(ApiUri $baseUri, $bookingId)
    {
        parent::__construct($baseUri, self::BOOKING);
        $this->request->setMethod(Request::METHOD_GET);
        $this->baseUri->setPath($baseUri->getPath() . "/" . self::BOOKING . "/$bookingId");
    }
}
