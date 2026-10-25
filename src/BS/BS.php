<?php

namespace CN\PHTML\BS;

use CN\PHTML\ComponentInterface;
use CN\PHTML\Core\TAG;

/**
 * Core for Bootstrap components
 */
class BS extends TAG implements ComponentInterface
{
  private array $fixedClasses;

  public function __toString(): string
  {
    return $this->render();
  }

  public function render(): string
  {
    $this->loadFixedClasses();
    return parent::render();
  }

  private function loadFixedClasses(): void
  {
    if (!isset($this->fixedClasses)) {
      return;
    }

    foreach ($this->fixedClasses as $class) {
      $this->addClass($class);
    }
  }

  public function setFixedClasses(array $classes): self
  {
    if (!isset($this->fixedClasses)) {
      $this->fixedClasses = $classes;
    }

    return $this;
  }

  public static function row(?string $class = null, ?string $id = null, ?string $html = null, ...$args): ROW
  {
    return new ROW($class, $id, $html, ...$args);
  }

  public static function col(int $size = 0, int $onXs = 0, int $onSm = 0, int $onMd = 0, int $onLg = 0, int $onXl = 0, int $onXxl = 0, ?string $class = null, ?string $id = null, ?string $html = null, ...$args): COL
  {
    return new COL($size, $onXs, $onSm, $onMd, $onLg, $onXl, $onXxl, $class, $id, $html, ...$args);
  }

  public static function listGroup(...$args): LIST_GROUP
  {
    return new LIST_GROUP(...$args);
  }

  public static function alert(?string $class = null, ?string $id = null, ?string $color = null, ?string $html = null, ...$args): ALERT
  {
    return new ALERT($class, $id, $color, $html, ...$args);
  }
  public static function alertHeading(...$args): ALERT_HEADING { return new ALERT_HEADING(...$args); }

  public static function element(string $tag, string $class, ...$args): BS_ELEMENT
  {
    return new BS_ELEMENT($tag, $class, ...$args);
  }

  public static function container(...$args): CONTAINER { return new CONTAINER(...$args); }
  public static function containerFluid(...$args): CONTAINER_FLUID { return new CONTAINER_FLUID(...$args); }
  public static function accordion(...$args): ACCORDION { return new ACCORDION(...$args); }
  public static function accordionItem(...$args): ACCORDION_ITEM { return new ACCORDION_ITEM(...$args); }
  public static function accordionHeader(...$args): ACCORDION_HEADER { return new ACCORDION_HEADER(...$args); }
  public static function accordionBody(...$args): ACCORDION_BODY { return new ACCORDION_BODY(...$args); }
  public static function carousel(...$args): CAROUSEL { return new CAROUSEL(...$args); }
  public static function carouselInner(...$args): CAROUSEL_INNER { return new CAROUSEL_INNER(...$args); }
  public static function carouselItem(...$args): CAROUSEL_ITEM { return new CAROUSEL_ITEM(...$args); }
  public static function carouselCaption(...$args): CAROUSEL_CAPTION { return new CAROUSEL_CAPTION(...$args); }
  public static function carouselControl(...$args): CAROUSEL_CONTROL { return new CAROUSEL_CONTROL(...$args); }
  public static function carouselIcon(...$args): CAROUSEL_ICON { return new CAROUSEL_ICON(...$args); }
  public static function carouselIndicators(...$args): CAROUSEL_INDICATORS { return new CAROUSEL_INDICATORS(...$args); }
  public static function collapse(...$args): COLLAPSE { return new COLLAPSE(...$args); }
  public static function popover(...$args): POPOVER { return new POPOVER(...$args); }
  public static function tooltip(...$args): TOOLTIP { return new TOOLTIP(...$args); }
  public static function scrollspy(...$args): SCROLLSPY { return new SCROLLSPY(...$args); }
  public static function badge(...$args): BADGE { return new BADGE(...$args); }
  public static function breadcrumb(...$args): BREADCRUMB { return new BREADCRUMB(...$args); }
  public static function breadcrumbItem(...$args): BREADCRUMB_ITEM { return new BREADCRUMB_ITEM(...$args); }
  public static function bsButton(...$args): BUTTON { return new BUTTON(...$args); }
  public static function buttonGroup(...$args): BUTTON_GROUP { return new BUTTON_GROUP(...$args); }
  public static function cardBody(...$args): CARD_BODY { return new CARD_BODY(...$args); }
  public static function card(...$args): CARD { return new CARD(...$args); }
  public static function cardHeader(...$args): CARD_HEADER { return new CARD_HEADER(...$args); }
  public static function cardFooter(...$args): CARD_FOOTER { return new CARD_FOOTER(...$args); }
  public static function cardTitle(...$args): CARD_TITLE { return new CARD_TITLE(...$args); }
  public static function cardSubtitle(...$args): CARD_SUBTITLE { return new CARD_SUBTITLE(...$args); }
  public static function cardText(...$args): CARD_TEXT { return new CARD_TEXT(...$args); }
  public static function cardImg(...$args): CARD_IMG { return new CARD_IMG(...$args); }
  public static function cardImgOverlay(...$args): CARD_IMG_OVERLAY { return new CARD_IMG_OVERLAY(...$args); }
  public static function closeButton(...$args): CLOSE_BUTTON { return new CLOSE_BUTTON(...$args); }
  public static function bsMenu(...$args): MENU { return new MENU(...$args); }
  public static function menuItem(...$args): MENU_ITEM { return new MENU_ITEM(...$args); }
  public static function menuDivider(...$args): MENU_DIVIDER { return new MENU_DIVIDER(...$args); }
  public static function listGroupItem(...$args): LIST_GROUP_ITEM { return new LIST_GROUP_ITEM(...$args); }
  public static function listGroupLink(...$args): LIST_GROUP_LINK { return new LIST_GROUP_LINK(...$args); }
  public static function bsDialog(...$args): DIALOG { return new DIALOG(...$args); }
  public static function dialogHeader(...$args): DIALOG_HEADER { return new DIALOG_HEADER(...$args); }
  public static function dialogTitle(...$args): DIALOG_TITLE { return new DIALOG_TITLE(...$args); }
  public static function dialogBody(...$args): DIALOG_BODY { return new DIALOG_BODY(...$args); }
  public static function dialogFooter(...$args): DIALOG_FOOTER { return new DIALOG_FOOTER(...$args); }
  public static function bsNav(...$args): NAV { return new NAV(...$args); }
  public static function navItem(...$args): NAV_ITEM { return new NAV_ITEM(...$args); }
  public static function navLink(...$args): NAV_LINK { return new NAV_LINK(...$args); }
  public static function navbar(...$args): NAVBAR { return new NAVBAR(...$args); }
  public static function navbarBrand(...$args): NAVBAR_BRAND { return new NAVBAR_BRAND(...$args); }
  public static function navbarToggler(...$args): NAVBAR_TOGGLER { return new NAVBAR_TOGGLER(...$args); }
  public static function navbarNav(...$args): NAVBAR_NAV { return new NAVBAR_NAV(...$args); }
  public static function navbarText(...$args): NAVBAR_TEXT { return new NAVBAR_TEXT(...$args); }
  public static function drawer(...$args): DRAWER { return new DRAWER(...$args); }
  public static function drawerHeader(...$args): DRAWER_HEADER { return new DRAWER_HEADER(...$args); }
  public static function drawerTitle(...$args): DRAWER_TITLE { return new DRAWER_TITLE(...$args); }
  public static function drawerBody(...$args): DRAWER_BODY { return new DRAWER_BODY(...$args); }
  public static function pagination(...$args): PAGINATION { return new PAGINATION(...$args); }
  public static function paginationItem(...$args): PAGINATION_ITEM { return new PAGINATION_ITEM(...$args); }
  public static function paginationLink(...$args): PAGINATION_LINK { return new PAGINATION_LINK(...$args); }
  public static function placeholder(...$args): PLACEHOLDER { return new PLACEHOLDER(...$args); }
  public static function bsProgress(...$args): PROGRESS { return new PROGRESS(...$args); }
  public static function progressBar(...$args): PROGRESS_BAR { return new PROGRESS_BAR(...$args); }
  public static function spinner(...$args): SPINNER { return new SPINNER(...$args); }
  public static function toast(...$args): TOAST { return new TOAST(...$args); }
  public static function toastHeader(...$args): TOAST_HEADER { return new TOAST_HEADER(...$args); }
  public static function toastBody(...$args): TOAST_BODY { return new TOAST_BODY(...$args); }
  public static function toastContainer(...$args): TOAST_CONTAINER { return new TOAST_CONTAINER(...$args); }
  public static function bsTable(...$args): TABLE { return new TABLE(...$args); }
  public static function tableResponsive(...$args): TABLE_RESPONSIVE { return new TABLE_RESPONSIVE(...$args); }
  public static function formControl(...$args): FORM_CONTROL { return new FORM_CONTROL(...$args); }
  public static function formSelect(...$args): FORM_SELECT { return new FORM_SELECT(...$args); }
  public static function check(...$args): CHECK { return new CHECK(...$args); }
  public static function radio(...$args): RADIO { return new RADIO(...$args); }
  public static function switchInput(...$args): FORM_SWITCH { return new FORM_SWITCH(...$args); }
  public static function formGroup(...$args): FORM_GROUP { return new FORM_GROUP(...$args); }
  public static function formFieldCard(...$args): FORM_FIELD_CARD { return new FORM_FIELD_CARD(...$args); }
  public static function switchControl(...$args): SWITCH_INPUT { return new SWITCH_INPUT(...$args); }
  public static function formLabel(...$args): FORM_LABEL { return new FORM_LABEL(...$args); }
  public static function formText(...$args): FORM_TEXT { return new FORM_TEXT(...$args); }
  public static function formRange(...$args): FORM_RANGE { return new FORM_RANGE(...$args); }
  public static function formFloating(...$args): FORM_FLOATING { return new FORM_FLOATING(...$args); }
  public static function formValidation(...$args): FORM_VALIDATION { return new FORM_VALIDATION(...$args); }
  public static function formFeedback(...$args): FORM_FEEDBACK { return new FORM_FEEDBACK(...$args); }
  public static function formField(...$args): FORM_FIELD { return new FORM_FIELD(...$args); }
  public static function inputGroup(...$args): INPUT_GROUP { return new INPUT_GROUP(...$args); }
  public static function inputGroupText(...$args): INPUT_GROUP_TEXT { return new INPUT_GROUP_TEXT(...$args); }
  public static function rowColumn(...$args): ROW_COLUMN { return new ROW_COLUMN(...$args); }
}
