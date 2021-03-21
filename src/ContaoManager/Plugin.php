<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Isotope Edit Order Addresses extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace InspiredMinds\ContaoIsotopeEditOrderAddresses\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use InspiredMinds\ContaoIsotopeEditOrderAddresses\ContaoIsotopeEditOrderAddressesBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoIsotopeEditOrderAddressesBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
