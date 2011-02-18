<?php

require_once dirname(__FILE__) . '/../vendor/cssmin.php';

/**
 * Fix for Minify_CSS_Compressor class
 *
 * @package     sfAssetsManagerPlugin
 * @subpackage  compressor
 * @author      Vincent Agnano <vincent.agnano@particul.es>
 */
class MinifyCSSCompressor extends Minify_CSS_Compressor
{

  private function __construct($options)
  {
    $this->_options = $options;
  }

  public static function process($css, $options = array())
  {
    return CssMin::minify($css, array(
      'remove-empty-blocks' => true,
      'remove-empty-rulesets' => true,
      'remove-last-semicolons' => true,
      'convert-css3-properties' => true,
      'convert-font-weight-values' => true,
      'convert-named-color-values' => true,
      'convert-hsl-color-values' => true,
      'convert-rgb-color-values' => true,
      'compress-color-values' => true,
      'compress-unit-values' => true,
      'emulate-css3-variables' => true
    ));
  }

  protected function _process($css)
  {
    $css = parent::_process($css);
    $css = preg_replace('`\s*`', '', $css);
    $css = preg_replace('`;}`', '}', $css);
    return $css;
  }
}