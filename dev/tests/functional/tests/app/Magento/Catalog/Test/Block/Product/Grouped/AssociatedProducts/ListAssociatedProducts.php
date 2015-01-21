<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Catalog\Test\Block\Product\Grouped\AssociatedProducts;

use Mtf\Block\Block;
use Mtf\Client\Locator;
use Mtf\Client\Element\SimpleElement;
use Mtf\Factory\Factory;

/**
 * Class ListAssociatedProducts
 * List associated products on the page
 */
class ListAssociatedProducts extends Block
{
    /**
     * Getting block products
     *
     * @param string $productId
     * @param SimpleElement $context
     * @return ListAssociatedProducts\Product
     */
    private function getProductBlock($productId, SimpleElement $context = null)
    {
        $element = $context ?: $this->_rootElement;
        return Factory::getBlockFactory()
            ->getMagentoCatalogProductGroupedAssociatedProductsListAssociatedProductsProduct(
                $element->find(
                    sprintf("//tr[td/input[@data-role='id' and @value='%s']]", $productId),
                    Locator::SELECTOR_XPATH
                )
            );
    }

    /**
     * Filling options products
     *
     * @param array $data
     * @param SimpleElement $element
     */
    public function fillProductOptions(array $data, SimpleElement $element = null)
    {
        $productBlock = $this->getProductBlock($data['product_id']['value'], $element);
        $productBlock->fillQty($data['selection_qty']['value']);
    }
}
