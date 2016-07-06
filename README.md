# Booking Confirmation Class

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is a simple value object class that contains booking confirmation information and is used in the [VRPConnector](https://github.com/Gueststream-Inc/VRPConnector/)  plugin on the confirmation page to display information to the guests who have just successfully booked a unit.

## Install

Via Composer

``` bash
$ composer require gueststream/bookingconfirmation
```

## Usage

``` php
$bookingConfirmation = new Gueststream\Reservations\BookingConfirmation();
$bookingConfirmation->setBookingNumber(1234);
$bookingConfirmation->setArrivalDate('2020-12-01');
$bookingConfirmation->setDepartureDate('2020-12-7');
echo $bookingConfirmation->getNights();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email support@gueststream.com instead of using the issue tracker.

## Credits

- [Josh Houghtelin][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/gueststream/bookingconfirmation.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Gueststream-Inc/BookingConfirmation/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/gueststream-inc/bookingconfirmation.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/gueststream-inc/bookingconfirmation.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/gueststream/bookingconfirmation.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/gueststream/bookingconfirmation
[link-travis]: https://travis-ci.org/Gueststream-Inc/BookingConfirmation
[link-scrutinizer]: https://scrutinizer-ci.com/g/gueststream-inc/bookingconfirmation/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/gueststream-inc/bookingconfirmation
[link-downloads]: https://packagist.org/packages/gueststream/bookingconfirmation
[link-author]: https://github.com/jhoughtelin
[link-contributors]: ../../contributors
