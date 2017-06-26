<?php
/**
 * @filesource modules/index/models/menu.php
 * @link http://www.kotchasan.com/
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 */

namespace Index\Menu;

use \Gcms\Login;

/**
 * รายการเมนู
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model
{

  /**
   * รายการเมนู
   *
   * @return array
   */
  public static function getMenus()
  {
    $menus = array(
      'home' => array(
        'text' => '{LNG_Home}',
        'url' => 'index.php?module=home'
      ),
      'settings' => array(
        'text' => '{LNG_Settings}',
        'submenus' => array(
          'system' => array(
            'text' => '{LNG_Site settings}',
            'url' => 'index.php?module=system'
          ),
          'mailserver' => array(
            'text' => '{LNG_Email settings}',
            'url' => 'index.php?module=mailserver'
          ),
          'member' => array(
            'text' => '{LNG_Users}',
            'submenus' => array(
              array(
                'text' => '{LNG_Member list}',
                'url' => 'index.php?module=member'
              ),
              array(
                'text' => '{LNG_Register}',
                'url' => 'index.php?module=register'
              )
            ),
          ),
        ),
      ),
      'signout' => array(
        'text' => '{LNG_Sign Out}',
        'url' => 'index.php?action=logout'
      ),
    );
    // สามารถตั้งค่าระบบได้
    if (!Login::canConfig()) {
      unset($menus['settings']);
    }
    return $menus;
  }
}
