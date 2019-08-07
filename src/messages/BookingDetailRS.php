<?php

namespace hotelbeds\hotel_api_sdk\messages;

use hotelbeds\hotel_api_sdk\model\Booking;
use hotelbeds\hotel_api_sdk\model\AuditData;

/**
 * @package hotelbeds\hotel_api_sdk\messages
 */
class BookingDetailRS extends ApiResponse
{
    /**
     * BookingConfirmRS constructor.
     *
     * @param array $rsData
     */
    public function __construct(array $rsData)
    {
        parent::__construct($rsData);
        if (array_key_exists("booking", $rsData)) {
            $bookingObject = new Booking($this->booking);
            $this->booking = $bookingObject;
        }
    }

    /**
     * Returns an auditdata object with response auditdata
     *
     * @return AuditData Return class of audit
     */
    public function auditData()
    {
        return new AuditData($this->auditData);
    }
}
