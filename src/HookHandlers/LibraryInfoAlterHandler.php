<?php

declare(strict_types=1);

namespace Drupal\tengstrom_2022\HookHandlers;

class LibraryInfoAlterHandler {

  public function alter(array &$libraries, string $extension) {
    $this->createDependencyOnToolbarWorkaround($libraries, $extension);
  }

  /**
   * By creating a dependency on our own library we assure that the workaround is only loaded when the toolbar library
   * is also loaded.
   */
  protected function createDependencyOnToolbarWorkaround(array &$libraries, string $extension): void {
    if ($extension !== 'toolbar') {
      return;
    }

    if (empty($libraries['toolbar'])) {
      return;
    }

    $libraries['toolbar']['dependencies'][] = 'tengstrom_2022/toolbar_workaround';
  }

}
