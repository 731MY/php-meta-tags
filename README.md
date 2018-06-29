# PHP Meta Tags

PHP library to extract meta tags from html contents

## requirement
 * php >= 7.0.0
 * CURL


## Install

    composer require 731my/php-meta-tags

## Usage: 
####Simple use
~~~php

$Reader = new Reader('https://www.bbc.com/news/uk-england-44520759');

$Meta = new MetaFetcher($Reader);

print_r($Meta->meta());
~~~

####Filter specific tags
~~~php
$Reader = new Reader('https://www.bbc.com/news/uk-england-44520759');

$Meta = new MetaFetcher($Reader);

print_r($Meta->meta(['og:image']));
~~~

####Load from file
~~~php
$Reader = new Reader('/tmp/file.html', Type::FILE);

$Meta = new MetaFetcher($Reader);
~~~

####Load from data
~~~php
$Reader = new Reader("<html>....</html>", Type::DATA);

$Meta = new MetaFetcher($Reader);
~~~

####Config

you can customize user-agent , timeout , referer 

~~~php
$Config = new Config();

$Config->setTimeout(20); // in seconds , default: 10
$Config->setUserAgent('731MY'); // default: Googlebot/2.1 (+http://www.google.com/bot.html)
$Config->setReferer('https://google.com/'); // default: null


$Meta = new MetaFetcher(new Reader('https://www.bbc.com/news/uk-england-44520759',Type::URL,$Config));
~~~

## License

~~~
MIT License

Copyright (c) 2016 Helmy Al Dobhany

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
~~~