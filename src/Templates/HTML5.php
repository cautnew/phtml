<?php

namespace PHTML\Templates;

use PHTML\TemplateInterface;
use PHTML\Core\BODY;
use PHTML\Core\HEAD;
use PHTML\Core\HTML;
use PHTML\Core\LINK;
use PHTML\Core\META;
use PHTML\Core\SCRIPT;
use PHTML\Core\TAG;
use PHTML\Core\NONCONTENTTAG;
use PHTML\Core\TITLE;

/**
 * Principal format of a HTML page
 */
class HTML5 implements TemplateInterface
{
    private HTML $html;
    private HEAD $head;
    private BODY $body;

    private string $pageTitle = '';
    private array $headerMetaTags = [];
    private array $headerLinks = [];
    private array $headerScripts = [];
    private array $renderHeadCallbacks = [];
    private array $renderBodyCallbacks = [];
    private ?\Closure $preRenderHtmlCallback = null;

    public function __toString(): string
    {
        return $this->render();
    }

    public function html(): HTML
    {
        return $this->html ??= new HTML();
    }

    public function head(): HEAD
    {
        return $this->head ??= new HEAD();
    }

    public function body(): BODY
    {
        return $this->body ??= new BODY();
    }

    public function setPageTitle(string $pageTitle): self
    {
        $this->pageTitle = $pageTitle;
        return $this;
    }

    public function appendToHtml(TAG | NONCONTENTTAG $tag): self
    {
        $this->html()->append($tag);
        return $this;
    }

    public function appendToHead(TAG | NONCONTENTTAG $tag): self
    {
        $this->head()->append($tag);
        return $this;
    }

    public function headerMetaTags(): array
    {
        return $this->headerMetaTags;
    }

    public function appendMetaTag(META $meta): self
    {
        $this->headerMetaTags[] = $meta;
        return $this;
    }

    public function headerLinks(): array
    {
        return $this->headerLinks;
    }

    public function appendLink(LINK $link): self
    {
        $this->headerLinks[] = $link;
        return $this;
    }

    public function headerScripts(): array
    {
        return $this->headerScripts;
    }

    public function appendHeaderScript(SCRIPT $script): self
    {
        $this->headerScripts[] = $script;
        return $this;
    }

    public function appendToBody(TAG | NONCONTENTTAG $tag): self
    {
        $this->body()->append($tag);
        return $this;
    }

    public function preRenderHtml(callable $func): self
    {
        $this->preRenderHtmlCallback = $func;
        return $this;
    }

    public function addRenderHead(callable $func): self
    {
        $this->renderHeadCallbacks[] = $func;
        return $this;
    }

    public function addRenderBody(callable $func): self
    {
        $this->renderBodyCallbacks[] = $func;
        return $this;
    }

    public function addRendersBody(array $funcs): self
    {
        foreach ($funcs as $func) {
            if (is_callable($func)) {
                $this->renderBodyCallbacks[] = $func;
            }
        }
        return $this;
    }

    public function render(): string
    {
        $this->assembleHtmlStructure();
        $this->executePreRenderCallback();
        $this->populateHead();
        $this->executeHeadCallbacks();
        $this->executeBodyCallbacks();

        return $this->html()->render();
    }

    private function assembleHtmlStructure(): void
    {
        $this->html()->append([
            $this->head(),
            $this->body()
        ]);
    }

    private function executePreRenderCallback(): void
    {
        if ($this->preRenderHtmlCallback instanceof \Closure) {
            $this->preRenderHtmlCallback->call($this->html());
        }
    }

    private function populateHead(): void
    {
        $this->appendMetaTagsToHead();
        $this->appendScriptsToHead();
        $this->appendLinksToHead();
        $this->appendPageTitleToHead();
    }

    private function appendMetaTagsToHead(): void
    {
        foreach ($this->headerMetaTags as $metaTag) {
            $this->appendToHead($metaTag);
        }
    }

    private function appendScriptsToHead(): void
    {
        foreach ($this->headerScripts as $script) {
            $this->appendToHead($script);
        }
    }

    private function appendLinksToHead(): void
    {
        foreach ($this->headerLinks as $link) {
            $this->appendToHead($link);
        }
    }

    private function appendPageTitleToHead(): void
    {
        if (empty($this->pageTitle)) {
            return;
        }

        $this->appendToHead(new TITLE($this->pageTitle));
        $this->appendToHead(TAG::meta('title', $this->pageTitle));
    }

    private function executeHeadCallbacks(): void
    {
        foreach ($this->renderHeadCallbacks as $callback) {
            if ($callback instanceof \Closure) {
                $callback->call($this->head());
            }
        }
    }

    private function executeBodyCallbacks(): void
    {
        foreach ($this->renderBodyCallbacks as $callback) {
            if ($callback instanceof \Closure) {
                $callback->call($this->body());
            }
        }
    }
}
