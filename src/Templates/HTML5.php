<?php

namespace PHTML\Templates;

use PHTML\BODY;
use PHTML\HEAD;
use PHTML\HTML;
use PHTML\LINK;
use PHTML\META;
use PHTML\TAG;
use PHTML\TITLE;

class HTML5
{
    private HTML $html;
    private HEAD $head;
    private BODY $body;

    private string $pageTitle;
    private array $headerMetaTags;
    private array $headerLinks;
    private array $headerScripts;
    private array $footerStyles;
    private array $footerScripts;

    private function renderHead(): void
    {
        $this->head = new HEAD();
    }

    private function appendToHtml(TAG $tag): self
    {
        $this->html->append($tag);
        return $this;
    }

    public function appendMetaTag(META $meta): self
    {
        $this->headerMetaTags[] = $meta;
        return $this;
    }

    public function appendLink(LINK $meta): self
    {
        $this->headerMetaTags[] = $meta;
        return $this;
    }

    public function appendToBody(TAG $tag): self
    {
        $this->body->append($tag);
        return $this;
    }

    public function render(): string
    {
        return $this->html->render();
    }
}
