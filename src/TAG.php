<?php

namespace PHTML;

use PHTML\Exceptions\ContentNotAllowedException;
use PHTML\Exceptions\ParametersNotAllowedException;

class TAG
{
    private TAG $parent;

    private ?string $tagType;
    private ?string $id;
    private ?string $name;

    private array $classList = [];
    private array $parameters = [];
    private array $appendList = [];
    private array $appendAfterList = [];
    private array $appendBeforeList = [];

    protected array $permAttr = [
        'id', 'name', 'value', 'src', 'href', 'placeholder',
        'style', 'width', 'height', 'max', 'min', 'title', 'alt',
        'type', 'method', 'action'
    ];
    protected array $permBooleanAttr = [
        'checked', 'disabled', 'multiple', 'readonly', 'required',
        'selected', 'autoplay', 'muted', 'playsinline'
    ];
    protected bool $allowParameter = true;
    protected bool $allowContent = true;

    public function __toString()
    {
        return self::render();
    }

    public function render(): string
    {
        $html = "";
        if (!empty($this->appendBeforeList)) {
            foreach ($this->appendBeforeList as $element) {
                $html .= $element;
            }
        }
        $html .= "<{$this->tagType}";

        if (!empty($this->classList)) {
            $html .= " class=\"" . join(' ', $this->classList) . "\"";
        }

        if (!empty($this->id)) {
            $html .= " id=\"{$this->getId()}\"";
        }

        if (!empty($this->name)) {
            $html .= " name=\"{$this->getName()}\"";
        }

        foreach ($this->parameters as $parameter => $value) {
            if (is_array($value)) {
                $value = join(' ', $value);
            }
            $html .= " {$parameter}=\"{$value}\"";
        }

        if (!$this->isAllowContent()) {
            $html .= " />";
            return $html;
        }

        $html .= ">";

        foreach ($this->appendList as $element) {
            $html .= $element;
        }

        $html .= "</{$this->tagType}>";

        if (!empty($this->appendAfterList)) {
            foreach ($this->appendAfterList as $element) {
                $html .= $element;
            }
        }

        return $html;
    }

    public function getParent(): ?TAG
    {
        return $this->parent ?? null;
    }

    public function setParent(?TAG $parent): self
    {
        $this->parent = $parent;
        return $this;
    }

    public function getAppendList(): array
    {
        return $this->appendList;
    }

    public function setAppendList(array $appendList): self
    {
        $this->appendList = $appendList;
        return $this;
    }

    public function append(TAG | string | array | null $content): self
    {
        if (!$this->isAllowContent()) {
            throw new ContentNotAllowedException($this->tagType);
        }

        if (empty($content)) {
            return $this;
        }

        if (is_array($content)) {
            foreach ($content as $element) {
                $this->append($element);
            }
            return $this;
        }

        if ($content instanceof TAG) {
            $content->setParent($this);
        }

        $this->appendList[] = $content;

        return $this;
    }

    public function getAppendBeforeList(): array
    {
        return $this->appendBeforeList;
    }

    public function setAppendBeforeList(array $appendList): self
    {
        $this->appendBeforeList = $appendList;
        return $this;
    }

    public function appendBefore(string | array | TAG $content): self
    {
        if (!$this->isAllowContent()) {
            throw new ContentNotAllowedException($this->tagType);
        }

        if (is_array($content)) {
            foreach ($content as $element) {
                $this->appendBeforeList[] = $element;
            }
            return $this;
        }

        if ($content instanceof TAG) {
            $content->setParent($this->getParent());
        }
        $this->appendBeforeList[] = $content;

        return $this;
    }

    public function getAppendAfterList(): array
    {
        return $this->appendAfterList;
    }

    public function setAppendAfterList(array $appendList): self
    {
        $this->appendAfterList = $appendList;
        return $this;
    }

    public function appendAfter(string | array | TAG $content): self
    {
        if (!$this->isAllowContent()) {
            throw new ContentNotAllowedException($this->tagType);
        }

        if (is_array($content)) {
            foreach ($content as $element) {
                $this->appendAfterList[] = $element;
            }
            return $this;
        }

        if ($content instanceof TAG) {
            $content->setParent($this->getParent());
        }
        $this->appendAfterList[] = $content;

        return $this;
    }

    public function isAllowContent(): bool
    {
        return $this->allowContent;
    }

    public function setAllowContent(bool $allowContent = true): self
    {
        $this->allowContent = $allowContent;
        return $this;
    }

    public function allowContent(bool $allowContent = true): self
    {
        return $this->setAllowContent($allowContent);
    }

    public function isAllowedParameter(): bool
    {
        return $this->allowParameter;
    }

    public function setAllowParameter(bool $allowParameter = true): self
    {
        $this->allowParameter = $allowParameter;
        return $this;
    }

    public function allowParameter(bool $allowParameter = true): self
    {
        return $this->setAllowParameter($allowParameter);
    }

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

        $this->parameters[$parameter] = $value;

        return $this;
    }

    public function setAttribute(string $attribute, mixed $value): self
    {
        return $this->setParameter($attribute, $value);
    }

    public function setAttr(string $attribute, mixed $value): self
    {
        return $this->setParameter($attribute, $value);
    }

    public function getClassList(): array
    {
        return $this->classList;
    }

    public function clearClassList(): self
    {
        $this->classList = [];

        return $this;
    }

    public function setClassList(array $classList): self
    {
        $this->classList = $classList;
        return $this;
    }

    public function addClass(mixed $class): self
    {
        if (is_array($class)) {
            foreach ($class as $itn) {
                $this->addClass($itn);
            }

            return $this;
        }

        if (in_array($class, $this->classList)) {
            return $this;
        }

        $this->classList[] = $class;

        return $this;
    }

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

    public function setDataAttribute(string $data, string | array $value): self
    {
        return $this->setParameter("data-{$data}", $value);
    }

    public function setData(string $data, string | array $value): self
    {
        return $this->setDataAttribute($data, $value);
    }

    public function data(string $data, string | array $value): self
    {
        return $this->setDataAttribute($data, $value);
    }

    public function setAriaAttributes(array $ariaAttributes): self
    {
        foreach ($ariaAttributes as $ariaAttribute => $value) {
            $this->setAriaAttribute($ariaAttribute, $value);
        }

        return $this;
    }

    public function setAriaAttribute(string $aria, string | array $value): self
    {
        return $this->setParameter("aria-{$aria}", $value);
    }

    public function setAria(string $aria, string | array $value): self
    {
        return $this->setAriaAttribute($aria, $value);
    }

    public function aria(string $aria, string $value): self
    {
        return $this->setAriaAttribute($aria, $value);
    }

    public function getId(): ?string
    {
        return $this->id ?? null;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function id(?string $id): self
    {
        return $this->setId($id);
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function name(string $name): self
    {
        return $this->setName($name);
    }

    public function getTitle(): ?string
    {
        return $this->parameters['title'] ?? null;
    }

    public function setTitle(string $title): self
    {
        return $this->setParameter('title', $title);
    }

    public function title(string $title): self
    {
        return $this->setTitle($title);
    }

    public function setAlt(string $alt): self
    {
        return $this->setParameter('alt', $alt);
    }

    public function alt(string $alt): self
    {
        return $this->setAlt($alt);
    }

    public function setTagType(string $tagType): self
    {
        $this->tagType = $tagType;
        return $this;
    }

    public static function html(...$args): HTML
    {
        return new HTML(...$args);
    }

    public static function tagTitle(string $title): TITLE
    {
        return new TITLE($title);
    }

    public static function meta(string $name, string $value, ...$args): META
    {
        return new META($name, $value, $args);
    }

    public static function link(?string $href = null, ?string $rel = null, ?string $type = null, ...$args): LINK
    {
        return new LINK($href, $rel, $type, $args);
    }

    public static function script(?string $src = null, ?string $type = null, ?string $code = null, ...$args): SCRIPT
    {
        return new SCRIPT($src, $type, $code, $args);
    }

    public static function style(?string $src = null, ?string $code = null, ...$args): STYLE
    {
        return new STYLE($src, $code, $args);
    }

    public static function head(...$args): HEAD
    {
        return new HEAD(...$args);
    }

    public static function body(...$args): BODY
    {
        return new BODY(...$args);
    }

    public static function div(?string $class = null, ?string $id = null, ?string $html = null, ...$args): DIV
    {
        return new DIV($class, $id, $html, $args);
    }

    public static function nav(?string $class = null, ?string $id = null, mixed $html = null, ...$args): NAV
    {
        return new NAV($class, $id, $html, $args);
    }

    public static function header(?string $class = null, ?string $id = null, mixed $html = null, ...$args): HEADER
    {
        return new HEADER($class, $id, $html, $args);
    }

    public static function footer(?string $class = null, ?string $id = null, mixed $html = null, ...$args): FOOTER
    {
        return new FOOTER($class, $id, $html, $args);
    }

    public static function form(?string $class = null, ?string $action = null, ?string $method = null, ?string $id = null, mixed $html = null, ...$args): FORM
    {
        return new FORM($class, $action, $method, $id, $html, $args);
    }

    public static function table(?string $class = null, ?string $id = null, mixed $html = null, ...$args): TABLE
    {
        return new TABLE($class, $id, $html, $args);
    }

    public static function thead(?string $class = null, ?string $id = null, mixed $append = null, ...$args): THEAD
    {
        return new THEAD($class, $id, $append, $args);
    }

    public static function tbody(?string $class = null, ?string $id = null, mixed $html = null, ...$args): TBODY
    {
        return new TBODY($class, $id, $html, $args);
    }

    public static function tfoot(?string $class = null, ?string $id = null, mixed $html = null, ...$args): TFOOT
    {
        return new TFOOT($class, $id, $html, $args);
    }

    public static function tr(?string $class = null, ?string $id = null, mixed $html = null, ...$args): TR
    {
        return new TR($class, $id, $html, $args);
    }

    public static function th(?string $class = null, ?string $id = null, mixed $html = null, ...$args): TH
    {
        return new TH($class, $id, $html, $args);
    }

    public static function td(?string $class = null, ?string $id = null, mixed $html = null, ...$args): TD
    {
        return new TD($class, $id, $html, $args);
    }

    public static function h1(?string $class = null, mixed $append = null, ...$args): H1
    {
        return new H1($class, $append, $args);
    }

    public static function h2(?string $class = null, mixed $append = null, ...$args): H2
    {
        return new H2($class, $append, $args);
    }

    public static function h3(?string $class = null, mixed $append = null, ...$args): H3
    {
        return new H3($class, $append, $args);
    }

    public static function h4(?string $class = null, mixed $append = null, ...$args): H4
    {
        return new H4($class, $append, $args);
    }

    public static function h5(?string $class = null, mixed $append = null, ...$args): H5
    {
        return new H5($class, $append, $args);
    }

    public static function h6(?string $class = null, mixed $append = null, ...$args): H6
    {
        return new H6($class, $append, $args);
    }

    public static function hr(): HR
    {
        return new HR();
    }

    public static function a(...$args): A
    {
        return new A(...$args);
    }

    public static function p(?string $class = null, ?string $id = null, mixed $append = null, ...$args): P
    {
        return new P($class, $id, $append, $args);
    }

    public static function ul(...$args): UL
    {
        return new UL(...$args);
    }

    public static function ol(...$args): OL
    {
        return new OL(...$args);
    }

    public static function li(...$args): LI
    {
        return new LI(...$args);
    }
}
