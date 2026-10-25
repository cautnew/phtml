# PHTML

Build HTML with PHP objects instead of string concatenation. Create a tag, change its attributes and content as many times as you want, and render it only when you need it.

It's possible to write HTML as a string, _but why?_

## Features

- One class per HTML tag in `CN\PHTML\Core` (`DIV`, `P`, `IMG`, `TABLE`, `FORM`, `DIALOG`, ...), plus static factories on `TAG` (`TAG::div()`, `TAG::img()`, ...).
- Fluent API: classes, `id`, `data-*`, `aria-*`, boolean attributes, inline styles and nested content.
- Void tags (`br`, `hr`, `img`, `input`, `meta`, `link`, `source`, ...) extend `NONCONTENTTAG`: they render self-closed and throw if you try to add content.
- Content can be a string, another tag or an `ArrayTAG` list.
- Optional Bootstrap (`BS`), Font Awesome (`FA`) and Tailwind (`TW`) helpers.

## Installation

```bash
composer require cautnew/phtml
```

```php
use CN\PHTML\Core\TAG;
```

## Usage

### Creating a tag

Use the static factories (no extra imports) or instantiate the class directly:

```php
use CN\PHTML\Core\DIV;
use CN\PHTML\Core\TAG;

$a = TAG::div('card', 'card-1', 'Hello');   // class, id, html
$b = new DIV(class: 'card', id: 'card-1', html: 'Hello');

echo $a; // <div class="card" id="card-1">Hello</div>
```

### Classes, attributes and styles

```php
$div = TAG::div();

$div->addClass('main-content')              // also accepts 'a b' or ['a', 'b']
    ->setAttribute('title', 'Div title')
    ->setAttribute('lang', 'en')
    ->data('role', 'panel')                 // data-role="panel"
    ->aria('label', 'Main panel')           // aria-label="Main panel"
    ->setStyle('color', 'green')            // style="color: green;"
    ->append('This is my div!');

echo $div;
```

Extra attributes can also be passed to any constructor or factory as named arguments:

```php
echo TAG::a('/home', 'Home', title: 'Go home');
```

### Nesting tags

```php
$div1 = new DIV(class: 'div-main', id: 'div-1');
$div2 = new DIV(class: 'div-child', id: 'div-2');

$div1->append($div2);       // $div2 can still be edited after being appended
$div2->append('Inside!');

echo $div1;
// <div class="div-main" id="div-1"><div class="div-child" id="div-2">Inside!</div></div>
```

Group several elements with `ArrayTAG`:

```php
use CN\PHTML\ArrayTAG;

$div = TAG::div('div-main');
$div->append(new ArrayTAG([
    TAG::p(html: 'My first paragraph'),
    TAG::p(html: 'My second paragraph'),
]));

echo $div;
```

### Content before and after a tag

```php
echo TAG::div(html: 'x')->appendBefore('<!-- start -->')->appendAfter('<!-- end -->');
// <!-- start --><div>x</div><!-- end -->
```

### Void tags

```php
echo TAG::br();                               // <br />
echo TAG::img('/logo.png', 'Company logo');   // <img src="/logo.png" alt="Company logo" />
echo TAG::hr('divider');                      // <hr class="divider" />

TAG::br()->append('text');                    // throws ContentNotAllowedException
```

### Forms

```php
use CN\PHTML\Core\INPUT_TEXT;

$form = TAG::form(action: '/save', method: 'post');
$form->append(TAG::label(for: 'name', html: 'Name'));
$form->append((new INPUT_TEXT(id: 'name', name: 'name', placeholder: 'Your name'))->required());
$form->append(
    TAG::select(name: 'country')
        ->append(TAG::option('br', 'Brazil')->selected())
        ->append(TAG::option('us', 'United States'))
);
$form->append(TAG::button(html: 'Save', type: 'submit'));

echo $form;
```

### Tables

```php
$table = TAG::table('table')
    ->append(TAG::caption(side: 'bottom', html: 'Users'))
    ->append(TAG::thead()->append(TAG::tr()->append(TAG::th(html: 'Name'))))
    ->append(TAG::tbody()->append(TAG::tr()->append(TAG::td(html: 'Ann'))));

echo $table;
```

### Text-level and semantic tags

```php
echo TAG::p(html: 'Press ' . TAG::kbd(html: 'Ctrl+C') . ' to copy.');
echo TAG::time('2024-05-01', html: 'May 1st');
echo TAG::figure()->append(TAG::img('/a.png', 'A'))->append(TAG::figcaption(html: 'Figure A'));
echo TAG::details()->append(TAG::summary(html: 'More'))->append('Hidden text');
```

### A complete page

```php
use CN\PHTML\Templates\HTML5;

$page = new HTML5();
$page->setPageTitle('My page');
$page->appendToBody(TAG::h1(html: 'Welcome'));

echo $page;
```

## List tags (tags built from a list of children)

For every tag that has required children in the HTML content model there is a `*_LIST` class in `CN\PHTML\Lists`. It works like the plain tag, but its first argument is a list (array or `ArrayTAG`) of children. Only the allowed child types are accepted; anything else throws an `InvalidArgumentException`. Every other argument is forwarded to the plain tag (`class`, `id`, `html`, extra attributes...).

```php
use CN\PHTML\Core\{TAG, TD, TH};
use CN\PHTML\Lists\{TABLE_LIST, TBODY_LIST, THEAD_LIST, TR_LIST, UL_LIST};

echo new UL_LIST([TAG::li(html: 'First'), TAG::li(html: 'Second')], class: 'menu');
// <ul class="menu"><li>First</li><li>Second</li></ul>

echo TAG::selectList([TAG::option('br', 'Brazil'), TAG::option('us', 'USA')], name: 'country');

echo new TABLE_LIST([
    new THEAD_LIST([new TR_LIST([new TH(html: 'Name')])]),
    new TBODY_LIST([new TR_LIST([new TD(html: 'Ann')])]),
], class: 'table');

new UL_LIST([TAG::p(html: 'x')]); // InvalidArgumentException: only LI is accepted
```

More helpers: `addItem($child)` and `setItems($list)` add children later; `UL_LIST::allowedChildren()` returns the accepted classes; `TR_LIST::newList([...])` builds an `ArrayTAG` that validates its own items. Each class also has a factory on `TAG` (`TAG::ulList()`, `TAG::trList()`...). A runnable demo is in [src/Examples/ListExamples.php](src/Examples/ListExamples.php).

| Class | Accepted children |
|-------|-------------------|
| `UL_LIST`, `OL_LIST`, `MENU_LIST` | `LI` |
| `SELECT_LIST` | `OPTION`, `OPTGROUP` |
| `OPTGROUP_LIST`, `DATALIST_LIST` | `OPTION` |
| `TABLE_LIST` | `CAPTION`, `COLGROUP`, `THEAD`, `TBODY`, `TFOOT`, `TR` |
| `THEAD_LIST`, `TBODY_LIST`, `TFOOT_LIST` | `TR` |
| `TR_LIST` | `TH`, `TD` |
| `COLGROUP_LIST` | `COL` |
| `DL_LIST` | `DT`, `DD` |
| `HEAD_LIST` | `TITLE`, `META`, `LINK`, `BASE`, `SCRIPT`, `STYLE`, `NOSCRIPT`, `TEMPLATE` |
| `HTML_LIST` | `HEAD`, `BODY` |
| `PICTURE_LIST` | `SOURCE`, `IMG` |
| `AUDIO_LIST`, `VIDEO_LIST` | `SOURCE`, `TRACK` |
| `MAP_LIST` | `AREA` |
| `RUBY_LIST` | `RT`, `RP` |
| `HGROUP_LIST` | `H1`–`H6`, `P` |
| `TAG_OBJECT_LIST` | `PARAM` |

## Supported tags

| Group | Classes (`CN\PHTML\Core`) |
|-------|---------------------------|
| Document | `HTML`, `HEAD`, `BODY`, `TITLE`, `META`, `LINK`, `BASE`, `SCRIPT`, `STYLE`, `NOSCRIPT`, `TEMPLATE`, `SLOT` |
| Sections | `HEADER`, `NAV`, `MAIN`, `SECTION`, `ARTICLE`, `ASIDE`, `FOOTER`, `ADDRESS`, `HGROUP`, `SEARCH`, `H1`–`H6` |
| Grouping | `DIV`, `P`, `PRE`, `BLOCKQUOTE`, `HR`, `UL`, `OL`, `LI`, `MENU`, `DL`, `DT`, `DD`, `FIGURE`, `FIGCAPTION` |
| Text | `A`, `ABBR`, `B`, `BDI`, `BDO`, `BR`, `CITE`, `CODE`, `DATA`, `DFN`, `EM`, `I`, `KBD`, `MARK`, `Q`, `RP`, `RT`, `RUBY`, `S`, `SAMP`, `SMALL`, `SPAN`, `STRONG`, `SUB`, `SUP`, `TIME`, `U`, `VARIABLE` (`<var>`), `WBR`, `DEL`, `INS` |
| Embedded | `IMG`, `PICTURE`, `SOURCE`, `TRACK`, `AUDIO`, `VIDEO`, `CANVAS`, `IFRAME`, `EMBED`, `TAG_OBJECT` (`<object>`), `PARAM`, `MAP`, `AREA` |
| Tables | `TABLE`, `CAPTION`, `COLGROUP`, `COL`, `THEAD`, `TBODY`, `TFOOT`, `TR`, `TH`, `TD` |
| Forms | `FORM`, `FIELDSET`, `LEGEND`, `LABEL`, `INPUT`, `INPUT_TEXT`, `INPUT_HIDDEN`, `INPUT_SUBMIT`, `BUTTON`, `SELECT`, `OPTGROUP`, `OPTION`, `DATALIST`, `TEXTAREA`, `OUTPUT`, `PROGRESS`, `METER` |
| Interactive | `DETAILS`, `SUMMARY`, `DIALOG` |

Every class has a static factory on `TAG` named after the tag (`TAG::pre()`, `TAG::dialog()`...). Names that would clash with existing methods are prefixed: `TAG::tagTitle()`, `TAG::tagData()`, `TAG::tagCol()`, `TAG::tagObject()`; and `<var>` is `TAG::variable()`.

> Attribute values are written as given and are **not** escaped. Escape user input with `htmlspecialchars()` before passing it to a tag.

## Methods

| Method | Description |
|--------|-------------|
| `setAttribute($name, $value)` / `attribute()` | Sets an attribute. Boolean attributes (`required`, `disabled`, `checked`...) take `true`/`false`. |
| `addClass($class)` | Adds one or more CSS classes. |
| `setId($id)` / `id()` and `setName($name)` / `name()` | Set `id` and `name`. |
| `setStyle($property, $value)` | Sets an inline CSS property from an allowed list. |
| `data($name, $value)` / `aria($name, $value)` | Set `data-*` and `aria-*` attributes. |
| `append($content)` | Adds a string, tag or `ArrayTAG` inside the tag. |
| `appendBefore($content)` / `appendAfter($content)` | Adds content outside the tag. |
| `clearAppend()` | Removes the inner content. |
| `render()` / `echo $tag` | Returns the HTML string. |

## Tests

```bash
composer install
composer test
```

## License

MIT
