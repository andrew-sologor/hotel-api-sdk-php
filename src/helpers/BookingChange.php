<?php

namespace hotelbeds\hotel_api_sdk\helpers;

use hotelbeds\hotel_api_sdk\model\Booking as BookingModel;

/**
 * @package hotelbeds\hotel_api_sdk\helpers
 * @property BookingModel booking
 */
class BookingChange extends ApiHelper
{
    public function __construct()
    {
        $this->fields['mode'] = 'UPDATE';

        $this->validFields = [
            'mode'    => 'string',
            'booking' => 'hotelbeds\\hotel_api_sdk\\model\\Booking',
        ];
    }
}
