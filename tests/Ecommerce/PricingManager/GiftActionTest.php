<?php
declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Tests\Ecommerce\PricingManager;

use Pimcore\Bundle\EcommerceFrameworkBundle\PricingManager\Action\Gift;
use Pimcore\Bundle\EcommerceFrameworkBundle\PricingManager\Condition\CartAmount;
use Pimcore\Tests\Ecommerce\PricingManager\Rule\AbstractRuleTest;

class GiftActionTest extends AbstractRuleTest
{
    protected array $productDefinitions1 = [
        'singleProduct' => [
            'id' => 4,
            'price' => 100,
        ],
        'cart' => [
            [
                'id' => 4,
                'price' => 100,
            ],
            [
                'id' => 5,
                'price' => 40,
            ],
        ],

    ];

    protected array $tests1 = [
        'productPriceSingle' => 100,
        'productPriceTotal' => 200,
        'cartSubTotal' => 140,
        'cartGrandTotal' => 140,
        'cartSubTotalModificators' => 140,
        'cartGrandTotalModificators' => 150,
        'giftItemCount' => 0,
    ];

    protected array $productDefinitions2 = [
        'singleProduct' => [
            'id' => 4,
            'price' => 100,
        ],
        'cart' => [
            [
                'id' => 4,
                'price' => 100,
            ],
            [
                'id' => 5,
                'price' => 40,
            ],
            [
                'id' => 6,
                'price' => 80,
            ],
        ],
    ];

    public function testOneGift()
    {
        $pricingManager = $this->buildPricingManager([]);
        $gift1 = $this->setUpProduct(777, 100, $pricingManager);

        $ruleDefinitions = [
            'testrule' => [
                'actions' => [
                    [
                        'class' => Gift::class,
                        'product' => $gift1,
                    ],
                ],
                'condition' => [
                    'class' => CartAmount::class,
                    'limit' => 200,
                ],
            ],
        ];

        $this->doAssertionsWithShippingCosts($ruleDefinitions, $this->productDefinitions1, $this->tests1, false);

        $tests = [
            'productPriceSingle' => 100,
            'productPriceTotal' => 200,
            'cartSubTotal' => 220,
            'cartGrandTotal' => 220,
            'cartSubTotalModificators' => 220,
            'cartGrandTotalModificators' => 230,
            'giftItemCount' => 1,
        ];

        $this->doAssertionsWithShippingCosts($ruleDefinitions, $this->productDefinitions2, $tests, false);
    }

    public function testMultipleGifts()
    {
        $pricingManager = $this->buildPricingManager([]);
        $gift1 = $this->setUpProduct(777, 100, $pricingManager);
        $gift2 = $this->setUpProduct(888, 200, $pricingManager);

        $ruleDefinitions = [
            'testrule' => [
                'actions' => [
                    [
                        'class' => Gift::class,
                        'product' => $gift1,
                    ],
                    [
                        'class' => Gift::class,
                        'product' => $gift2,
                    ],
                ],
                'condition' => [
                    'class' => CartAmount::class,
                    'limit' => 200,
                ],
            ],
        ];

        $this->doAssertionsWithShippingCosts($ruleDefinitions, $this->productDefinitions1, $this->tests1, false);

        $tests = [
            'productPriceSingle' => 100,
            'productPriceTotal' => 200,
            'cartSubTotal' => 220,
            'cartGrandTotal' => 220,
            'cartSubTotalModificators' => 220,
            'cartGrandTotalModificators' => 230,
            'giftItemCount' => 2,
        ];

        $this->doAssertionsWithShippingCosts($ruleDefinitions, $this->productDefinitions2, $tests, false);
    }
}
