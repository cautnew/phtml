<?php

namespace CN\PHTML\Core;

use CN\PHTML\Exceptions\ContentNotAllowedException;
use CN\PHTML\Exceptions\ParametersNotAllowedException;
use CN\PHTML\ArrayTAG;
use CN\PHTML\HTMLRenderer;

/**
 * Class TAG
 *
 * Base class of every HTML tag. It stores attributes, CSS classes, inline
 * styles and inner content, and renders them through HTMLRenderer.
 *
 * It also exposes static factories (TAG::div(), TAG::p(), TAG::img()...) for
 * every supported tag, so you can build markup without "new" and imports.
 */
class TAG
{
    /** Tag this one was appended to. */
    private TAG $parent;

    private ?string $compileName = null;

    protected ?string $tagType;
    private ?string $id;
    private ?string $name;

    private array $classList = [];
    private array $parameters = [];
    private array $parametersBoolean = [];
    private array $parametersData = [];
    private array $parametersAria = [];
    private array $appendList = [];
    private array $appendAfterList = [];
    private array $appendBeforeList = [];
    private array $styleAttributes = [];

    /** Generic attributes considered valid for this library. */
    protected array $permAttr = [
        'id',
        'name',
        'value',
        'src',
        'href',
        'placeholder',
        'data',
        'style',
        'width',
        'height',
        'max',
        'min',
        'title',
        'alt',
        'type',
        'method',
        'action'
    ];
    /** Attributes rendered without a value (e.g. "required"). */
    protected array $permBooleanAttr = [
        'checked',
        'disabled',
        'multiple',
        'readonly',
        'required',
        'selected',
        'autoplay',
        'muted',
        'playsinline'
    ];
    /** CSS properties accepted by setStyleParameter(). */
    protected array $permStyleAttr = [
        'caption-side',
        'color',
        'align-items',
        'background-color',
        'font-size',
        'font-weight',
        'text-align',
        'text-decoration',
        'border',
        'border-radius',
        'margin',
        'margin-top',
        'margin-right',
        'margin-bottom',
        'margin-left',  
        'padding',
        'padding-top',
        'padding-right',
        'padding-bottom',
        'padding-left',
        'width',
        'height',
        'display',
        'position',
        'float',
        'clear',
        'top',
        'right',
        'bottom',
        'left'
    ];
    /** Whether attributes may be set on this tag. */
    protected bool $allowParameter = true;
    /** Whether inner content may be appended to this tag. */
    protected bool $allowContent = true;

    protected int $level = 0;

    /**
     * Render the tag as an HTML string, so it can be echoed or concatenated.
     */
    public function __toString()
    {
        return self::render();
    }

    /**
     * Detach the clone from its parent so it can be appended elsewhere.
     */
    public function __clone()
    {
        unset($this->parent);
    }

    /**
     * Reserved hook for compiled (pre-rendered) tags. Does nothing by default.
     */
    public function compile(?string $compileName = null)
    {
        if (empty($compileName)) {
            $compileName = $this->compileName;
        }
    }

    /**
     * Whether this tag has a compiled version. Always false by default.
     */
    public function hasCompilation(): bool
    {
        return false;
    }

    /**
     * Get the compilation name, if any.
     */
    public function getCompileName(): ?string
    {
        if (!isset($this->compileName)) {
            return null;
        }

        return $this->compileName;
    }

    /**
     * Set the compilation name.
     */
    public function setCompileName(?string $compileName = null): self
    {
        $this->compileName = $compileName;

        return $this;
    }

    /**
     * Render the tag (attributes, content and surrounding content) as HTML.
     */
    public function render(): string
    {
        return HTMLRenderer::render($this);
    }

    /**
     * Get the tag this one was appended to, or null if it has no parent.
     */
    public function getParent(): ?TAG
    {
        return $this->parent ?? null;
    }

    /**
     * Set the parent tag. Called automatically by append().
     */
    public function setParent(?TAG $parent): self
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get the content (tags and strings) rendered inside this tag.
     */
    public function getAppendList(): array
    {
        return $this->appendList;
    }

    /**
     * Append every element of the given list as inner content.
     */
    public function setAppendList(ArrayTAG $appendList): self
    {
        foreach ($appendList as $element) {
            $this->append($element);
        }

        return $this;
    }

    /**
     * Append content to the tag. It can be a TAG object, a string, or an array
     * of TAG objects and/or strings.
     * @param TAG|ArrayTAG|string|null $content
     * @param bool $replace
     * If true, the current append list will be replaced by the new content.
     * If false, the new content will be added to the current append list.
     * @return TAG
     */
    public function append(TAG|ArrayTAG|string|null $content, bool $replace = false): self
    {
        if (!$this->isAllowContent()) {
            throw new ContentNotAllowedException($this->tagType);
        }

        if ($content instanceof ArrayTAG) {
            return $this->setAppendList($content);
        } else if (empty($content)) {
            return $this;
        }

        $objAppended = null;
        if ($content instanceof TAG) {
            $objAppended = $content;
            $objAppended->setParent($this);
        } else {
            $objAppended = $content;
        }

        if ($replace) {
            $this->appendList = [$objAppended];
        } else {
            $this->appendList[] = $objAppended;
        }

        return $this;
    }

    /**
     * Get the content rendered right before the opening tag.
     */
    public function getAppendBeforeList(): array
    {
        return $this->appendBeforeList;
    }

    /**
     * Append every element of the given list before the opening tag.
     */
    public function setAppendBeforeList(ArrayTAG $appendList): self
    {
        foreach ($appendList as $element) {
            $this->appendBefore($element);
        }

        return $this;
    }

    /**
     * Add content rendered immediately before the opening tag (outside the tag).
     */
    public function appendBefore(TAG|ArrayTAG|string|null $content): self
    {
        if (!$this->isAllowContent()) {
            throw new ContentNotAllowedException($this->tagType);
        }

        if ($content instanceof ArrayTAG) {
            return $this->setAppendBeforeList($content);
        } else if (empty($content)) {
            return $this;
        }

        $objAppended = null;
        if ($content instanceof TAG) {
            $objAppended = $content;
            $objAppended->setParent($this->getParent());
        } else {
            $objAppended = $content;
        }

        $this->appendBeforeList[] = $objAppended;

        return $this;
    }

    /**
     * Get the content rendered right after the closing tag.
     */
    public function getAppendAfterList(): array
    {
        return $this->appendAfterList;
    }

    /**
     * Append every element of the given list after the closing tag.
     */
    public function setAppendAfterList(ArrayTAG $appendList): self
    {
        foreach ($appendList as $element) {
            $this->appendAfter($element);
        }

        return $this;
    }

    /**
     * Add content rendered immediately after the closing tag (outside the tag).
     */
    public function appendAfter(TAG|ArrayTAG|string|null $content): self
    {
        if ($content instanceof ArrayTAG) {
            return $this->setAppendAfterList($content);
        } else if (empty($content)) {
            return $this;
        }

        $objAppended = null;
        if ($content instanceof TAG) {
            $objAppended = $content;
            $objAppended->setParent($this->getParent());
        } else {
            $objAppended = $content;
        }

        $this->appendAfterList[] = $objAppended;

        return $this;
    }

    /**
     * Remove all inner content.
     */
    public function clearAppend(): self
    {
        $this->appendList = [];

        return $this;
    }

    /**
     * Whether this tag accepts inner content (false for void tags such as <br>).
     */
    public function isAllowContent(): bool
    {
        return $this->allowContent;
    }

    /**
     * Allow or forbid inner content.
     */
    public function setAllowContent(bool $allowContent = true): self
    {
        $this->allowContent = $allowContent;
        return $this;
    }

    /**
     * Fluent alias of setAllowContent().
     */
    public function allowContent(bool $allowContent = true): self
    {
        return $this->setAllowContent($allowContent);
    }

    /**
     * Whether this tag accepts attributes.
     */
    public function isAllowedParameter(): bool
    {
        return $this->allowParameter;
    }

    /**
     * Allow or forbid attributes.
     */
    public function setAllowParameter(bool $allowParameter = true): self
    {
        $this->allowParameter = $allowParameter;
        return $this;
    }

    /**
     * Fluent alias of setAllowParameter().
     */
    public function allowParameter(bool $allowParameter = true): self
    {
        return $this->setAllowParameter($allowParameter);
    }

    /**
     * Get the generic attributes ("name => value"), excluding class, id, name, boolean, data, aria and style attributes.
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Set several attributes at once from a "name => value" array.
     * Entries with an empty name are ignored.
     */
    public function setParameters(array $parameters): self
    {
        if (empty($parameters)) {
            return $this;
        }

        foreach ($parameters as $parameter => $value) {
            if (empty($parameter)) {
                continue;
            }

            $this->setParameter($parameter, $value);
        }

        return $this;
    }

    /**
     * Set one attribute.
     *
     * Special names: id, name, class, html/append (inner content), appendBefore,
     * appendAfter, data, aria and params (arrays). Boolean attributes (required,
     * disabled, checked...) take true/false. Empty values are ignored.
     *
     * @throws ParametersNotAllowedException If the tag forbids attributes.
     */
    public function setParameter(string $parameter, mixed $value): self
    {
        if ($parameter == "append") {
            return $this->append($value);
        }

        if ($parameter == "appendAfter") {
            return $this->appendAfter($value);
        }

        if ($parameter == "appendBefore") {
            return $this->appendBefore($value);
        }

        if (!$this->isAllowedParameter()) {
            throw new ParametersNotAllowedException($this->tagType);
        }

        switch ($parameter) {
            case 'id':
                return $this->setId($value);
            case 'name':
                return $this->setName($value);
            case 'class':
                return $this->addClass($value);
            case 'html':
                return $this->append($value);
            case 'data':
                if (is_array($value)) {
                    return $this->setDataAttributes($value);
                }
            case 'aria':
                if (is_array($value)) {
                    return $this->setAriaAttributes($value);
                }
            case 'parameters':
            case 'params':
                if (is_array($value)) {
                    return $this->setParameters($value);
                }
        }

        if (in_array($parameter, $this->permBooleanAttr)) {
            $this->parametersBoolean[$parameter] = $value;
            return $this;
        }

        if (empty($value)) {
            return $this;
        }

        $this->parameters[$parameter] = $value;

        return $this;
    }

    /**
     * Alias of setParameter().
     */
    public function setAttribute(string $parameter, mixed $value): self
    {
        return $this->setParameter($parameter, $value);
    }

    /**
     * Fluent alias of setParameter().
     */
    public function attribute(string $parameter, mixed $value): self
    {
        return $this->setParameter($parameter, $value);
    }

    /**
     * Set several inline CSS properties from a "property => value" array.
     */
    public function setStyleParameters(array $parameters): self
    {
        foreach ($parameters as $parameter => $value) {
            $this->setStyleParameter($parameter, $value);
        }

        return $this;
    }

    /**
     * Get the inline CSS properties.
     */
    public function getStyleAttributes(): array
    {
        return $this->styleAttributes;
    }

    /**
     * Alias of getStyleAttributes().
     */
    public function getStyleParameters(): array
    {
        return $this->styleAttributes;
    }

    /**
     * Set one inline CSS property.
     *
     * @throws ParametersNotAllowedException If the property is not in the allowed list.
     */
    public function setStyleParameter(string $parameter, string $value): self
    {
        if (!in_array($parameter, $this->permStyleAttr)) {
            throw new ParametersNotAllowedException($this->tagType);
        }

        $this->styleAttributes[$parameter] = $value;

        return $this;
    }

    /**
     * Alias of setStyleParameter().
     */
    public function setStyle(string $parameter, string $value): self
    {
        return $this->setStyleParameter($parameter, $value);
    }

    /**
     * Fluent alias of setStyleParameter().
     */
    public function styleParam(string $parameter, string $value): self
    {
        return $this->setStyleParameter($parameter, $value);
    }

    /**
     * Get the CSS classes.
     */
    public function getClassList(): array
    {
        return $this->classList;
    }

    /**
     * Remove every CSS class.
     */
    public function clearClassList(): self
    {
        $this->classList = [];

        return $this;
    }

    /**
     * Replace the CSS classes.
     */
    public function setClassList(array $classList): self
    {
        $this->classList = $classList;
        return $this;
    }

    /**
     * Add one or more CSS classes (string with spaces, or array). Duplicates are ignored.
     */
    public function addClass(mixed $class): self
    {
        if (is_array($class)) {
            foreach ($class as $itn) {
                $this->addClass($itn);
            }

            return $this;
        }

        if (is_string($class) && strpos($class, ' ') !== false) {
            $class = explode(' ', $class);
            return $this->addClass($class);
        }

        if (in_array($class, $this->classList) || empty($class)) {
            return $this;
        }

        $this->classList[] = $class;

        return $this;
    }

    /**
     * Set several data-* attributes. Nested arrays become dashed names
     * (["a" => ["b" => 1]] renders data-a-b="1").
     */
    public function setDataAttributes(array $dataAttributes, string $rad = ""): self
    {
        foreach ($dataAttributes as $dataAttribute => $value) {
            if (is_array($value)) {
                $this->setDataAttributes($value, $dataAttribute . '-');
                continue;
            }
            $this->setDataAttribute($rad . $dataAttribute, $value);
        }

        return $this;
    }

    /**
     * Get the data-* attributes (without the "data-" prefix).
     */
    public function getDataAttributes(): array
    {
        return $this->parametersData;
    }

    /**
     * Set one data-* attribute (pass the name without the "data-" prefix).
     */
    public function setDataAttribute(string $data, string|array $value): self
    {
        $this->parametersData[$data] = $value;
        return $this;
    }

    /**
     * Alias of setDataAttribute().
     */
    public function setData(string $data, string|array $value): self
    {
        return $this->setDataAttribute($data, $value);
    }

    /**
     * Fluent alias of setDataAttribute().
     */
    public function data(string $data, string|array $value): self
    {
        return $this->setDataAttribute($data, $value);
    }

    /**
     * Set several aria-* attributes. Nested arrays become dashed names.
     */
    public function setAriaAttributes(array $ariaAttributes, string $rad = ""): self
    {
        foreach ($ariaAttributes as $ariaAttribute => $value) {
            if (is_array($value)) {
                $this->setAriaAttributes($value, $rad . $ariaAttribute . '-');
                continue;
            }
            $this->setAriaAttribute($rad . $ariaAttribute, $value);
        }

        return $this;
    }

    /**
     * Get the aria-* attributes (without the "aria-" prefix).
     */
    public function getAriaAttributes(): array
    {
        return $this->parametersAria;
    }

    /**
     * Set one aria-* attribute (pass the name without the "aria-" prefix).
     */
    public function setAriaAttribute(string $aria, string $value): self
    {
        $this->parametersAria[$aria] = $value;
        return $this;
    }

    /**
     * Alias of setAriaAttribute().
     */
    public function setAria(string $aria, string $value): self
    {
        return $this->setAriaAttribute($aria, $value);
    }

    /**
     * Fluent alias of setAriaAttribute().
     */
    public function aria(string $aria, string $value): self
    {
        return $this->setAriaAttribute($aria, $value);
    }

    /**
     * Get the boolean attributes (required, disabled, checked...) and their state.
     */
    public function getBooleanAttributes(): array
    {
        return $this->parametersBoolean;
    }

    /**
     * Get the "id" attribute.
     */
    public function getId(): ?string
    {
        return $this->id ?? null;
    }

    /**
     * Set the "id" attribute.
     */
    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Fluent alias of setId().
     */
    public function id(?string $id): self
    {
        return $this->setId($id);
    }

    /**
     * Get the "name" attribute.
     */
    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    /**
     * Set the "name" attribute.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Fluent alias of setName().
     */
    public function name(?string $name): self
    {
        return $this->setName($name);
    }

    /**
     * Get the "title" attribute (tooltip text).
     */
    public function getTitle(): ?string
    {
        return $this->parameters['title'] ?? null;
    }

    /**
     * Set the "title" attribute (tooltip text).
     */
    public function setTitle(?string $title): self
    {
        return $this->setParameter('title', $title);
    }

    /**
     * Fluent alias of setTitle().
     */
    public function title(?string $title): self
    {
        return $this->setTitle($title);
    }

    /**
     * Set the "alt" attribute.
     */
    public function setAlt(?string $alt): self
    {
        return $this->setParameter('alt', $alt);
    }

    /**
     * Fluent alias of setAlt().
     */
    public function alt(?string $alt): self
    {
        return $this->setAlt($alt);
    }

    /**
     * Set the HTML tag name, e.g. "div".
     */
    public function setTagType(string $tagType): self
    {
        $this->tagType = $tagType;
        return $this;
    }

    /**
     * Get the HTML tag name.
     */
    public function getTagType(): ?string
    {
        return $this->tagType ?? null;
    }

    /**
     * Create the root <html> tag (the doctype is rendered automatically).
     *
     * @param mixed ...$args Attributes in "name => value" form.
     */
    public static function html(...$args): HTML
    {
        return new HTML(...$args);
    }

    /**
     * Create a <title> tag. Named tagTitle() because title() sets the attribute.
     *
     * @param string $title Document title.
     */
    public static function tagTitle(string $title): TITLE
    {
        return new TITLE($title);
    }

    /**
     * Create a <head> tag.
     *
     * @param mixed ...$args Accepted for consistency; attributes are disallowed.
     */
    public static function head(...$args): HEAD
    {
        return new HEAD(...$args);
    }

    /**
     * Create a <body> tag.
     *
     * @param mixed ...$args Attributes in "name => value" form.
     */
    public static function body(...$args): BODY
    {
        return new BODY(...$args);
    }

    /**
     * Create a <script> tag.
     *
     * @param string|null $src External script URL.
     * @param string|null $type MIME type or "module".
     * @param string|null $code Inline JavaScript code.
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public static function script(?string $src = null, ?string $type = null, ?string $code = null, mixed ...$args): SCRIPT
    {
        return new SCRIPT($src, $type, $code, ...$args);
    }

    /**
     * Create a <style> tag.
     *
     * @param string|null $src Optional "src" attribute.
     * @param string|null $code CSS code.
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public static function style(?string $src = null, ?string $code = null, mixed ...$args): STYLE
    {
        return new STYLE($src, $code, ...$args);
    }

    /**
     * Create an <object> tag (OBJECT is reserved in PHP, hence the name).
     *
     * @param mixed ...$args Attributes in "name => value" form.
     */
    public static function tagObject(...$args): TAG_OBJECT
    {
        return new TAG_OBJECT(...$args);
    }

    /**
     * Create a <button> tag.
     *
     * @param string|null $class CSS class(es), separated by spaces.
     * @param string|null $id Value of the "id" attribute.
     * @param string|null $name Name submitted with the form.
     * @param string|null $html Button label.
     * @param string|null $value Value submitted with the form.
     * @param string|null $type "button", "submit" or "reset".
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public static function button(?string $class = null, ?string $id = null, ?string $name = null, ?string $html = null, ?string $value = null, ?string $type = 'button', mixed ...$args): BUTTON
    {
        return new BUTTON($class, $id, $name, $html, $value, $type, ...$args);
    }

    /**
     * Create an <input> tag.
     *
     * @param string|null $class CSS class(es), separated by spaces.
     * @param string|null $id Value of the "id" attribute.
     * @param string|null $name Name submitted with the form.
     * @param string|null $value Initial value.
     * @param string|null $type Input type (text, email, number...).
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public static function input(?string $class = null, ?string $id = null, ?string $name = null, ?string $value = null, ?string $type = 'text', mixed ...$args): INPUT
    {
        return new INPUT($class, $id, $name, $value, $type, ...$args);
    }

    /**
     * Create an <option> tag.
     *
     * @param string $value Value submitted when selected.
     * @param string $text Text shown to the user.
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public static function option(string $value, string $text, mixed ...$args): OPTION
    {
        return new OPTION($value, $text, ...$args);
    }

    /**
     * Create a <caption> tag.
     *
     * @param string|null $class CSS class(es), separated by spaces.
     * @param string|null $id Value of the "id" attribute.
     * @param string|null $side CSS "caption-side": top or bottom.
     * @param string|null $align CSS "text-align".
     * @param string|null $html Caption text.
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public static function caption(?string $class = null, ?string $id = null, ?string $side = null, ?string $align = null, ?string $html = null, mixed ...$args): CAPTION
    {
        return new CAPTION($class, $id, $side, $align, $html, ...$args);
    }

    /**
     * Create a <a> tag.
     *
     * @param ?string $href Link destination.
     * @param ?string $html Initial inner content (text or HTML).
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return A
     */
    public static function a(?string $href = null, ?string $html = null, ?string $class = null, ?string $id = null, mixed ...$args): A
    {
        return new A($href, $html, $class, $id, ...$args);
    }

    /**
     * Create a <abbr> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return ABBR
     */
    public static function abbr(?string $class = null, ?string $html = null, mixed ...$args): ABBR
    {
        return new ABBR($class, $html, ...$args);
    }

    /**
     * Create a <address> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return ADDRESS
     */
    public static function address(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): ADDRESS
    {
        return new ADDRESS($class, $id, $html, ...$args);
    }

    /**
     * Create a <area> tag.
     *
     * @param ?string $href Link destination.
     * @param ?string $alt Alternative text.
     * @param ?string $shape One of: rect, circle, poly, default.
     * @param ?string $coords Comma separated coordinates matching the shape.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return AREA
     */
    public static function area(?string $href = null, ?string $alt = null, ?string $shape = null, ?string $coords = null, mixed ...$args): AREA
    {
        return new AREA($href, $alt, $shape, $coords, ...$args);
    }

    /**
     * Create a <article> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return ARTICLE
     */
    public static function article(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): ARTICLE
    {
        return new ARTICLE($class, $id, $html, ...$args);
    }

    /**
     * Create a <aside> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return ASIDE
     */
    public static function aside(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): ASIDE
    {
        return new ASIDE($class, $id, $html, ...$args);
    }

    /**
     * Create a <audio> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return AUDIO
     */
    public static function audio(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): AUDIO
    {
        return new AUDIO($class, $id, $html, ...$args);
    }

    /**
     * Create a <b> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return B
     */
    public static function b(?string $class = null, ?string $html = null, mixed ...$args): B
    {
        return new B($class, $html, ...$args);
    }

    /**
     * Create a <base> tag.
     *
     * @param ?string $href Base URL.
     * @param ?string $target Default browsing context, e.g. "_blank".
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return BASE
     */
    public static function base(?string $href = null, ?string $target = null, mixed ...$args): BASE
    {
        return new BASE($href, $target, ...$args);
    }

    /**
     * Create a <bdi> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return BDI
     */
    public static function bdi(?string $class = null, ?string $html = null, mixed ...$args): BDI
    {
        return new BDI($class, $html, ...$args);
    }

    /**
     * Create a <bdo> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return BDO
     */
    public static function bdo(?string $class = null, ?string $html = null, mixed ...$args): BDO
    {
        return new BDO($class, $html, ...$args);
    }

    /**
     * Create a <blockquote> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return BLOCKQUOTE
     */
    public static function blockquote(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): BLOCKQUOTE
    {
        return new BLOCKQUOTE($class, $id, $html, ...$args);
    }

    /**
     * Create a <br> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return BR
     */
    public static function br(?string $class = null, mixed ...$args): BR
    {
        return new BR($class, ...$args);
    }

    /**
     * Create a <canvas> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return CANVAS
     */
    public static function canvas(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): CANVAS
    {
        return new CANVAS($class, $id, $html, ...$args);
    }

    /**
     * Create a <cite> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return CITE
     */
    public static function cite(?string $class = null, ?string $html = null, mixed ...$args): CITE
    {
        return new CITE($class, $html, ...$args);
    }

    /**
     * Create a <code> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return CODE
     */
    public static function code(?string $class = null, ?string $html = null, mixed ...$args): CODE
    {
        return new CODE($class, $html, ...$args);
    }

    /**
     * Create a <col> tag.
     *
     * @param ?int $span Number of columns the element spans.
     * @param ?string $class CSS class(es), separated by spaces.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return COL
     */
    public static function tagCol(?int $span = null, ?string $class = null, mixed ...$args): COL
    {
        return new COL($span, $class, ...$args);
    }

    /**
     * Create a <colgroup> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return COLGROUP
     */
    public static function colgroup(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): COLGROUP
    {
        return new COLGROUP($class, $id, $html, ...$args);
    }

    /**
     * Create a <datalist> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return DATALIST
     */
    public static function datalist(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): DATALIST
    {
        return new DATALIST($class, $id, $html, ...$args);
    }

    /**
     * Create a <dd> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return DD
     */
    public static function dd(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): DD
    {
        return new DD($class, $id, $html, ...$args);
    }

    /**
     * Create a <del> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return DEL
     */
    public static function del(?string $class = null, ?string $html = null, mixed ...$args): DEL
    {
        return new DEL($class, $html, ...$args);
    }

    /**
     * Create a <details> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return DETAILS
     */
    public static function details(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): DETAILS
    {
        return new DETAILS($class, $id, $html, ...$args);
    }

    /**
     * Create a <dfn> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return DFN
     */
    public static function dfn(?string $class = null, ?string $html = null, mixed ...$args): DFN
    {
        return new DFN($class, $html, ...$args);
    }

    /**
     * Create a <dialog> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return DIALOG
     */
    public static function dialog(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): DIALOG
    {
        return new DIALOG($class, $id, $html, ...$args);
    }

    /**
     * Create a <div> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return DIV
     */
    public static function div(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): DIV
    {
        return new DIV($class, $id, $html, ...$args);
    }

    /**
     * Create a <dl> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return DL
     */
    public static function dl(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): DL
    {
        return new DL($class, $id, $html, ...$args);
    }

    /**
     * Create a <dt> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return DT
     */
    public static function dt(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): DT
    {
        return new DT($class, $id, $html, ...$args);
    }

    /**
     * Create a <em> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return EM
     */
    public static function em(?string $class = null, ?string $html = null, mixed ...$args): EM
    {
        return new EM($class, $html, ...$args);
    }

    /**
     * Create a <embed> tag.
     *
     * @param ?string $type MIME type of the content.
     * @param ?string $src Content URL.
     * @param ?int $width Width in CSS pixels.
     * @param ?int $height Height in CSS pixels.
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return EMBED
     */
    public static function embed(?string $type = null, ?string $src = null, ?int $width = null, ?int $height = null, ?string $class = null, ?string $id = null, mixed ...$args): EMBED
    {
        return new EMBED($type, $src, $width, $height, $class, $id, ...$args);
    }

    /**
     * Create a <fieldset> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return FIELDSET
     */
    public static function fieldset(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): FIELDSET
    {
        return new FIELDSET($class, $id, $html, ...$args);
    }

    /**
     * Create a <figcaption> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return FIGCAPTION
     */
    public static function figcaption(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): FIGCAPTION
    {
        return new FIGCAPTION($class, $id, $html, ...$args);
    }

    /**
     * Create a <figure> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return FIGURE
     */
    public static function figure(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): FIGURE
    {
        return new FIGURE($class, $id, $html, ...$args);
    }

    /**
     * Create a <footer> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return FOOTER
     */
    public static function footer(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): FOOTER
    {
        return new FOOTER($class, $id, $html, ...$args);
    }

    /**
     * Create a <form> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $action URL that processes the submission.
     * @param ?string $method HTTP method: "get" or "post".
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return FORM
     */
    public static function form(?string $class = null, ?string $action = null, ?string $method = null, ?string $id = null, ?string $html = null, mixed ...$args): FORM
    {
        return new FORM($class, $action, $method, $id, $html, ...$args);
    }

    /**
     * Create a <h1> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return H1
     */
    public static function h1(?string $class = null, ?string $html = null, mixed ...$args): H1
    {
        return new H1($class, $html, ...$args);
    }

    /**
     * Create a <h2> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return H2
     */
    public static function h2(?string $class = null, ?string $html = null, mixed ...$args): H2
    {
        return new H2($class, $html, ...$args);
    }

    /**
     * Create a <h3> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return H3
     */
    public static function h3(?string $class = null, ?string $html = null, mixed ...$args): H3
    {
        return new H3($class, $html, ...$args);
    }

    /**
     * Create a <h4> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return H4
     */
    public static function h4(?string $class = null, ?string $html = null, mixed ...$args): H4
    {
        return new H4($class, $html, ...$args);
    }

    /**
     * Create a <h5> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return H5
     */
    public static function h5(?string $class = null, ?string $html = null, mixed ...$args): H5
    {
        return new H5($class, $html, ...$args);
    }

    /**
     * Create a <h6> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return H6
     */
    public static function h6(?string $class = null, ?string $html = null, mixed ...$args): H6
    {
        return new H6($class, $html, ...$args);
    }

    /**
     * Create a <header> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return HEADER
     */
    public static function header(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): HEADER
    {
        return new HEADER($class, $id, $html, ...$args);
    }

    /**
     * Create a <hgroup> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return HGROUP
     */
    public static function hgroup(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): HGROUP
    {
        return new HGROUP($class, $id, $html, ...$args);
    }

    /**
     * Create a <hr> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return HR
     */
    public static function hr(?string $class = null, mixed ...$args): HR
    {
        return new HR($class, ...$args);
    }

    /**
     * Create a <i> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return I
     */
    public static function i(?string $class = null, ?string $html = null, mixed ...$args): I
    {
        return new I($class, $html, ...$args);
    }

    /**
     * Create a <iframe> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return IFRAME
     */
    public static function iframe(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): IFRAME
    {
        return new IFRAME($class, $id, $html, ...$args);
    }

    /**
     * Create a <img> tag.
     *
     * @param ?string $src Image URL.
     * @param ?string $alt Alternative text (important for accessibility).
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return IMG
     */
    public static function img(?string $src = null, ?string $alt = null, ?string $class = null, ?string $id = null, mixed ...$args): IMG
    {
        return new IMG($src, $alt, $class, $id, ...$args);
    }

    /**
     * Create a <ins> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return INS
     */
    public static function ins(?string $class = null, ?string $html = null, mixed ...$args): INS
    {
        return new INS($class, $html, ...$args);
    }

    /**
     * Create a <kbd> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return KBD
     */
    public static function kbd(?string $class = null, ?string $html = null, mixed ...$args): KBD
    {
        return new KBD($class, $html, ...$args);
    }

    /**
     * Create a <label> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $for The "id" of the control this label belongs to.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return LABEL
     */
    public static function label(?string $class = null, ?string $id = null, ?string $for = null, ?string $html = null, mixed ...$args): LABEL
    {
        return new LABEL($class, $id, $for, $html, ...$args);
    }

    /**
     * Create a <legend> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return LEGEND
     */
    public static function legend(?string $class = null, ?string $html = null, mixed ...$args): LEGEND
    {
        return new LEGEND($class, $html, ...$args);
    }

    /**
     * Create a <li> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return LI
     */
    public static function li(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): LI
    {
        return new LI($class, $id, $html, ...$args);
    }

    /**
     * Create a <link> tag.
     *
     * @param ?string $href Resource URL.
     * @param ?string $rel Relationship, e.g. "stylesheet".
     * @param ?string $type MIME type, e.g. "text/css".
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return LINK
     */
    public static function link(?string $href = null, ?string $rel = null, ?string $type = null, mixed ...$args): LINK
    {
        return new LINK($href, $rel, $type, ...$args);
    }

    /**
     * Create a <main> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return MAIN
     */
    public static function main(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): MAIN
    {
        return new MAIN($class, $id, $html, ...$args);
    }

    /**
     * Create a <map> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return MAP
     */
    public static function map(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): MAP
    {
        return new MAP($class, $id, $html, ...$args);
    }

    /**
     * Create a <mark> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return MARK
     */
    public static function mark(?string $class = null, ?string $html = null, mixed ...$args): MARK
    {
        return new MARK($class, $html, ...$args);
    }

    /**
     * Create a <menu> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return MENU
     */
    public static function menu(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): MENU
    {
        return new MENU($class, $id, $html, ...$args);
    }

    /**
     * Create a <meta> tag.
     *
     * @param string $name Metadata name, e.g. "viewport" (or use "charset" through $args).
     * @param string $content Metadata value (rendered as the "content" attribute).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return META
     */
    public static function meta(string $name = '', string $content = '', mixed ...$args): META
    {
        return new META($name, $content, ...$args);
    }

    /**
     * Create a <meter> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return METER
     */
    public static function meter(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): METER
    {
        return new METER($class, $id, $html, ...$args);
    }

    /**
     * Create a <nav> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return NAV
     */
    public static function nav(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): NAV
    {
        return new NAV($class, $id, $html, ...$args);
    }

    /**
     * Create a <noscript> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return NOSCRIPT
     */
    public static function noscript(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): NOSCRIPT
    {
        return new NOSCRIPT($class, $id, $html, ...$args);
    }

    /**
     * Create a <ol> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return OL
     */
    public static function ol(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): OL
    {
        return new OL($class, $id, $html, ...$args);
    }

    /**
     * Create a <optgroup> tag.
     *
     * @param ?string $label Name of the group.
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return OPTGROUP
     */
    public static function optgroup(?string $label = null, ?string $class = null, ?string $html = null, mixed ...$args): OPTGROUP
    {
        return new OPTGROUP($label, $class, $html, ...$args);
    }

    /**
     * Create a <output> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return OUTPUT
     */
    public static function output(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): OUTPUT
    {
        return new OUTPUT($class, $id, $html, ...$args);
    }

    /**
     * Create a <p> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return P
     */
    public static function p(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): P
    {
        return new P($class, $id, $html, ...$args);
    }

    /**
     * Create a <param> tag.
     *
     * @param string $name Parameter name.
     * @param string $value Parameter value.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return PARAM
     */
    public static function param(string $name = '', string $value = '', mixed ...$args): PARAM
    {
        return new PARAM($name, $value, ...$args);
    }

    /**
     * Create a <picture> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return PICTURE
     */
    public static function picture(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): PICTURE
    {
        return new PICTURE($class, $id, $html, ...$args);
    }

    /**
     * Create a <pre> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return PRE
     */
    public static function pre(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): PRE
    {
        return new PRE($class, $id, $html, ...$args);
    }

    /**
     * Create a <progress> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return PROGRESS
     */
    public static function progress(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): PROGRESS
    {
        return new PROGRESS($class, $id, $html, ...$args);
    }

    /**
     * Create a <q> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return Q
     */
    public static function q(?string $class = null, ?string $html = null, mixed ...$args): Q
    {
        return new Q($class, $html, ...$args);
    }

    /**
     * Create a <rp> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return RP
     */
    public static function rp(?string $class = null, ?string $html = null, mixed ...$args): RP
    {
        return new RP($class, $html, ...$args);
    }

    /**
     * Create a <rt> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return RT
     */
    public static function rt(?string $class = null, ?string $html = null, mixed ...$args): RT
    {
        return new RT($class, $html, ...$args);
    }

    /**
     * Create a <ruby> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return RUBY
     */
    public static function ruby(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): RUBY
    {
        return new RUBY($class, $id, $html, ...$args);
    }

    /**
     * Create a <s> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return S
     */
    public static function s(?string $class = null, ?string $html = null, mixed ...$args): S
    {
        return new S($class, $html, ...$args);
    }

    /**
     * Create a <samp> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SAMP
     */
    public static function samp(?string $class = null, ?string $html = null, mixed ...$args): SAMP
    {
        return new SAMP($class, $html, ...$args);
    }

    /**
     * Create a <search> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SEARCH
     */
    public static function search(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): SEARCH
    {
        return new SEARCH($class, $id, $html, ...$args);
    }

    /**
     * Create a <section> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SECTION
     */
    public static function section(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): SECTION
    {
        return new SECTION($class, $id, $html, ...$args);
    }

    /**
     * Create a <select> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $name Name submitted with the form.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SELECT
     */
    public static function select(?string $class = null, ?string $id = null, ?string $name = null, ?string $html = null, mixed ...$args): SELECT
    {
        return new SELECT($class, $id, $name, $html, ...$args);
    }

    /**
     * Create a <slot> tag.
     *
     * @param ?string $name Slot name.
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SLOT
     */
    public static function slot(?string $name = null, ?string $class = null, ?string $html = null, mixed ...$args): SLOT
    {
        return new SLOT($name, $class, $html, ...$args);
    }

    /**
     * Create a <small> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SMALL
     */
    public static function small(?string $class = null, ?string $html = null, mixed ...$args): SMALL
    {
        return new SMALL($class, $html, ...$args);
    }

    /**
     * Create a <source> tag.
     *
     * @param ?string $src Resource URL (use "srcset" through $args for PICTURE).
     * @param ?string $type MIME type, e.g. "video/mp4".
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SOURCE
     */
    public static function source(?string $src = null, ?string $type = null, mixed ...$args): SOURCE
    {
        return new SOURCE($src, $type, ...$args);
    }

    /**
     * Create a <span> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SPAN
     */
    public static function span(?string $class = null, ?string $html = null, mixed ...$args): SPAN
    {
        return new SPAN($class, $html, ...$args);
    }

    /**
     * Create a <strong> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return STRONG
     */
    public static function strong(?string $class = null, ?string $html = null, mixed ...$args): STRONG
    {
        return new STRONG($class, $html, ...$args);
    }

    /**
     * Create a <sub> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SUB
     */
    public static function sub(?string $class = null, ?string $html = null, mixed ...$args): SUB
    {
        return new SUB($class, $html, ...$args);
    }

    /**
     * Create a <summary> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SUMMARY
     */
    public static function summary(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): SUMMARY
    {
        return new SUMMARY($class, $id, $html, ...$args);
    }

    /**
     * Create a <sup> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return SUP
     */
    public static function sup(?string $class = null, ?string $html = null, mixed ...$args): SUP
    {
        return new SUP($class, $html, ...$args);
    }

    /**
     * Create a <table> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return TABLE
     */
    public static function table(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): TABLE
    {
        return new TABLE($class, $id, $html, ...$args);
    }

    /**
     * Create a <data> tag.
     *
     * @param ?string $value Machine-readable value.
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return DATA
     */
    public static function tagData(?string $value = null, ?string $class = null, ?string $html = null, mixed ...$args): DATA
    {
        return new DATA($value, $class, $html, ...$args);
    }

    /**
     * Create a <tbody> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return TBODY
     */
    public static function tbody(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): TBODY
    {
        return new TBODY($class, $id, $html, ...$args);
    }

    /**
     * Create a <td> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return TD
     */
    public static function td(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): TD
    {
        return new TD($class, $id, $html, ...$args);
    }

    /**
     * Create a <template> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return TEMPLATE
     */
    public static function template(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): TEMPLATE
    {
        return new TEMPLATE($class, $id, $html, ...$args);
    }

    /**
     * Create a <textarea> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $name Name submitted with the form.
     * @param mixed $placeholder Hint displayed while the field is empty.
     * @param ?string $html Initial text of the field.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return TEXTAREA
     */
    public static function textarea(?string $class = null, ?string $id = null, ?string $name = null, mixed $placeholder = null, ?string $html = null, mixed ...$args): TEXTAREA
    {
        return new TEXTAREA($class, $id, $name, $placeholder, $html, ...$args);
    }

    /**
     * Create a <tfoot> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return TFOOT
     */
    public static function tfoot(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): TFOOT
    {
        return new TFOOT($class, $id, $html, ...$args);
    }

    /**
     * Create a <th> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return TH
     */
    public static function th(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): TH
    {
        return new TH($class, $id, $html, ...$args);
    }

    /**
     * Create a <thead> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return THEAD
     */
    public static function thead(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): THEAD
    {
        return new THEAD($class, $id, $html, ...$args);
    }

    /**
     * Create a <time> tag.
     *
     * @param ?string $datetime Machine-readable value, e.g. "2024-05-01".
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return TIME
     */
    public static function time(?string $datetime = null, ?string $class = null, ?string $html = null, mixed ...$args): TIME
    {
        return new TIME($datetime, $class, $html, ...$args);
    }

    /**
     * Create a <tr> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return TR
     */
    public static function tr(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): TR
    {
        return new TR($class, $id, $html, ...$args);
    }

    /**
     * Create a <track> tag.
     *
     * @param ?string $src Track file URL (WebVTT).
     * @param ?string $kind One of: subtitles, captions, descriptions, chapters, metadata.
     * @param ?string $srclang Language of the track text, e.g. "en".
     * @param ?string $label User-visible title of the track.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return TRACK
     */
    public static function track(?string $src = null, ?string $kind = null, ?string $srclang = null, ?string $label = null, mixed ...$args): TRACK
    {
        return new TRACK($src, $kind, $srclang, $label, ...$args);
    }

    /**
     * Create a <u> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return U
     */
    public static function u(?string $class = null, ?string $html = null, mixed ...$args): U
    {
        return new U($class, $html, ...$args);
    }

    /**
     * Create a <ul> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return UL
     */
    public static function ul(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): UL
    {
        return new UL($class, $id, $html, ...$args);
    }

    /**
     * Create a <var> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return VARIABLE
     */
    public static function variable(?string $class = null, ?string $html = null, mixed ...$args): VARIABLE
    {
        return new VARIABLE($class, $html, ...$args);
    }

    /**
     * Create a <video> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return VIDEO
     */
    public static function video(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args): VIDEO
    {
        return new VIDEO($class, $id, $html, ...$args);
    }

    /**
     * Create a <wbr> tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param mixed ...$args Extra attributes in "name => value" form.
     * @return WBR
     */
    public static function wbr(?string $class = null, mixed ...$args): WBR
    {
        return new WBR($class, ...$args);
    }

    /**
     * Create a UL_LIST: a unordered list (<ul>) built from a list of children (LI).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function ulList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\UL_LIST
    {
        return new \CN\PHTML\Lists\UL_LIST($items, ...$args);
    }

    /**
     * Create a OL_LIST: a ordered list (<ol>) built from a list of children (LI).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function olList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\OL_LIST
    {
        return new \CN\PHTML\Lists\OL_LIST($items, ...$args);
    }

    /**
     * Create a MENU_LIST: a menu (<menu>) built from a list of children (LI).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function menuList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\MENU_LIST
    {
        return new \CN\PHTML\Lists\MENU_LIST($items, ...$args);
    }

    /**
     * Create a SELECT_LIST: a drop-down list (<select>) built from a list of children (OPTION, OPTGROUP).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function selectList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\SELECT_LIST
    {
        return new \CN\PHTML\Lists\SELECT_LIST($items, ...$args);
    }

    /**
     * Create a OPTGROUP_LIST: a option group (<optgroup>) built from a list of children (OPTION).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function optgroupList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\OPTGROUP_LIST
    {
        return new \CN\PHTML\Lists\OPTGROUP_LIST($items, ...$args);
    }

    /**
     * Create a DATALIST_LIST: a suggestion list (<datalist>) built from a list of children (OPTION).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function datalistList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\DATALIST_LIST
    {
        return new \CN\PHTML\Lists\DATALIST_LIST($items, ...$args);
    }

    /**
     * Create a TABLE_LIST: a table (<table>) built from a list of children (CAPTION, COLGROUP, THEAD, TBODY, TFOOT, TR).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function tableList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\TABLE_LIST
    {
        return new \CN\PHTML\Lists\TABLE_LIST($items, ...$args);
    }

    /**
     * Create a THEAD_LIST: a table header (<thead>) built from a list of children (TR).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function theadList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\THEAD_LIST
    {
        return new \CN\PHTML\Lists\THEAD_LIST($items, ...$args);
    }

    /**
     * Create a TBODY_LIST: a table body (<tbody>) built from a list of children (TR).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function tbodyList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\TBODY_LIST
    {
        return new \CN\PHTML\Lists\TBODY_LIST($items, ...$args);
    }

    /**
     * Create a TFOOT_LIST: a table footer (<tfoot>) built from a list of children (TR).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function tfootList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\TFOOT_LIST
    {
        return new \CN\PHTML\Lists\TFOOT_LIST($items, ...$args);
    }

    /**
     * Create a TR_LIST: a table row (<tr>) built from a list of children (TH, TD).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function trList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\TR_LIST
    {
        return new \CN\PHTML\Lists\TR_LIST($items, ...$args);
    }

    /**
     * Create a COLGROUP_LIST: a column group (<colgroup>) built from a list of children (COL).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function colgroupList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\COLGROUP_LIST
    {
        return new \CN\PHTML\Lists\COLGROUP_LIST($items, ...$args);
    }

    /**
     * Create a DL_LIST: a description list (<dl>) built from a list of children (DT, DD).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function dlList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\DL_LIST
    {
        return new \CN\PHTML\Lists\DL_LIST($items, ...$args);
    }

    /**
     * Create a HEAD_LIST: a document head (<head>) built from a list of children (TITLE, META, LINK, BASE, SCRIPT, STYLE, NOSCRIPT, TEMPLATE).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function headList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\HEAD_LIST
    {
        return new \CN\PHTML\Lists\HEAD_LIST($items, ...$args);
    }

    /**
     * Create a HTML_LIST: a root element (<html>) built from a list of children (HEAD, BODY).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function htmlList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\HTML_LIST
    {
        return new \CN\PHTML\Lists\HTML_LIST($items, ...$args);
    }

    /**
     * Create a PICTURE_LIST: a responsive image (<picture>) built from a list of children (SOURCE, IMG).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function pictureList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\PICTURE_LIST
    {
        return new \CN\PHTML\Lists\PICTURE_LIST($items, ...$args);
    }

    /**
     * Create a AUDIO_LIST: a audio player (<audio>) built from a list of children (SOURCE, TRACK).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function audioList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\AUDIO_LIST
    {
        return new \CN\PHTML\Lists\AUDIO_LIST($items, ...$args);
    }

    /**
     * Create a VIDEO_LIST: a video player (<video>) built from a list of children (SOURCE, TRACK).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function videoList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\VIDEO_LIST
    {
        return new \CN\PHTML\Lists\VIDEO_LIST($items, ...$args);
    }

    /**
     * Create a MAP_LIST: a image map (<map>) built from a list of children (AREA).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function mapList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\MAP_LIST
    {
        return new \CN\PHTML\Lists\MAP_LIST($items, ...$args);
    }

    /**
     * Create a RUBY_LIST: a ruby annotation (<ruby>) built from a list of children (RT, RP).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function rubyList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\RUBY_LIST
    {
        return new \CN\PHTML\Lists\RUBY_LIST($items, ...$args);
    }

    /**
     * Create a HGROUP_LIST: a heading group (<hgroup>) built from a list of children (H1, H2, H3, H4, H5, H6, P).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function hgroupList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\HGROUP_LIST
    {
        return new \CN\PHTML\Lists\HGROUP_LIST($items, ...$args);
    }

    /**
     * Create a TAG_OBJECT_LIST: a external object (<object>) built from a list of children (PARAM).
     *
     * @param iterable $items Children, as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of the matching plain tag.
     */
    public static function tagObjectList(iterable $items = [], mixed ...$args): \CN\PHTML\Lists\TAG_OBJECT_LIST
    {
        return new \CN\PHTML\Lists\TAG_OBJECT_LIST($items, ...$args);
    }
}
