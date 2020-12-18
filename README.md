# OpeningHours Library
The OpeningHours library is used to implement opening hours logic and validation for your project.

## Installation
Using Composer
```composer log
composer require koen/opening-hours-library
```

## Usage

**Initialize Opening Hours**

```php
$openingHours = new OpeningHours();
$openingHours->setOpeningTime($openAt);
$openingHours->setClosingTime($closedAt);
```

**Initialize Opening Hours with breaks**

The `OpeningHoursWithBreaks` class adds the functionality to include breaks to your opening hours. It is possible to add none, one or multiple breaks.
```php
$pause = new Pause($pauseStart, $pauseEnd);
$openingHours = new OpeningHoursWithBreaks();
$openingHours->setOpeningTime($openAt);
$openingHours->setClosingTime($closedAt);
$openingHours->addPause($pause, $pause, ...);
```

### Validation

The validation classes will validate for correct input dates.

- Opening time cannot occur after closing time and vice versa.
- Breaks cannot overlap.
- Breaks cannot occur before being opened or after being closed.

Inject in your classes using dependency injection.

```php
class Controller {

    private $validator;

    public function __construct(
        ValidateOpeningHoursInterface $validator
    ) {
        $this->validator = $validator;
    }

    public function yourControllerLogic()
    {
        $openingHours = new OpeningHours();
        ...

        $this->validator->validate($openingHours);
    }
}
````

Instantiate validator classes directly.

```php
$openingHours = new OpeningHoursWithBreaks();

$validator = new OpeningHoursValidator();
$validator->validate($openingHours);

$validator = new PauseValidator();
$validator->validate($openingHours);
```

## Contributing
Pull requests are welcome. This project is build for academic purposes.
For major changes, please provide information about what you have changed and why to discuss your changes.

## License
