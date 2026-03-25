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

namespace MageMe\WebFormsFreshdesk\Model;

use MageMe\WebFormsFreshdesk\Api\Data\FormInterface;

class Form extends \MageMe\WebForms\Model\Form implements FormInterface
{
    #region DB getters and setters
    /**
     * @inheritDoc
     */
    public function getFreshdeskIsTicketEnabled(): bool
    {
        return (bool)$this->getData(self::FRESHDESK_IS_TICKET_ENABLED);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskIsTicketEnabled(bool $freshdeskIsTicketEnabled): FormInterface
    {
        return $this->setData(self::FRESHDESK_IS_TICKET_ENABLED, $freshdeskIsTicketEnabled);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketEmailFieldId(): ?int
    {
        return $this->getData(self::FRESHDESK_TICKET_EMAIL_FIELD_ID);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketEmailFieldId(?int $freshdeskTicketEmailFieldId): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_EMAIL_FIELD_ID, $freshdeskTicketEmailFieldId);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketResponderId(): ?string
    {
        return $this->getData(self::FRESHDESK_TICKET_RESPONDER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketResponderId(string $freshdeskTicketResponderId): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_RESPONDER_ID, $freshdeskTicketResponderId);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketEmailConfigId(): ?string
    {
        return $this->getData(self::FRESHDESK_TICKET_EMAIL_CONFIG_ID);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketEmailConfigId(string $freshdeskTicketEmailConfigId): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_EMAIL_CONFIG_ID, $freshdeskTicketEmailConfigId);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketGroupId(): ?string
    {
        return $this->getData(self::FRESHDESK_TICKET_GROUP_ID);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketGroupId(string $freshdeskTicketGroupId): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_GROUP_ID, $freshdeskTicketGroupId);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketCompanyId(): ?string
    {
        return $this->getData(self::FRESHDESK_TICKET_COMPANY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketCompanyId(string $freshdeskTicketCompanyId): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_COMPANY_ID, $freshdeskTicketCompanyId);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketType(): ?string
    {
        return $this->getData(self::FRESHDESK_TICKET_TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketType(string $freshdeskTicketType): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_TYPE, $freshdeskTicketType);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketStatus(): ?string
    {
        return $this->getData(self::FRESHDESK_TICKET_STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketStatus(string $freshdeskTicketStatus): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_STATUS, $freshdeskTicketStatus);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketPriority(): ?string
    {
        return $this->getData(self::FRESHDESK_TICKET_PRIORITY);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketPriority(string $freshdeskTicketPriority): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_PRIORITY, $freshdeskTicketPriority);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketSource(): ?string
    {
        return $this->getData(self::FRESHDESK_TICKET_SOURCE);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketSource(string $freshdeskTicketSource): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_SOURCE, $freshdeskTicketSource);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketTags(): ?string
    {
        return $this->getData(self::FRESHDESK_TICKET_TAGS);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketTags(string $freshdeskTicketTags): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_TAGS, $freshdeskTicketTags);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketMapFieldsSerialized(): ?string
    {
        return $this->getData(self::FRESHDESK_TICKET_MAP_FIELDS_SERIALIZED);
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketMapFieldsSerialized(string $freshdeskTicketMapFieldsSerialized): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_MAP_FIELDS_SERIALIZED, $freshdeskTicketMapFieldsSerialized);
    }

    /**
     * @inheritDoc
     */
    public function getFreshdeskTicketMapFields(): array
    {
        $data = $this->getData(self::FRESHDESK_TICKET_MAP_FIELDS);
        return is_array($data) ? $data : [];
    }

    /**
     * @inheritDoc
     */
    public function setFreshdeskTicketMapFields(array $freshdeskTicketMapFields): FormInterface
    {
        return $this->setData(self::FRESHDESK_TICKET_MAP_FIELDS, $freshdeskTicketMapFields);
    }
#endregion


}