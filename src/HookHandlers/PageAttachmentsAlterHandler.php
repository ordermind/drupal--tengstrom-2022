<?php

declare(strict_types=1);

namespace Drupal\tengstrom_2022\HookHandlers;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Language\LanguageManagerInterface;

/**
 * Hook handler for template_page_attachments_alter().
 */
class PageAttachmentsAlterHandler {
  protected ModuleHandlerInterface $moduleHandler;
  protected LanguageManagerInterface $languageManager;
  protected ConfigFactoryInterface $configFactory;

  public function __construct(
    ModuleHandlerInterface $moduleHandler,
    ConfigFactoryInterface $configFactory,
    LanguageManagerInterface $languageManager,
  ) {
    $this->moduleHandler = $moduleHandler;
    $this->configFactory = $configFactory;
    $this->languageManager = $languageManager;
  }

  public function alter(array &$page): void {
    $this->setViewPort($page);
    $this->customizeResponsiveMenu($page);
  }

  protected function setViewPort(array &$page): void {
    $viewport = [
      '#type' => 'html_tag',
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'viewport',
        'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no',
      ],
    ];

    $page['#attached']['html_head'][] = [$viewport, 'viewport'];
  }

  protected function customizeResponsiveMenu(array &$page): void {
    if (!$this->moduleHandler->moduleExists('responsive_menu')) {
      return;
    }

    $responsiveMenuConfig = $this->configFactory->get('responsive_menu.settings');

    $theme = str_replace('theme-', '', $responsiveMenuConfig->get('off_canvas_theme') ?? '');

    $page['#attached']['drupalSettings']['responsive_menu']['custom']['options'] = [
      'theme' => $theme,
    ];
    $page['#attached']['drupalSettings']['responsive_menu']['custom']['config'] = [
      'language' => $this->languageManager->getCurrentLanguage()->getId(),
    ];
  }

}
