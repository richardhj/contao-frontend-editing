<?php

/**
 * This file is part of MetaModels/contao-frontend-editing.
 *
 * (c) 2016 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage ContaoFrontendEditing
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  2016 The MetaModels team.
 * @license    https://github.com/MetaModels/contao-frontend-editing/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;
use MetaModels\Contao\FrontendEditing\EventListener\RenderItemListListener;
use MetaModels\Events\MetaModelsBootEvent;
use MetaModels\MetaModelsEvents;

$handler = new RenderItemListListener();

return [
    MetaModelsEvents::PARSE_ITEM              => [
        [$handler, 'handleForItemRendering']
    ],
    MetaModelsEvents::RENDER_ITEM_LIST        => [
        [$handler, 'handleFrontendEditingInListRendering']
    ],
    MetaModelsEvents::SUBSYSTEM_BOOT_FRONTEND => [
        function (MetaModelsBootEvent $event) {
            $dispatcher = $event->getServiceContainer()->getEventDispatcher();
            $dispatcher->addListener(
                GetPropertyOptionsEvent::NAME,
                'MetaModels\Contao\FrontendEditing\Events\CheckboxOptionsProvider::getPropertyOptions',
                200);
        }
    ]
];
