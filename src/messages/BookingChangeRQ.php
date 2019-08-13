<?php

namespace hotelbeds\hotel_api_sdk\messages;

use Zend\Http\Request;
use hotelbeds\hotel_api_sdk\types\ApiUri;
use hotelbeds\hotel_api_sdk\helpers\BookingChange;

/**
 * @package hotelbeds\hotel_api_sdk\messages
 */
class BookingChangeRQ extends ApiRequest
{
    /**
     * BookingConfirmRQ constructor.
     *
     * @param ApiUri        $baseUri Base uri when the request does not include payment data
     * @param BookingChange $bookingChange
     */
    public function __construct(ApiUri $baseUri, BookingChange $bookingChange)
    {
        parent::__construct($baseUri, self::BOOKING);

        $this->request->setMethod(Request::METHOD_PUT);
        $this->baseUri->setPath($baseUri->getPath() . '/' . self::BOOKING . '/' . $bookingChange->booking->reference);
        $this->setDataRequest($bookingChange);
    }
}
