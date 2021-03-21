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

use Contao\DataContainer;
use Contao\Image;
use Contao\System;
use Isotope\Backend\ProductCollection\Callback as ProductCollectionCallback;
use Isotope\Model\Address;
use Isotope\Model\ProductCollection\Order;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProductCollectionAddressesCallback
{
    private $router;
    private $requestStack;
    private $translator;
    private $csrfTokenManager;
    private $csrfTokenName;

    public function __construct(RouterInterface $router, RequestStack $requestStack, TranslatorInterface $translator, CsrfTokenManager $csrfTokenManager, string $csrfTokenName)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
        $this->translator = $translator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->csrfTokenName = $csrfTokenName;
    }

    public function generateBillingAddressData(DataContainer $dc): string
    {
        /** @var ProductCollectionCallback $callback */
        $callback = System::importStatic(ProductCollectionCallback::class);
        $buffer = $callback->generateBillingAddressData($dc);

        /** @var Order $order */
        $order = Order::findByPk($dc->id);

        $edit = $this->getEditButton(null === $order ? null : $order->getBillingAddress());

        return $buffer.$edit;
    }

    public function generateShippingAddressData(DataContainer $dc): string
    {
        /** @var ProductCollectionCallback $callback */
        $callback = System::importStatic(ProductCollectionCallback::class);
        $buffer = $callback->generateShippingAddressData($dc);

        /** @var Order $order */
        $order = Order::findByPk($dc->id);

        $edit = $this->getEditButton(null === $order ? null : $order->getShippingAddress());

        return $buffer.$edit;
    }

    private function getEditButton(Address $address = null): string
    {
        if (null === $address) {
            return '';
        }

        $editUrl = $this->router->generate('contao_backend', [
            'do' => 'iso_orders',
            'table' => 'tl_iso_address',
            'id' => $address->id,
            'act' => 'edit',
            'ref' => $this->requestStack->getCurrentRequest()->attributes->get('_contao_referer_id'),
            'rt' => $this->csrfTokenManager->getToken($this->csrfTokenName)->getValue(),
        ]);

        $editLabel = sprintf($this->translator->trans('MSC.editSelected', [], 'contao_default'), $address->id);
        $image = Image::getHtml('edit.svg', $this->translator->trans('MSC.editSelected', [], 'contao_default'), 'style="vertical-align:text-bottom"');

        return '<div style="margin:2%"><a class="tl_submit" href="'.$editUrl.'">'.$editLabel.' '.$image.'</a></div>';
    }
}
