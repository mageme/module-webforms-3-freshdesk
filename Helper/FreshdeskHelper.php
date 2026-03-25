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

namespace MageMe\WebFormsFreshdesk\Helper;

use InvalidArgumentException;
use MageMe\WebFormsFreshdesk\Helper\Freshdesk\Api;
use Magento\Framework\App\Config\ScopeConfigInterface;

class FreshdeskHelper
{
    const CONFIG_DOMAIN = 'webforms/freshdesk/domain';
    const CONFIG_API_KEY = 'webforms/freshdesk/api_key';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var Api
     */
    private $api;

    /**
     * @param Api $api
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(Api $api, ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        $this->api         = $api;
    }

    /**
     * @return string|null
     */
    protected function getConfigDomain(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_DOMAIN);
    }

    /**
     * @return string|null
     */
    protected function getConfigApiKey(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_API_KEY);
    }

    /**
     * @return Api
     */
    public function getApi(): Api
    {
        $this->validateConfig();
        $this->api->setDomain($this->getConfigDomain());
        $this->api->setApiKey($this->getConfigApiKey());
        return $this->api;
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function validateConfig()
    {
        if (empty($this->getConfigDomain())) {
            throw new InvalidArgumentException(__('Freshdesk domain not configured.'));
        }
        if (empty($this->getConfigApiKey())) {
            throw new InvalidArgumentException(__('Freshdesk api key not configured.'));
        }
    }
}