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

use Exception;
use MageMe\WebFormsFreshdesk\Helper\FreshdeskHelper;
use Magento\Framework\Data\OptionSourceInterface;

class TicketFields implements OptionSourceInterface
{
    /**
     * @var array
     */
    private $options;
    /**
     * @var FreshdeskHelper
     */
    private $freshdeskHelper;

    /**
     * @param FreshdeskHelper $freshdeskHelper
     */
    public function __construct(FreshdeskHelper $freshdeskHelper)
    {
        $this->freshdeskHelper = $freshdeskHelper;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        if ($this->options) {
            return $this->options;
        }
        $options = $this->defaultOptions();
        try {
            $ticketFields = $this->freshdeskHelper->getApi()->getTicketFields();
            foreach ($ticketFields as $field) {
                if ($field['default'] === false) {
                    $options[] = [
                        'label' => $field['label_for_customers'],
                        'value' => $field['name']
                    ];
                }
            }
            $this->options = $options;
        } catch (Exception $exception) {
            return $this->defaultOptions();
        }
        return $this->options;

    }

    /**
     * @return array
     */
    private function defaultOptions(): array
    {
        return [
            [
                'label' => __('Name of the requester'),
                'value' => 'name'
            ],
            [
                'label' => __('Email address of the requester'),
                'value' => 'email'
            ],
            [
                'label' => __('Phone number of the requester'),
                'value' => 'phone'
            ],
            [
                'label' => __('Subject'),
                'value' => 'subject'
            ],
            [
                'label' => __('Type'),
                'value' => 'type'
            ],
            [
                'label' => __('Status'),
                'value' => 'status'
            ],
            [
                'label' => __('Priority'),
                'value' => 'priority'
            ],
            [
                'label' => __('Description'),
                'value' => 'description'
            ],
            [
                'label' => __('Attachments'),
                'value' => 'attachments'
            ],
            [
                'label' => __('Timestamp that denotes when the ticket is due to be resolved'),
                'value' => 'due_by'
            ],
            [
                'label' => __('Timestamp that denotes when the first response is due'),
                'value' => 'fr_due_by'
            ],
            [
                'label' => __('Source'),
                'value' => 'source'
            ],
            [
                'label' => __('Tags'),
                'value' => 'tags'
            ],
        ];
    }
}