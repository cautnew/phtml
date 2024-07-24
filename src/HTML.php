<?php

namespace PHTML;

/**
 * Class HTML
 */
class HTML extends TAG
{
    public function __construct(...$args)
    {
        $this->setTagType('html');
        $this->setParameters($args);
        $this->appendBefore("<!DOCTYPE html>");
    }

    public function setLang(string $lang): self
    {
        return $this->setParameter('lang', $lang);
    }
}
