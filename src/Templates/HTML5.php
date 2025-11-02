<?php

namespace PHTML\Templates;

use PHTML\Core\BODY;
use PHTML\Core\HEAD;
use PHTML\Core\HTML;
use PHTML\Core\LINK;
use PHTML\Core\META;
use PHTML\Core\SCRIPT;
use PHTML\Core\TAG;
use PHTML\Core\TITLE;

/**
 * Principal format of a HTML page
 */
class HTML5
{
    private HTML $html;
    private HEAD $head;
    private BODY $body;
    private TITLE $title;

    private string $pageTitle;
    private array $headerMetaTags;
    private array $headerLinks;
    private array $headerStyles;
    private array $headerScripts;
    private array $footerStyles;
    private array $footerScripts;

    public function __tostring()
    {
        return $this->render();
    }

    public function html(): HTML
    {
        if (!isset($this->html)) {
            $this->html = new HTML();
        }

        return $this->html;
    }

    public function getHtml(): HTML
    {
        return $this->html();
    }

    public function head(): HEAD
    {
        if (!isset($this->head)) {
            $this->head = new HEAD();
        }

        return $this->head;
    }

    public function getHead(): HEAD
    {
        return $this->head();
    }

    public function body(): BODY
    {
        if (!isset($this->body)) {
            $this->body = new BODY();
        }

        return $this->body;
    }

    public function getBody(): BODY
    {
        return $this->body();
    }

    public function setPageTitle(string $pageTitle): self
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    private function renderHead(): void
    {
        $this->head = new HEAD();
    }

    public function appendToHtml(TAG $tag): self
    {
        $this->html()->append($tag);
        return $this;
    }

    public function appendToHead(TAG $tag): self
    {
        $this->head()->append($tag);
        return $this;
    }

    public function headerMetaTags(): array
    {
        if (!isset($this->headerMetaTags)) {
            $this->headerMetaTags = [];
        }

        return $this->headerMetaTags;
    }

    public function getHeaderMetaTags(): array
    {
        return $this->headerMetaTags();
    }

    public function appendMetaTag(META $meta): self
    {
        $this->headerMetaTags()[] = $meta;
        return $this;
    }

    public function headerLinks(): array
    {
        if (!isset($this->headerLinks)) {
            $this->headerLinks = [];
        }

        return $this->headerLinks;
    }

    public function getHeaderLinks(): array
    {
        return $this->headerLinks();
    }

    public function appendLink(LINK $link): self
    {
        $this->headerLinks()[] = $link;
        return $this;
    }

    public function headerScripts(): array
    {
        if (!isset($this->headerScripts)) {
            $this->headerScripts = [];
        }

        return $this->headerScripts;
    }

    public function getHeaderScripts(): array
    {
        return $this->headerScripts();
    }

    public function appendHeaderScript(SCRIPT $script): self
    {
        $this->headerScripts()[] = $script;
        return $this;
    }

    public function appendToBody(TAG $tag): self
    {
        $this->body()->append($tag);
        return $this;
    }

    public function render(): string
    {
        $this->html()->append([
            $this->head(),
            $this->body()
        ]);

        foreach ($this->headerMetaTags() as $headerMetaTag) {
            $this->appendToHead($headerMetaTag);
        }

        foreach ($this->headerScripts() as $headerScript) {
            $this->appendToHead($headerScript);
        }

        foreach ($this->headerLinks() as $headerLink) {
            $this->appendToHead($headerLink);
        }

        if (isset($this->pageTitle)) {
            $this->title = new TITLE($this->pageTitle);
            $this->appendToHead($this->title);
        }

        return $this->html()->render();
    }
}
