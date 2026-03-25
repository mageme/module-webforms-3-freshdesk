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

namespace MageMe\WebFormsFreshdesk\Api\Data;

interface FormInterface extends \MageMe\WebForms\Api\Data\FormInterface
{
    /** Freshdesk settings */
    const FRESHDESK_IS_TICKET_ENABLED = 'freshdesk_is_ticket_enabled';
    const FRESHDESK_TICKET_EMAIL_FIELD_ID = 'freshdesk_ticket_email_field_id';
    const FRESHDESK_TICKET_RESPONDER_ID = 'freshdesk_ticket_responder_id';
    const FRESHDESK_TICKET_EMAIL_CONFIG_ID = 'freshdesk_ticket_email_config_id';
    const FRESHDESK_TICKET_GROUP_ID = 'freshdesk_ticket_group_id';
    const FRESHDESK_TICKET_COMPANY_ID = 'freshdesk_ticket_company_id';
    const FRESHDESK_TICKET_TYPE = 'freshdesk_ticket_type';
    const FRESHDESK_TICKET_STATUS = 'freshdesk_ticket_status';
    const FRESHDESK_TICKET_PRIORITY = 'freshdesk_ticket_priority';
    const FRESHDESK_TICKET_SOURCE = 'freshdesk_ticket_source';
    const FRESHDESK_TICKET_TAGS = 'freshdesk_ticket_tags';
    const FRESHDESK_TICKET_MAP_FIELDS_SERIALIZED = 'freshdesk_ticket_map_fields_serialized';

    /**
     * Additional constants for keys of data array.
     */
    const FRESHDESK_TICKET_MAP_FIELDS = 'freshdesk_ticket_map_fields';

    #region DB getters and setters
    /**
     * Get freshdeskIsTicketEnabled
     *
     * @return bool
     */
    public function getFreshdeskIsTicketEnabled(): bool;

    /**
     * Set freshdeskIsTicketEnabled
     *
     * @param bool $freshdeskIsTicketEnabled
     * @return $this
     */
    public function setFreshdeskIsTicketEnabled(bool $freshdeskIsTicketEnabled): FormInterface;

    /**
     * Get freshdeskTicketEmailFieldId
     *
     * @return int|null
     */
    public function getFreshdeskTicketEmailFieldId(): ?int;

    /**
     * Set freshdeskTicketEmailFieldId
     *
     * @param int|null $freshdeskTicketEmailFieldId
     * @return $this
     */
    public function setFreshdeskTicketEmailFieldId(?int $freshdeskTicketEmailFieldId): FormInterface;

    /**
     * Get freshdeskTicketResponderId
     *
     * @return string|null
     */
    public function getFreshdeskTicketResponderId(): ?string;

    /**
     * Set freshdeskTicketResponderId
     *
     * @param string $freshdeskTicketResponderId
     * @return $this
     */
    public function setFreshdeskTicketResponderId(string $freshdeskTicketResponderId): FormInterface;

    /**
     * Get freshdeskTicketEmailConfigId
     *
     * @return string|null
     */
    public function getFreshdeskTicketEmailConfigId(): ?string;

    /**
     * Set freshdeskTicketEmailConfigId
     *
     * @param string $freshdeskTicketEmailConfigId
     * @return $this
     */
    public function setFreshdeskTicketEmailConfigId(string $freshdeskTicketEmailConfigId): FormInterface;

    /**
     * Get freshdeskTicketGroupId
     *
     * @return string|null
     */
    public function getFreshdeskTicketGroupId(): ?string;

    /**
     * Set freshdeskTicketGroupId
     *
     * @param string $freshdeskTicketGroupId
     * @return $this
     */
    public function setFreshdeskTicketGroupId(string $freshdeskTicketGroupId): FormInterface;

    /**
     * Get freshdeskTicketCompanyId
     *
     * @return string|null
     */
    public function getFreshdeskTicketCompanyId(): ?string;

    /**
     * Set freshdeskTicketCompanyId
     *
     * @param string $freshdeskTicketCompanyId
     * @return $this
     */
    public function setFreshdeskTicketCompanyId(string $freshdeskTicketCompanyId): FormInterface;

    /**
     * Get freshdeskTicketType
     *
     * @return string|null
     */
    public function getFreshdeskTicketType(): ?string;

    /**
     * Set freshdeskTicketType
     *
     * @param string $freshdeskTicketType
     * @return $this
     */
    public function setFreshdeskTicketType(string $freshdeskTicketType): FormInterface;

    /**
     * Get freshdeskTicketStatus
     *
     * @return string|null
     */
    public function getFreshdeskTicketStatus(): ?string;

    /**
     * Set freshdeskTicketStatus
     *
     * @param string $freshdeskTicketStatus
     * @return $this
     */
    public function setFreshdeskTicketStatus(string $freshdeskTicketStatus): FormInterface;

    /**
     * Get freshdeskTicketPriority
     *
     * @return string|null
     */
    public function getFreshdeskTicketPriority(): ?string;

    /**
     * Set freshdeskTicketPriority
     *
     * @param string $freshdeskTicketPriority
     * @return $this
     */
    public function setFreshdeskTicketPriority(string $freshdeskTicketPriority): FormInterface;

    /**
     * Get freshdeskTicketSource
     *
     * @return string|null
     */
    public function getFreshdeskTicketSource(): ?string;

    /**
     * Set freshdeskTicketSource
     *
     * @param string $freshdeskTicketSource
     * @return $this
     */
    public function setFreshdeskTicketSource(string $freshdeskTicketSource): FormInterface;

    /**
     * Get freshdeskTicketTags
     *
     * @return string|null
     */
    public function getFreshdeskTicketTags(): ?string;

    /**
     * Set freshdeskTicketTags
     *
     * @param string $freshdeskTicketTags
     * @return $this
     */
    public function setFreshdeskTicketTags(string $freshdeskTicketTags): FormInterface;

    /**
     * Get freshdeskTicketMapFieldsSerialized
     *
     * @return string|null
     */
    public function getFreshdeskTicketMapFieldsSerialized(): ?string;

    /**
     * Set freshdeskTicketMapFieldsSerialized
     *
     * @param string $freshdeskTicketMapFieldsSerialized
     * @return $this
     */
    public function setFreshdeskTicketMapFieldsSerialized(string $freshdeskTicketMapFieldsSerialized): FormInterface;

    /**
     * Get freshdeskTicketMapFields
     *
     * @return array
     */
    public function getFreshdeskTicketMapFields(): array;

    /**
     * Set freshdeskTicketMapFields
     *
     * @param array $freshdeskTicketMapFields
     * @return $this
     */
    public function setFreshdeskTicketMapFields(array $freshdeskTicketMapFields): FormInterface;
#endregion

}