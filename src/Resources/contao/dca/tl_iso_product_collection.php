<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Isotope Edit Order Addresses extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

use InspiredMinds\ContaoIsotopeEditOrderAddresses\EventListener\DataContainer\ProductCollectionAddressesCallback;

$GLOBALS['TL_DCA']['tl_iso_product_collection']['fields']['billing_address_data']['input_field_callback'][0] = ProductCollectionAddressesCallback::class;
$GLOBALS['TL_DCA']['tl_iso_product_collection']['fields']['shipping_address_data']['input_field_callback'][0] = ProductCollectionAddressesCallback::class;
