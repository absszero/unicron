# Unicron

A unique process manager

Managing processes by process ids and prevent duplicating processes.

## Installation

`composer require absszero/unicron`

## Usage

~~~php
use Absszero\Unicron\Unicron;

$unicron = new Unicron('YOUR_PROCESS_NAME');

if ($unicron->isRunning()) {
	$unicron->kill();
}

$unicron->setPid();
~~~


## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

TODO: Write history

## Credits

TODO: Write credits

## License

TODO: Write license