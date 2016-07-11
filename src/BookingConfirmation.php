<?php

namespace Gueststream\Reservations;

use DateTime;
use DateTimeZone;
use Exception;
use JsonSerializable;

class BookingConfirmation implements JsonSerializable
{

    /**
     * @var string
     */
    protected $bookingNumber;

    /**
     * @var string
     */
    protected $altBookingNumber;

    /**
     * @var DateTime
     */
    protected $arrivalDate;

    /**
     * @var DateTime
     */
    protected $departureDate;

    /**
     * @var int
     */
    protected $nights;

    /**
     * @var float
     */
    protected $totalCost;

    /**
     * The Total amount charged to the guest's credit card.
     *
     * @var float
     */
    protected $totalCharged;

    /**
     * @var boolean
     */
    protected $hasTravelInsurance = false;

    /**
     * @var boolean
     */
    protected $hasDamageInsurance = false;

    /**
     * @param array|object|null $bookingConfirmationData
     */
    public function __construct($bookingConfirmationData = null)
    {
        if (!is_null($bookingConfirmationData)) {
            $this->hydrateBookingConfirmation($bookingConfirmationData);
        }
    }

    public function hydrateBookingConfirmation($bookingConfirmationData)
    {
        foreach ($bookingConfirmationData as $key => $value) {
            $setterMethodName = "set" . ucfirst($key);

            if (method_exists($this, $setterMethodName)) {
                $this->$setterMethodName($value);
            }
        }
    }

    /**
     * @return string
     */
    public function getBookingNumber()
    {
        return $this->bookingNumber;
    }

    /**
     * @param string $bookingNumber
     */
    public function setBookingNumber($bookingNumber)
    {
        $this->bookingNumber = $bookingNumber;
    }

    /**
     * @return string
     */
    public function getAltBookingNumber()
    {
        return $this->altBookingNumber;
    }

    /**
     * @param string $altBookingNumber
     */
    public function setAltBookingNumber($altBookingNumber)
    {
        $this->altBookingNumber = $altBookingNumber;
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getArrivalDate()
    {
        if (empty($this->arrivalDate)) {
            throw new Exception('Arrival date must first be set.');
        }

        return $this->arrivalDate;
    }

    /**
     * @param DateTime $arrivalDate
     */
    public function setArrivalDate($arrivalDate)
    {
        if ($arrivalDate instanceof DateTime) {
            $this->arrivalDate = $arrivalDate;

            return;
        }

        $this->arrivalDate = new DateTime($arrivalDate, new DateTimeZone('UTC'));
        $this->updateNights();
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getDepartureDate()
    {
        if (empty($this->departureDate)) {
            throw new Exception('Departure date must first be set.');
        }

        return $this->departureDate;
    }

    /**
     * @param DateTime $departureDate
     */
    public function setDepartureDate($departureDate)
    {
        if ($departureDate instanceof DateTime) {
            $this->departureDate = $departureDate;

            return;
        }

        $this->departureDate = new DateTime($departureDate, new DateTimeZone('UTC'));
        $this->updateNights();
    }

    protected function updateNights()
    {
        if (!empty($this->arrivalDate) && !empty($this->departureDate)) {
            $nightsDiff   = $this->arrivalDate->diff($this->departureDate);
            $this->nights = (int) $nightsDiff->format('%a');

            return;
        }

        $this->nights = null;
    }

    /**
     * @return int
     */
    public function getNights()
    {
        return $this->nights;
    }

    /**
     * @return float
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * @param float $totalCost
     */
    public function setTotalCost($totalCost)
    {
        $this->totalCost = $totalCost;
    }

    /**
     * @return float
     */
    public function getTotalCharged()
    {
        return $this->totalCharged;
    }

    /**
     * @param float $totalCharged
     */
    public function setTotalCharged($totalCharged)
    {
        $this->totalCharged = $totalCharged;
    }

    /**
     * @return boolean
     */
    public function hasTravelInsurance()
    {
        return $this->hasTravelInsurance;
    }

    /**
     * @param boolean $hasTravelInsurance
     */
    public function setHasTravelInsurance($hasTravelInsurance = true)
    {
        $this->hasTravelInsurance = (boolean) $hasTravelInsurance;
    }

    /**
     * @return boolean
     */
    public function hasDamageInsurance()
    {
        return $this->hasDamageInsurance;
    }

    /**
     * @param boolean $hasDamageInsurance
     */
    public function setHasDamageInsurance($hasDamageInsurance = true)
    {
        $this->hasDamageInsurance = (boolean) $hasDamageInsurance;
    }

    public function jsonSerialize()
    {
        $bookingConfirmationData = [
            'bookingNumber'      => $this->getBookingNumber(),
            'altBookingNumber'   => $this->getAltBookingNumber(),
            'totalCost'          => $this->getTotalCost(),
            'hasDamageInsurance' => $this->hasDamageInsurance(),
            'hasTravelInsurance' => $this->hasTravelInsurance(),
            'arrivalDate'        => $this->getArrivalDate()->format('c'),
            'departureDate'      => $this->getDepartureDate()->format('c'),
        ];

        return $bookingConfirmationData;
    }
}
