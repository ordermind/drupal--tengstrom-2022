<?php

declare(strict_types=1);

namespace Drupal\tengstrom_2022\HookHandlers\FormAlterHandlers;

use Drupal\Core\Entity\ContentEntityDeleteForm;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Ordermind\DrupalTengstromShared\Helpers\EntityFormHelpers;
use Ordermind\DrupalTengstromShared\HookHandlers\FormAlterHandlerInterface;

/**
 * Hook handler for template_form_alter().
 */
class GeneralFormAlterHandler implements FormAlterHandlerInterface {

  public function alter(array &$form, FormStateInterface $formState, string $formId): void {
    $objForm = $formState->getFormObject();

    if (!$this->isFormEligibleForStyling($objForm, $formId)) {
      return;
    }

    $this->markFormForStyling($form);
    $this->changeSubmitButtonTypeOnDeleteConfirmForm($form, $objForm);
  }

  protected function isFormEligibleForStyling(FormInterface $objForm, string $formId): bool {
    if (EntityFormHelpers::isContentEntityForm($objForm)) {
      return TRUE;
    }

    $publicFormIds = [
      'views_exposed_form',
    ];

    return in_array($formId, $publicFormIds);
  }

  protected function markFormForStyling(array &$form): void {
    $form['#attributes']['class'][] = 'tengstrom-form';
  }

  protected function changeSubmitButtonTypeOnDeleteConfirmForm(array &$form, FormInterface $objForm): void {
    if ($objForm instanceof ContentEntityDeleteForm) {
      $form['actions']['submit']['#button_type'] = 'danger';
    }
  }

}
