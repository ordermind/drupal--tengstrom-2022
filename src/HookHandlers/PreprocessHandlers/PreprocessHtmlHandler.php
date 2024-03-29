<?php

declare(strict_types=1);

namespace Drupal\tengstrom_2022\HookHandlers\PreprocessHandlers;

use Drupal\Core\Template\Attribute;
use Ordermind\DrupalTengstromShared\HookHandlers\PreprocessHandlerInterface;

/**
 * Hook handler for template_preprocess_html().
 */
class PreprocessHtmlHandler implements PreprocessHandlerInterface {

  public function preprocess(array &$variables): void {
    $this->addThemeNameClassToBodyElement($variables);
  }

  protected function addThemeNameClassToBodyElement(array &$variables): void {
    if ($variables['attributes'] instanceof Attribute) {
      $variables['attributes']->addClass('tengstrom-2022');
    }
    else {
      $variables['attributes']['class'][] = 'tengstrom-2022';
    }
  }

}
