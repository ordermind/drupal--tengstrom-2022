<?php

declare(strict_types=1);

namespace Drupal\tengstrom_2022\HookHandlers\PreprocessHandlers;

use Ordermind\DrupalTengstromShared\HookHandlers\PreprocessHandlerInterface;

/**
 * Hook handler for template_preprocess_html().
 */
class PreprocessLinksHandler implements PreprocessHandlerInterface {

  public function preprocess(array &$variables): void {
    $this->addDangerClassToOperationsDeleteButton($variables);
  }

  protected function addDangerClassToOperationsDeleteButton(array &$variables): void {
    if ($variables['theme_hook_original'] !== 'links__dropbutton__operations') {
      return;
    }

    if (empty($variables['links']['delete'])) {
      return;
    }

    $variables['links']['delete']['attributes']->addClass('button--danger');
  }

}
