# MessageParser

_Gamurs\MessageParser_ is a simple message parser for Laravel 4 to filter bad words (aka swear words) from content. This is useful for sites with mixed audiences.

## Usage

MessageParser can load bad word definitions from either a database table or from a config file. You can change which option is used in config/config.php. It defaults to using a database table.

### Installing

- Add MessageParser to your providers list in app/config/app.php:

	```php
	'providers' => array(
		...
		'Gamurs\MessageParser\MessageparserServiceProvider',
		...
	),
	```

- __(Optional)__ Add Parser to your aliases list in app/config/app.php:

	```php
	'aliases'   => array(
	...
		'Parser'      => 'Gamurs\MessageParser\Facades\Parser',
	),
	```

- __(Optional)__ Run the included migration to create the badowrds table in you DB:

	```php
	php artisan migrate --package=gamurs/message-parser
	```

- __(Optional)__ Publish and edit the configuration:

	```php
	php artisan config:publish gamurs/message-parser
	```

### Parsing Messages

If you've followed the steps above and added Parser as an alias, go ahead and add a few words and replacements to either the "badwords" table or to the config/badwords.php file.

Now you can easily parse a message like so:

```php
$message = Parser::filterBadWords($message);
```

## License

MessageParser is released under the [http://opensource.org/licenses/mit-license.php](MIT License).

Copyright (c) 2013 Gamurs

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.