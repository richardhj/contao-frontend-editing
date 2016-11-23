<?php

/**
 * This file is part of MetaModels/core.
 *
 * (c) 2012-2015 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage Core
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  2012-2015 The MetaModels team.
 * @license    https://github.com/MetaModels/core/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\Contao\FrontendEditing\Events;

use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;
use MetaModels\Attribute\Checkbox\Checkbox;
use MetaModels\Attribute\IAttribute;
use MetaModels\Attribute\TranslatedCheckbox\TranslatedCheckbox;
use MetaModels\DcGeneral\Data\Model;

/**
 * This class retrieves the options of an attribute within a MetaModel unless someone else already provided them.
 */
class CheckboxOptionsProvider
{
    /**
     * Retrieve the property options.
     *
     * @param GetPropertyOptionsEvent $event The event.
     *
     * @return void
     */
    public static function getPropertyOptions(GetPropertyOptionsEvent $event)
    {
        $model = $event->getModel();
        if (!($model instanceof Model)) {
            return;
        }

        $attribute = $model->getItem()->getAttribute($event->getPropertyName());
        if (!($attribute instanceof IAttribute)) {
            return;
        }

        // Check if we have a checkbox.
        if (!is_a($attribute, Checkbox::class) && !is_a($attribute, TranslatedCheckbox::class)) {
            return;
        }

        // Reset the options we didn't need them for checkbox.
        $event->setOptions(null);
        $event->stopPropagation();
    }
}
