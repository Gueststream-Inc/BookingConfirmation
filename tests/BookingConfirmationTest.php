<?php

namespace Gueststream\Reservations;

use SebastianBergmann\Comparator\Book;

class BookingConfirmationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that the booking number can be set and retrieved.
     */
    public function testSetGetBookingNumber()
    {
        $bookingNumber       = rand(9999, 99999);
        $bookingConfirmation = new BookingConfirmation();
        $bookingConfirmation->setBookingNumber($bookingNumber);
        $this->assertSame($bookingNumber, $bookingConfirmation->getBookingNumber());
    }

    public function testSetGetAltBookingNumber()
    {
        $altBookingNumber    = rand(9999, 99999);
        $bookingConfirmation = new BookingConfirmation();
        $bookingConfirmation->setAltBookingNumber($altBookingNumber);
        $this->assertSame($altBookingNumber, $bookingConfirmation->getAltBookingNumber());
    }

    public function testSetGetTotalCost()
    {
        $totalCost           = 23432.02;
        $bookingConfirmation = new BookingConfirmation();
        $bookingConfirmation->setTotalCost($totalCost);
        $this->assertSame($totalCost, $bookingConfirmation->getTotalCost());
    }

    public function testSetGetTravelInsurance()
    {
        $bookingConfirmation = new BookingConfirmation();

        // Set True
        $bookingConfirmation->setHasTravelInsurance(true);
        $this->assertTrue($bookingConfirmation->hasTravelInsurance());

        // Set False
        $bookingConfirmation->setHasTravelInsurance(false);
        $this->assertFalse($bookingConfirmation->hasTravelInsurance());

        // Passing no boolean should set hasTravelInsurance back to True
        $bookingConfirmation->setHasTravelInsurance();
        $this->assertTrue($bookingConfirmation->hasTravelInsurance());
    }

    public function testSetGetDamageInsurance()
    {
        $bookingConfirmation = new BookingConfirmation();

        // Set True
        $bookingConfirmation->setHasDamageInsurance(true);
        $this->assertTrue($bookingConfirmation->hasDamageInsurance());

        // Set False
        $bookingConfirmation->setHasDamageInsurance(false);
        $this->assertFalse($bookingConfirmation->hasDamageInsurance());

        // Passing no boolean should set hasDamageInsurance back to True
        $bookingConfirmation->setHasDamageInsurance();
        $this->assertTrue($bookingConfirmation->hasDamageInsurance());
    }

    /**
     * @expectedException \Exception
     */
    public function testGetArrivalException()
    {
        $bookingConfirmation = new BookingConfirmation();

        // Throws Exception for not having set the Arrival Date
        $bookingConfirmation->getArrivalDate();
    }

    /**
     * @expectedException \Exception
     */
    public function testGetDepartureException()
    {
        $bookingConfirmation = new BookingConfirmation();

        // Throws Exception for not having set the Departure Date
        $bookingConfirmation->getDepartureDate();
    }

    public function testGetNights()
    {
        $bookingConfirmation = new BookingConfirmation();

        $bookingConfirmation->setArrivalDate('2020-12-01');
        $bookingConfirmation->setDepartureDate('2020-12-07');

        $this->assertSame(6, $bookingConfirmation->getNights());
    }

    public function testSetArrivalDepartureWithDateTimeObject()
    {
        $bookingConfirmation = new BookingConfirmation();

        $arrivalDate = new \DateTime('2020-12-01');
        $bookingConfirmation->setArrivalDate($arrivalDate);

        $this->assertSame($arrivalDate, $bookingConfirmation->getArrivalDate());

        $departureDate = new \DateTime('2020-12-07');
        $bookingConfirmation->setDepartureDate($departureDate);

        $this->assertSame($departureDate, $bookingConfirmation->getDepartureDate());
    }

    public function testJsonSerialiable()
    {
        $json = '{"bookingNumber":1234,"altBookingNumber":4321,"totalCost":10123.01,'
                . '"hasDamageInsurance":true,"hasTravelInsurance":true,'
                . '"arrivalDate":"2020-12-01T00:00:00+00:00","departureDate":"2020-12-07T00:00:00+00:00"}';

        $bookingConfirmation = new BookingConfirmation();

        $bookingConfirmation->setBookingNumber(1234);
        $bookingConfirmation->setAltBookingNumber(4321);
        $bookingConfirmation->setArrivalDate('2020-12-01');
        $bookingConfirmation->setDepartureDate('2020-12-07');
        $bookingConfirmation->setTotalCost(10123.01);
        $bookingConfirmation->setHasTravelInsurance(true);
        $bookingConfirmation->setHasDamageInsurance(true);

        $jsonSerializedOutput = json_encode($bookingConfirmation);

        $this->assertSame($json, $jsonSerializedOutput);
    }

    public function testJsonImportAndSerializeSame()
    {
        $json = '{"bookingNumber":1234,"altBookingNumber":4321,"totalCost":10123.01,'
                . '"hasDamageInsurance":true,"hasTravelInsurance":true,'
                . '"arrivalDate":"2020-12-01T00:00:00+00:00","departureDate":"2020-12-07T00:00:00+00:00"}';

        $bookingConfirmationData = json_decode($json);

        $bookingConfirmation = new BookingConfirmation($bookingConfirmationData);

        $this->assertSame($json, json_encode($bookingConfirmation));
    }
}
