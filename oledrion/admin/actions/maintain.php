<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * oledrion
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Hossein Azizabadi (azizabadi@faragostaresh.com)
 * @version     $Id$
 */

/**
 * Check is admin
 */
if (!defined("OLEDRION_ADMIN")) exit();

switch ($action) {
    case 'default':
        xoops_cp_header();
        xoops_confirm(array('op' => 'maintain', 'action' => 'confirm'), 'index.php', _AM_OLEDRION_CONF_MAINTAIN);
        break;
        
    case 'confirm':
        xoops_cp_header();
        require '../../xoops_version.php';
        $tables = array();
        foreach ($modversion['tables'] as $table) {
            $tables[] = $xoopsDB->prefix($table);
        }
        if (count($tables) > 0) {
            $list = implode(',', $tables);
            $xoopsDB->queryF('CHECK TABLE ' . $list);
            $xoopsDB->queryF('ANALYZE TABLE ' . $list);
            $xoopsDB->queryF('OPTIMIZE TABLE ' . $list);
        }
        oledrion_utils::updateCache();
        $h_oledrion_products->forceCacheClean();
        oledrion_utils::redirect(_AM_OLEDRION_SAVE_OK, $baseurl, 2);
        break;
}
?>    