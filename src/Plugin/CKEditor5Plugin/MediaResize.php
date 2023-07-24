<?php

declare(strict_types=1);

namespace Drupal\ckeditor_media_resize\Plugin\CKEditor5Plugin;

use Drupal\ckeditor5\Plugin\CKEditor5Plugin\ImageResize;
use Drupal\Core\Form\FormStateInterface;

/**
 * CKEditor 5 MediaResize plugin.
 *
 * @internal
 *   Plugin classes are internal.
 */
class MediaResize extends ImageResize {

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['allow_resize'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Allow the user to resize media images'),
      '#default_value' => $this->configuration['allow_resize'],
    ];

    return $form;
  }

}
