<?php

namespace Drupal\ckeditor_media_resize\Plugin\Filter;

use Drupal\Component\Utility\Html;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter to apply resizing of media images.
 *
 * @Filter(
 *   id = "filter_resize_media",
 *   title = @Translation("Resize media images"),
 *   description = @Translation("Uses a <code>data-media-width</code> attribute on <code>&lt;drupal-media&gt;</code> tags to apply resizing of media images. This filter needs to run before the <strong>Embed media</strong> filter."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE,
 *   weight = 90,
 * )
 */
class FilterResizeMedia extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $result = new FilterProcessResult($text);
    $data_attribute = 'data-media-width';

    if (stristr($text, $data_attribute) !== FALSE) {
      $dom = Html::load($text);
      $xpath = new \DOMXPath($dom);
      /** @var \DOMNode $node */
      foreach ($xpath->query('//*[@' . $data_attribute . ']') as $node) {
        $width = $node->getAttribute($data_attribute);
        $node->removeAttribute($data_attribute);
        $attribute_value = $node->getAttribute('style');
        $attribute_value .= $attribute_value . 'width:' . $width . ';';
        $node->setAttribute('style', $attribute_value);
      }

      foreach ($xpath->query('//figure/drupal-media[@' . $data_attribute . ']') as $node) {
        $width = $node->getAttribute($data_attribute);
        $node->removeAttribute($data_attribute);
        $attribute_value = $node->getAttribute('style');
        $attribute_value .= $attribute_value . 'width:' . $width . ';';
        // If the figure was used on this media, apply the width to the figure.
        $node->parentNode->setAttribute('style', $attribute_value);
      }

      $result->setProcessedText(Html::serialize($dom));
    }

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    if ($long) {
      return $this->t('
        <p>Applies the resizing on embedded media images inside ckeditor5 generated content when rendering the ckeditor content in Drupal.</p>
        <p>This works via a the <code>data-media-width</code> attribute on <code><drupal-media></code> tags, for example: <code><drupal-media data-media-width="50%"</code>.</p>
      ');
    }
    else {
      return $this->t('You can resize media images by adding the <code>data-media-width</code> attribute on <code><drupal-media></code> tags, for example: <code><drupal-media data-media-width="50%"</code>.');
    }
  }

}
