<?php

namespace CN\PHTML\Tests;

use CN\PHTML\BS\BS;
use PHPUnit\Framework\TestCase;

class BootstrapComponentsTest extends TestCase
{
    public function testBootstrap6AccordionUsesNativeDetailsAndOpenState(): void
    {
        $accordion = BS::accordion()->append(
            BS::accordionItem(open: true)
                ->append(BS::accordionHeader(html: 'Question'))
                ->append(BS::accordionBody(html: 'Answer'))
        );

        $this->assertSame(
            '<div class="accordion"><details class="accordion-item" open><summary class="accordion-header">Question</summary><div class="accordion-body">Answer</div></details></div>',
            (string) $accordion
        );
    }

    public function testButtonSupportsBootstrap6ThemeStyleAndDisabledState(): void
    {
        $button = BS::bsButton(html: 'Save')
            ->variant('solid')
            ->theme('success')
            ->disabled();

        $this->assertSame(
            '<button class="btn-solid theme-success disabled" type="button" aria-disabled="true" disabled>Save</button>',
            (string) $button
        );
    }

    public function testAlertThemeAndDismissButtonCanBeToggled(): void
    {
        $alert = BS::alert(color: 'danger', html: 'Warning')->dismissible();

        $this->assertSame(
            '<div class="alert theme-danger" role="alert">Warning<button class="btn-close ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div>',
            (string) $alert
        );

        $alert->dismissible(false);
        $this->assertSame('<div class="alert theme-danger" role="alert">Warning</div>', (string) $alert);
    }

    public function testBootstrap6ResponsiveGridClasses(): void
    {
        $this->assertSame('<div class="col-6 md:col-4 2xl:col-3"></div>', (string) BS::col(6, onMd: 4, onXxl: 3));
        $this->assertSame('<div class="row md:row-cols-3"></div>', (string) BS::rowColumn(3, 'md'));
        $this->assertSame('<nav class="navbar md:navbar-expand"></nav>', (string) BS::navbar()->expand('md'));
    }

    public function testNativeDialogDrawerAndMenuChildrenRender(): void
    {
        $dialog = BS::bsDialog(id: 'help')->open()
            ->append(BS::dialogHeader()->append(BS::dialogTitle(html: 'Help')))
            ->append(BS::dialogBody(html: 'Details'));

        $this->assertSame(
            '<dialog class="dialog" id="help" open><div class="dialog-header"><h1 class="dialog-title">Help</h1></div><div class="dialog-body">Details</div></dialog>',
            (string) $dialog
        );

        $menu = BS::bsMenu()->append(BS::menuItem(href: '/home', html: 'Home')->active());
        $this->assertSame('<div class="menu"><a class="menu-item active" href="/home">Home</a></div>', (string) $menu);

        $drawer = BS::drawer(id: 'nav')->placement('end')->open();
        $this->assertSame('<dialog class="drawer drawer-end show" id="nav" open></dialog>', (string) $drawer);
    }

    public function testFormAndProgressWrappers(): void
    {
        $field = BS::formField()
            ->append(BS::formLabel(for: 'email', html: 'Email'))
            ->append(BS::formControl(id: 'email', type: 'email')->invalid())
            ->append(BS::formFeedback(html: 'Invalid email'));

        $this->assertSame(
            '<div class="form-field"><label class="form-label" for="email">Email</label><input class="form-control is-invalid" id="email" type="email" /><div class="invalid-feedback">Invalid email</div></div>',
            (string) $field
        );

        $switch = BS::switchInput()->append(BS::switchControl(id: 'alerts', checked: true));
        $this->assertSame(
            '<div class="switch"><input id="alerts" type="checkbox" role="switch" checked switch /></div>',
            (string) $switch
        );

        $progress = BS::bsProgress()->value(35)->append(BS::progressBar()->value(35));
        $this->assertSame(
            '<div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="35"><div class="progress-bar" style="width: 35%;"></div></div>',
            (string) $progress
        );
    }

    public function testEveryFactoryReturnsItsBootstrapComponent(): void
    {
        $factories = [
            'container' => 'CONTAINER',
            'containerFluid' => 'CONTAINER_FLUID',
            'accordion' => 'ACCORDION',
            'accordionItem' => 'ACCORDION_ITEM',
            'accordionHeader' => 'ACCORDION_HEADER',
            'accordionBody' => 'ACCORDION_BODY',
            'carousel' => 'CAROUSEL',
            'carouselInner' => 'CAROUSEL_INNER',
            'carouselItem' => 'CAROUSEL_ITEM',
            'carouselCaption' => 'CAROUSEL_CAPTION',
            'carouselControl' => 'CAROUSEL_CONTROL',
            'carouselIcon' => 'CAROUSEL_ICON',
            'carouselIndicators' => 'CAROUSEL_INDICATORS',
            'collapse' => 'COLLAPSE',
            'alert' => 'ALERT',
            'alertHeading' => 'ALERT_HEADING',
            'badge' => 'BADGE',
            'breadcrumb' => 'BREADCRUMB',
            'breadcrumbItem' => 'BREADCRUMB_ITEM',
            'bsButton' => 'BUTTON',
            'buttonGroup' => 'BUTTON_GROUP',
            'card' => 'CARD',
            'cardBody' => 'CARD_BODY',
            'cardHeader' => 'CARD_HEADER',
            'cardFooter' => 'CARD_FOOTER',
            'cardTitle' => 'CARD_TITLE',
            'cardSubtitle' => 'CARD_SUBTITLE',
            'cardText' => 'CARD_TEXT',
            'cardImg' => 'CARD_IMG',
            'cardImgOverlay' => 'CARD_IMG_OVERLAY',
            'closeButton' => 'CLOSE_BUTTON',
            'bsMenu' => 'MENU',
            'menuItem' => 'MENU_ITEM',
            'menuDivider' => 'MENU_DIVIDER',
            'bsDialog' => 'DIALOG',
            'dialogHeader' => 'DIALOG_HEADER',
            'dialogTitle' => 'DIALOG_TITLE',
            'dialogBody' => 'DIALOG_BODY',
            'dialogFooter' => 'DIALOG_FOOTER',
            'drawer' => 'DRAWER',
            'drawerHeader' => 'DRAWER_HEADER',
            'drawerTitle' => 'DRAWER_TITLE',
            'drawerBody' => 'DRAWER_BODY',
            'listGroup' => 'LIST_GROUP',
            'listGroupItem' => 'LIST_GROUP_ITEM',
            'listGroupLink' => 'LIST_GROUP_LINK',
            'bsNav' => 'NAV',
            'navItem' => 'NAV_ITEM',
            'navLink' => 'NAV_LINK',
            'navbar' => 'NAVBAR',
            'navbarBrand' => 'NAVBAR_BRAND',
            'navbarToggler' => 'NAVBAR_TOGGLER',
            'navbarNav' => 'NAVBAR_NAV',
            'navbarText' => 'NAVBAR_TEXT',
            'pagination' => 'PAGINATION',
            'paginationItem' => 'PAGINATION_ITEM',
            'paginationLink' => 'PAGINATION_LINK',
            'placeholder' => 'PLACEHOLDER',
            'popover' => 'POPOVER',
            'progressBar' => 'PROGRESS_BAR',
            'bsProgress' => 'PROGRESS',
            'scrollspy' => 'SCROLLSPY',
            'spinner' => 'SPINNER',
            'bsTable' => 'TABLE',
            'tableResponsive' => 'TABLE_RESPONSIVE',
            'toast' => 'TOAST',
            'toastHeader' => 'TOAST_HEADER',
            'toastBody' => 'TOAST_BODY',
            'toastContainer' => 'TOAST_CONTAINER',
            'tooltip' => 'TOOLTIP',
            'formControl' => 'FORM_CONTROL',
            'formSelect' => 'FORM_SELECT',
            'formField' => 'FORM_FIELD',
            'formFieldCard' => 'FORM_FIELD_CARD',
            'formGroup' => 'FORM_GROUP',
            'formLabel' => 'FORM_LABEL',
            'formText' => 'FORM_TEXT',
            'formFeedback' => 'FORM_FEEDBACK',
            'formValidation' => 'FORM_VALIDATION',
            'check' => 'CHECK',
            'radio' => 'RADIO',
            'switchInput' => 'FORM_SWITCH',
            'switchControl' => 'SWITCH_INPUT',
            'formRange' => 'FORM_RANGE',
            'formFloating' => 'FORM_FLOATING',
            'inputGroup' => 'INPUT_GROUP',
            'inputGroupText' => 'INPUT_GROUP_TEXT',
            'rowColumn' => 'ROW_COLUMN',
            'row' => 'ROW',
            'col' => 'COL',
        ];

        foreach ($factories as $factory => $class) {
            $this->assertInstanceOf(
                'CN\\PHTML\\BS\\' . $class,
                BS::$factory(),
                "BS::{$factory}() should return {$class}"
            );
        }
    }

    public function testEveryBootstrapWrapperLoadsAndRenders(): void
    {
        foreach (glob(__DIR__ . '/../src/BS/*.php') as $file) {
            $short = basename($file, '.php');
            if (in_array($short, ['BS', 'BS_ELEMENT'], true)) {
                continue;
            }

            $class = 'CN\\PHTML\\BS\\' . $short;
            $component = new $class();
            $this->assertNotSame('', $component->render(), "{$short} should render");
        }
    }
}
