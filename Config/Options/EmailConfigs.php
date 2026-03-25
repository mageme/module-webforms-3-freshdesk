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

class EmailConfigs implements OptionSourceInterface
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
        try {
            $emailConfigs = $this->freshdeskHelper->getApi()->getEmailConfigs();
            foreach ($emailConfigs as $emailConfig) {
                $this->options[] = [
                    'label' => $emailConfig['to_email'],
                    'value' => $emailConfig['id']
                ];
            }
        } catch (Exception $exception) {
            return [];
        }
        return $this->options;

    }
}