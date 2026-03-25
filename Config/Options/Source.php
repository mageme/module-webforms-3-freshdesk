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

class Source implements OptionSourceInterface
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
                'label' => __('Email'),
                'value' => 1
            ],
            [
                'label' => __('Portal'),
                'value' => 2
            ],
            [
                'label' => __('Phone'),
                'value' => 3
            ],
            [
                'label' => __('Forum'),
                'value' => 4
            ],
            [
                'label' => __('Twitter'),
                'value' => 5
            ],
            [
                'label' => __('Facebook'),
                'value' => 6
            ],
            [
                'label' => __('Chat'),
                'value' => 7
            ],
            [
                'label' => __('Feedback Widget'),
                'value' => 9
            ],
            [
                'label' => __('Outbound Email'),
                'value' => 10
            ],
        ];
    }
}