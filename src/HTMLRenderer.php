<?php

namespace CN\PHTML;

use CN\PHTML\Core\TAG;

class HTMLRenderer
{
    public function __construct(private TAG $rootTag)
    {
        $this->rootTag = $rootTag;
    }

    private function renderProp(string $prop, string $value): string
    {
        return " {$prop}=\"{$value}\"";
    }

    protected function renderStartTag(): string
    {
        $html = $this->renderAppendBeforeList();
        $html .= "<{$this->rootTag->getTagType()}";

        return $html;
    }

    protected function renderCloseTag(): string
    {
        if (!$this->rootTag->isAllowContent()) {
            return " />";
        }

        return "</{$this->rootTag->getTagType()}>";
    }

    protected function renderTagAttributes(): string
    {
        $html = $this->renderClasslist();
        $html .= $this->renderId();
        $html .= $this->renderName();
        $html .= $this->renderParameters();
        $html .= $this->renderStyleAttributes();
        $html .= $this->renderDataParameters();
        $html .= $this->renderAriaParameters();
        $html .= $this->renderBooleanParameters();

        return $html;
    }
    
    private function renderClasslist(): ?string
    {
        if (!empty($this->rootTag->getClassList())) {
            return $this->renderProp('class', join(' ', $this->rootTag->getClassList()));
        }

        return null;
    }

    private function renderId(): ?string
    {
        if (!empty($this->rootTag->getId())) {
            return $this->renderProp('id', $this->rootTag->getId());
        }

        return null;
    }

    private function renderName(): ?string
    {
        if (!empty($this->rootTag->getName())) {
            return $this->renderProp('name', $this->rootTag->getName());
        }

        return null;
    }

    private function renderParameters(): ?string
    {
        $html = "";
        foreach ($this->rootTag->getParameters() as $parameter => $value) {
            if (is_array($value)) {
                $value = join(' ', $value);
            }

            $html .= $this->renderProp($parameter, $value);
        }

        return ($html !== "") ? $html : null;
    }

    private function renderStyleAttributes(): ?string
    {
        $html = "";
        foreach ($this->rootTag->getStyleAttributes() as $parameter => $value) {
            $html .= "{$parameter}: {$value};";
        }

        return ($html !== "") ? $this->renderProp('style', $html) : null;
    }

    private function renderDataParameters(): ?string
    {
        $html = "";
        foreach ($this->rootTag->getDataAttributes() as $parameter => $value) {
            $html .= $this->renderProp("data-{$parameter}", $value);
        }

        return ($html !== "") ? $html : null;
    }

    private function renderAriaParameters(): ?string
    {
        $html = "";
        foreach ($this->rootTag->getAriaAttributes() as $parameter => $value) {
            $html .= $this->renderProp("aria-{$parameter}", $value);
        }

        return ($html !== "") ? $html : null;
    }

    private function renderBooleanParameters(): ?string
    {
        $html = "";
        foreach ($this->rootTag->getBooleanAttributes() as $parameter => $value) {
            if ($value !== true) {
                continue;
            }

            $html .= " {$parameter}";
        }

        return ($html !== "") ? $html : null;
    }

    protected function renderAppendBeforeList(): string
    {
        $html = "";
        if (!empty($this->rootTag->getAppendBeforeList())) {
            foreach ($this->rootTag->getAppendBeforeList() as $element) {
                $html .= $element;
            }
        }

        return $html;
    }
    
    protected function renderAppendAfterList(): string
    {
        $html = "";
        if (!empty($this->rootTag->getAppendAfterList())) {
            foreach ($this->rootTag->getAppendAfterList() as $element) {
                $html .= $element;
            }
        }

        return $html;
    }

    protected function renderAppendList(): string
    {
        $html = "";
        foreach ($this->rootTag->getAppendList() as $element) {
            $html .= $element;
        }

        return $html;
    }

    public function compile(): string
    {
        $html = $this->renderStartTag();
        $html .= $this->renderTagAttributes();

        if ($this->rootTag->isAllowContent()) {
            $html .= ">";
            $html .= $this->renderAppendList();
        }

        $html .= $this->renderCloseTag();
        $html .= $this->renderAppendAfterList();

        return $html;
    }

    public static function render(TAG $tag): string
    {
        $renderer = new self($tag);
        return $renderer->compile();
    }
}
