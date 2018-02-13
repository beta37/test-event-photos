<?php
/**
 * EventPhotos.
 *
 * @copyright Ralf Koester (RK)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Ralf Koester <ralf@familie-koester.de>.
 * @link http://k62.de
 * @link http://zikula.org
 * @version Generated by ModuleStudio 1.3.0 (https://modulestudio.de).
 */

/**
 * The rkeventphotosmoduleObjectTypeSelector plugin provides items for a dropdown selector.
 *
 * Available parameters:
 *   - assign: If set, the results are assigned to the corresponding variable instead of printed out.
 *
 * @param  array            $params All attributes passed to this function from the template
 * @param  Zikula_Form_View $view   Reference to the view object
 *
 * @return string The output of the plugin
 */
function smarty_function_rkeventphotosmoduleObjectTypeSelector($params, $view)
{
    $dom = ZLanguage::getModuleDomain('RKEventPhotosModule');
    $result = [];

    $result[] = [
        'text' => __('Albums', $dom),
        'value' => 'album'
    ];
    $result[] = [
        'text' => __('Album items', $dom),
        'value' => 'albumItem'
    ];

    if (array_key_exists('assign', $params)) {
        $view->assign($params['assign'], $result);

        return;
    }

    return $result;
}