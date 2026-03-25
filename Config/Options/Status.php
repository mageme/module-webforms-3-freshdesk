<?php
/**
 * MageMe
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MageMe.com license that is
 * available through the world-wide-web at this URL:
 * https://mageme.com/license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to a newer
 * version in the future.
 *
 * Copyright (c) MageMe (https://mageme.com)
 **/

namespace MageMe\WebFormsFreshdesk\Config\Options;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return $this->defaultOptions();
    }

    /**
     * @return array
     */
    private function defaultOptions(): array
    {
        return [
            [
                'label' => __('Open'),
                'value' => 2
            ],
            [
                'label' => __('Pending'),
                'value' => 3
            ],
            [
                'label' => __('Resolved'),
                'value' => 4
            ],
            [
                'label' => __('Closed'),
                'value' => 5
            ],
            [
                'label' => __('Waiting on Customer'),
                'value' => 6
            ],
            [
                'label' => __('Waiting on Third Party'),
                'value' => 7
            ],
        ];
    }
}