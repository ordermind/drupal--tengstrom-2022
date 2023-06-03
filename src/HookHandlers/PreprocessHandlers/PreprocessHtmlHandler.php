<?php

declare(strict_types=1);

namespace Drupal\tengstrom_2022\HookHandlers\PreprocessHandlers;

use Drupal\tengstrom_general\HookHandlers\PreprocessHandlers\PreprocessHandlerInterface;
use Drupal\Core\Template\Attribute;

/**
 * Hook handler for template_preprocess_html().
 */
class PreprocessHtmlHandler implements PreprocessHandlerInterface {

  public function preprocess(array &$variables): void {
    // Add class to the body element.
    if ($variables['attributes'] instanceof Attribute) {
      $variables['attributes']->addClass('tengstrom-2022');
    }
    else {
      $variables['attributes']['class'][] = 'tengstrom-2022';
    }
  }

}
