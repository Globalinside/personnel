<?php
/**
 * @filesource Gcms/View.php
 * @link http://www.kotchasan.com/
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace Gcms;

use \Kotchasan\Language;

/**
 * View base class สำหรับ GCMS.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Kotchasan\View
{

  /**
   * ouput เป็น HTML.
   *
   * @param string|null $template HTML Template ถ้าไม่กำหนด (null) จะใช้ index.html
   * @return string
   */
  public function renderHTML($template = null)
  {
    // เนื้อหา
    parent::setContents(array(
      /* ภาษา */
      '/{LNG_([^}]+)}/e' => '\Kotchasan\Language::parse(array(1=>"$1"))',
      /* ภาษา ที่ใช้งานอยู่ */
      '/{LANGUAGE}/' => Language::name(),
    ));
    return parent::renderHTML($template);
  }

  /**
   * อ่านภาษาที่ติดตั้งตามลำดับการตั้งค่า
   *
   * @return array
   */
  public static function installedLanguage()
  {
    $languages = array();
    foreach (self::$cfg->languages as $item) {
      $languages[$item] = $item;
    }
    foreach (Language::installedLanguage() as $item) {
      $languages[$item] = $item;
    }
    return array_keys($languages);
  }

  /**
   * คืนค่าลิงค์รูปแบบโทรศัพท์
   *
   * @param string $phone_number
   * @return string
   */
  public static function showPhone($phone_number)
  {
    $result = array();
    foreach (explode(',', $phone_number) AS $phone) {
      $result[] = '<a href="tel:'.$phone.'">'.$phone.'</a>';
    }
    return empty($result) ? '' : implode(', ', $result);
  }
}
