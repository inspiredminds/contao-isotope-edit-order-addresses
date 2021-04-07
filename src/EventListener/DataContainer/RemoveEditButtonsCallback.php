<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Isotope Edit Order Addresses extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace InspiredMinds\ContaoIsotopeEditOrderAddresses\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;

/**
 * @Callback(table="tl_iso_address", target="edit.buttons")
 */
class RemoveEditButtonsCallback
{
    public function __invoke(array $buttons): array
    {
        unset($buttons['saveNcreate'], $buttons['saveNduplicate'], $buttons['saveNback']);

        return $buttons;
    }
}
