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

There are several compare methods:

| constant | compare strategy |
| -------- | ------------ |
| Compare::GT_FROM_LT_TO | date from < compare date < date to |
| Compare::GT_FROM_LTEQ_TO | date from < compare date <= date to |
| Compare::GTEQ_FROM_LT_TO | date from <= compare date < date to |
| Compare::GTEQ_FROM_LTEQ_TO | date from <= compare date <= date to |

### DateRange

This class creates ```\DateTime``` classes between two dates.

### DateTimeProvider

A class to give some ```\DateTime``` classes. Usefull for classes that need the current date for calculation. With this
class you have a provider for dates and you can mock this in unit tests.
