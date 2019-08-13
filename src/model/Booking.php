<?php

namespace hotelbeds\hotel_api_sdk\model;

/**
 * @package hotelbeds\hotel_api_sdk\model
 * @property string $reference
 * @property string cancellationReference
 * @property string clientReference
 * @property array  modificationPolicies
 * @property string creationDate
 * @property string creationUser
 * @property double totalNet
 * @property double totalSellingRate
 * @property double pendingAmount
 * @property string currency
 * @property array  status
 * @property array  holder
 * @property double commisionVAT
 * @property double agCommision
 * @property string remark
 * @property array  hotel
 * @property array  invoiceCompany
 */
class Booking extends ApiModel
{
    /**
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        $this->validFields = [
            "reference"             => "string",
            "cancellationReference" => "string",
            "clientReference"       => "string",
            "modificationPolicies"  => "array",
            "creationDate"          => "string",
            "creationUser"          => "string",
            "totalNet"              => "double",
            "totalSellingRate"      => "double",
            "pendingAmount"         => "double",
            "currency"              => "string",
            "status"                => "array",
            "holder"                => "array",
            "commisionVAT"          => "double",
            "agCommision"           => "double",
            "remark"                => "string",
            "hotel"                 => "array",
            "invoiceCompany"        => "array",
        ];

        if ($data !== null) {
            $this->fields = $data;
        }
    }
}
