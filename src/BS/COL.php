<?php

namespace PHTML\BS;

class COL extends BS
{
  private int $colSize = 0;
  private int $colXsSize = 0;
  private int $colSmSize = 0;
  private int $colMdSize = 0;
  private int $colLgSize = 0;
  private int $colXlSize = 0;
  private int $colXxlSize = 0;

  public function __construct(int $size = 0, int $onXs = 0, int $onSm = 0, int $onMd = 0, int $onLg = 0, int $onXl = 0, int $onXxl = 0, ?string $class = null, ?string $id = null, mixed $append = null, ...$args)
  {
    $this->setTagType('div');

    $this->setSize($size);
    $this->setSizeXs($onXs);
    $this->setSizeSm($onSm);
    $this->setSizeMd($onMd);
    $this->setSizeLg($onLg);
    $this->setSizeXl($onXl);
    $this->setSizeXxl($onXxl);

    $arguments = $args ?? [];

    if (!empty($class)) {
      $arguments['class'] = $class;
    }

    if (!empty($id)) {
      $arguments['id'] = $id;
    }

    if (!empty($append)) {
      $arguments['append'] = $append;
    }

    $this->setParameters($arguments);
  }

  private function addClassSize(string $sizeName, int $size): void
  {
    $classRad = "col";

    if (!empty($sizeName)) {
      $classRad .= "-{$sizeName}";
    }

    if ($size > 0) {
      $this->addClass("{$classRad}-{$size}");
    } elseif ($size == 0) {
      $this->addClass($classRad);
    }
  }

  public function render(): string
  {
    $this->setFixedClasses($this->getClassList());
    $this->clearClassList();

    if (!$this->isSizeSet()) {
      $this->addClass('col');
      return $this;
    }

    if ($this->colSize > 0) {
      $this->addClassSize('', $this->colSize);
    }

    if ($this->colXsSize > 0) {
      $this->addClassSize('xs', $this->colXsSize);
    }

    if ($this->colSmSize > 0) {
      $this->addClassSize('sm', $this->colSmSize);
    }

    if ($this->colMdSize > 0) {
      $this->addClassSize('md', $this->colMdSize);
    }

    if ($this->colLgSize > 0) {
      $this->addClassSize('lg', $this->colLgSize);
    }

    if ($this->colXlSize > 0) {
      $this->addClassSize('xl', $this->colXlSize);
    }

    if ($this->colXxlSize > 0) {
      $this->addClassSize('xxl', $this->colXxlSize);
    }

    return parent::render();
  }

  private function isSizeSet(): bool
  {
    $sum = ($this->colSize ?? 0) + ($this->colXsSize ?? 0) + ($this->colSmSize ?? 0) +
      ($this->colMdSize ?? 0) + ($this->colLgSize ?? 0) + ($this->colXlSize ?? 0) +
      ($this->colXxlSize ?? 0);
    return ($sum > 0);
  }

  private function setAnySize(&$varSize, int $size): void
  {
    if ($size < 0 || $size > 12) {
      $varSize = 0;
    } else {
      $varSize = $size;
    }
  }

  public function setSize(int $size): self
  {
    $this->setAnySize($this->colSize, $size);
    return $this;
  }

  public function size(int $size): self
  {
    return $this->setSize($size);
  }

  public function setSizeXs(int $size): self
  {
    $this->setAnySize($this->colXsSize, $size);
    return $this;
  }

  public function xs(int $size): self
  {
    return $this->setSizeXs($size);
  }

  public function onXs(int $size): self
  {
    return $this->setSizeXs($size);
  }

  public function setSizeSm(int $size): self
  {
    $this->setAnySize($this->colSmSize, $size);
    return $this;
  }

  public function onSm(int $size): self
  {
    return $this->setSizeSm($size);
  }

  public function setSizeMd(int $size): self
  {
    $this->setAnySize($this->colMdSize, $size);
    return $this;
  }

  public function onMd(int $size): self
  {
    return $this->setSizeMd($size);
  }

  public function setSizeLg(int $size): self
  {
    $this->setAnySize($this->colLgSize, $size);
    return $this;
  }

  public function onLg(int $size): self
  {
    return $this->setSizeLg($size);
  }

  public function setSizeXl(int $size): self
  {
    $this->setAnySize($this->colXlSize, $size);
    return $this;
  }

  public function onXl(int $size): self
  {
    return $this->setSizeXl($size);
  }

  public function setSizeXxl(int $size): self
  {
    $this->setAnySize($this->colXxlSize, $size);
    return $this;
  }

  public function onXxl(int $size): self
  {
    return $this->setSizeXxl($size);
  }
}
