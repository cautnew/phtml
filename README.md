# PHTML

## Overview

The `PHTML` class in PHP is designed to facilitate the creation of HTML tags using PHP objects. This class enables you to generate HTML tags dynamically, making it easier to build and manipulate HTML elements programmatically. You can change any part of your HTML before rendering the page without worrying about concats. One of the main features of this class is the ability to create a tag and change it's parameters and content with simple methods and avoiding concats and huge strings, only objects.

It's possible to write HTML as a string, _but why?_

## Features

- Simplifies the creation of HTML tags using PHP.
- Provides a clean and object-oriented way to generate HTML elements.
- Supports creating a variety of HTML tags.

## Installation

To use the `PHTML` class, simply include the class file in your PHP project:

```php
use PHTML/TAG;
```

## Usage

### Creating a SCRIPT Tag

The `SCRIPT` object allows you to create a `<script>` tag easily. Below is an example of how to use the `PHTML` class to generate a `<script>` tag:

```php
<?php

use PHTML/TAG;

// Create a DIV object
$div = TAG::div();

// Set attributes for the <div> tag
$div->addClass('main-content');
$div->setAttribute('style', 'backgroun-color: green;');
$div->setAttribute('title', 'Div title');
$div->setAttribute('lang', 'en');

// Add a content to this DIV
$div->append('This is my div!');

// Render the <script> tag
echo $div->render();
?>
```

### Example with inline Script

You can also create a `<script>` tag with inline JavaScript code:

```php
<?php

use PHTML/TAG;

// Create a SCRIPT object
$script = TAG::script();

// Set the inline JavaScript code
$script->append('console.log("Hello, world!");');

// Render the <script> tag
echo $script->render();
?>
```

### Example appending one object to other

You can also append one tag to other:

```php
<?php

use PHTML/DIV;

// Create DIV objects
$div1 = new DIV('div-main', 'div-1');
$div2 = new DIV('div-child', 'div-2');

// Append $div2 into $div1
$div1->append($div2);

// Render the <div> tag
echo $div1;
?>
```

### Example appending inputs and changing later

You can also append one tag to other and edit it's parameters and content before rendering it:

```php
<?php

use PHTML/DIV;

// Create DIV object
$div = new DIV('div-main', 'div-1');

// Append input and change it's name parameter
$div->append($input = TAG::input('my-inputs', placeholder: 'Test'));
$input->setName('input-test');

// Render the <div> tag
echo $div;
?>
```

## Methods

### setAttribute

Sets an attribute for the HTML tag.

```php
$element->setAttribute($name, $value);
```

- `$name` (string): The name of the attribute.
- `$value` (string): The value of the attribute.

### setContent

Sets the content inside the HTML tag.

```php
$element->append($content);
```

- `$content` (string): The content to be placed inside the tag.

### render

Renders the HTML tag as a string.

```php
echo $element->render();
```

## Conclusion

The `PHTML` class provides a powerful and flexible way to generate HTML tags using PHP objects. Whether you need to create simple tags or complex structures, this class offers a clean and efficient solution. The `SCRIPT` object is just one example of how you can leverage this class to create dynamic and interactive web pages.

Feel free to explore and extend the `PHTML` class to suit your needs. Happy coding!
