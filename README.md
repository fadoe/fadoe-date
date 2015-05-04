FaDoe\Date
==========

This library provides some classes for date handling in PHP.

## Installation

Use ``composer`` to install this library:

```php
composer.phar require fadoe/date
```

## Usage

### Compare

Compare is a class to compare ```\DateTime``` classes. You must create a instance with the ```\DateTime``` to compare
against other ```\DateTime``` classes.

### DateRange

This class creates ```\DateTime``` classes between two dates.

### DateTime

This class extends the original ```\DateTime``` class and adds some helper methods. It also adds support to serialise
the class.

### DateTimeProvider

A class to give some ```\DateTime``` classes. Usefull for classes that need the current date for calculation. With this
class you have a provider for dates and you can mock this in unit tests.

### DateTimeZone

This class adds the magic method __toString() to the native PHP DateTimeZone class.
