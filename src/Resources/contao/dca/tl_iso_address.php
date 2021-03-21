<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Isotope Edit Order Addresses extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

$GLOBALS['TL_DCA']['tl_iso_address']['fields']['store_id']['foreignKey'] = 'tl_iso_config.name';
$GLOBALS['TL_DCA']['tl_iso_address']['fields']['store_id']['inputType'] = 'select';
$GLOBALS['TL_DCA']['tl_iso_address']['fields']['store_id']['eval']['mandatory'] = false;
$GLOBALS['TL_DCA']['tl_iso_address']['fields']['store_id']['eval']['includeBlankOption'] = true;
