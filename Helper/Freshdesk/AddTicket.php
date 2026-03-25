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

namespace MageMe\WebFormsFreshdesk\Helper\Freshdesk;

use Exception;
use MageMe\WebForms\Api\Data\FieldInterface;
use MageMe\WebForms\Api\Data\FileDropzoneInterface;
use MageMe\WebForms\Api\Data\FormInterface;
use MageMe\WebForms\Api\Data\ResultInterface;
use MageMe\WebForms\Api\FieldRepositoryInterface;
use MageMe\WebForms\Api\FileGalleryRepositoryInterface;
use MageMe\WebForms\Model\Field\Type\File;
use MageMe\WebForms\Model\Field\Type\Gallery;
use MageMe\WebFormsFreshdesk\Helper\FreshdeskHelper;
use MageMe\WebFormsFreshdesk\Ui\Component\Form\Form\Modifier\FreshdeskIntegrationSettings;
use Magento\Framework\Exception\NoSuchEntityException;

class AddTicket
{
    /**
     * @var FreshdeskHelper
     */
    private $freshdeskHelper;
    /**
     * @var FieldRepositoryInterface
     */
    private $fieldRepository;
    /**
     * @var FileGalleryRepositoryInterface
     */
    private $fileGalleryRepository;

    /**
     * @param FileGalleryRepositoryInterface $fileGalleryRepository
     * @param FieldRepositoryInterface $fieldRepository
     * @param FreshdeskHelper $freshdeskHelper
     */
    public function __construct(
        FileGalleryRepositoryInterface $fileGalleryRepository,
        FieldRepositoryInterface       $fieldRepository,
        FreshdeskHelper                $freshdeskHelper
    )
    {
        $this->freshdeskHelper       = $freshdeskHelper;
        $this->fieldRepository       = $fieldRepository;
        $this->fileGalleryRepository = $fileGalleryRepository;
    }

    /**
     * @param ResultInterface $result
     * @return void
     * @throws NoSuchEntityException
     * @throws Exception
     */
    public function execute(ResultInterface $result)
    {
        /** @var \MageMe\WebFormsFreshdesk\Api\Data\FormInterface $form */
        $form     = $result->getForm();
        $email    = $this->getEmail($form, $result);
        $name     = $result->getCustomerName();
        $customer = $result->getCustomer();
        if ($customer) {
            $name = $customer->getName();
        }
        $ticket = [
            'name'        => $name,
            'subject'     => html_entity_decode($result->getSubject()),
            'email'       => $email,
            'description' => $result->toHtml(),
        ];
        if ($form->getFreshdeskTicketResponderId()) {
            $ticket['responder_id'] = (int)$form->getFreshdeskTicketResponderId();
        }
        if ($form->getFreshdeskTicketEmailConfigId()) {
            $ticket['email_config_id'] = (int)$form->getFreshdeskTicketEmailConfigId();
        }
        if ($form->getFreshdeskTicketGroupId()) {
            $ticket['group_id'] = (int)$form->getFreshdeskTicketGroupId();
        }
        if ($form->getFreshdeskTicketCompanyId()) {
            $ticket['company_id'] = (int)$form->getFreshdeskTicketCompanyId();
        }
        if ($form->getFreshdeskTicketType()) {
            $ticket['type'] = $form->getFreshdeskTicketType();
        }
        if ($form->getFreshdeskTicketStatus()) {
            $ticket['status'] = (int)$form->getFreshdeskTicketStatus();
        }
        if ($form->getFreshdeskTicketPriority()) {
            $ticket['priority'] = (int)$form->getFreshdeskTicketPriority();
        }
        if ($form->getFreshdeskTicketSource()) {
            $ticket['source'] = (int)$form->getFreshdeskTicketSource();
        }
        if ($form->getFreshdeskTicketTags()) {
            $ticket['tags'] = explode("\n", (string)$form->getFreshdeskTicketTags());
        }
        $mapFields = $this->mapFields($form, $result);
        $ticket    = array_merge($ticket, $mapFields['ticket']);
        $api       = $this->freshdeskHelper->getApi();

        $id = $api->createTicket($ticket);
        if (!$id) {
            return;
        }
        $attachments = [];
        foreach ($mapFields['files'] as $file) {
            foreach ($file['value'] as $item) {
                $attachments[] = $item;
            }
        }
        if (!empty($attachments)) {
            $api->addTicketAttachments($id, $attachments);
        }
    }

    /**
     * @param FormInterface|\MageMe\WebFormsFreshdesk\Api\Data\FormInterface $form
     * @param ResultInterface $result
     * @return string
     */
    protected function getEmail(FormInterface $form, ResultInterface $result): string
    {
        $values  = $result->getFieldArray();
        $emailId = $form->getFreshdeskTicketEmailFieldId();
        $email   = $values[$emailId] ?? '';
        if ($email) {
            return $email;
        }
        $emailList = $result->getCustomerEmail();
        return $emailList[0] ?? '';
    }

    /**
     * @param FormInterface|\MageMe\WebFormsFreshdesk\Api\Data\FormInterface $form
     * @param ResultInterface $result
     * @return array
     * @throws NoSuchEntityException
     */
    protected function mapFields(FormInterface $form, ResultInterface $result): array
    {
        $data      = [
            'ticket' => [],
            'files'  => []
        ];
        $values    = $result->getFieldArray();
        $mapFields = $form->getFreshdeskTicketMapFields() ?: [];
        foreach ($mapFields as $mapField) {
            if (empty($values[$mapField[FieldInterface::ID]])) {
                continue;
            }
            $value = '';
            $field = $this->fieldRepository->getById((int)$mapField[FieldInterface::ID]);

            if ($field instanceof File) {
                $field->setData('result', $result);

                /** @var FileDropzoneInterface[] $files */
                $files = $field->getFilteredFieldValue();
                $value = [];
                foreach ($files as $file) {
                    $value[] = [
                        'path' => $file->getFullPath(),
                        'type' => $file->getMimeType(),
                        'name' => $file->getName()
                    ];
                }
                if ($value) {
                    $data['files'][] = [
                        'field' => $mapField[FreshdeskIntegrationSettings::FRESHDESK_FIELD_ID],
                        'value' => $value
                    ];
                }
            } elseif ($field instanceof Gallery) {
                $value  = [];
                $images = $field->parseValue($value);
                foreach ($images as $imageId) {
                    $file    = $this->fileGalleryRepository->getById((int)$imageId);
                    $value[] = [
                        'path' => $file->getFullPath(),
                        'type' => $file->getMimeType(),
                        'name' => $file->getName()
                    ];
                }
                if ($value) {
                    $data['files'][] = [
                        'field' => $mapField[FreshdeskIntegrationSettings::FRESHDESK_FIELD_ID],
                        'value' => $value
                    ];
                }
            } else {
                $value = $field->getValueForResultTemplate(
                    $values[$mapField[FieldInterface::ID]],
                    $result->getId(),
                    ['date_format' => 'Y-m-d']
                );
                if($field->getType() == 'number'){
                    $value = (int)preg_replace('/[^0-9]/', '', $value);
                }
                if (strstr($mapField[FreshdeskIntegrationSettings::FRESHDESK_FIELD_ID], 'cf_')) {
                    $data['ticket']['custom_fields'][$mapField[FreshdeskIntegrationSettings::FRESHDESK_FIELD_ID]] = $value;
                } else {
                    $data['ticket'][$mapField[FreshdeskIntegrationSettings::FRESHDESK_FIELD_ID]] = $value;
                }
            }
        }
        return $data;
    }

}
