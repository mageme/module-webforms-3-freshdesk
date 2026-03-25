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

namespace MageMe\WebFormsFreshdesk\Ui\Component\Form\Form\Modifier;

use InvalidArgumentException;
use MageMe\WebForms\Api\Data\FieldInterface;
use MageMe\WebForms\Api\Data\FormInterface as FormInterfaceAlias;
use MageMe\WebForms\Api\FormRepositoryInterface;
use MageMe\WebForms\Model\Field\Type\Email;
use MageMe\WebFormsFreshdesk\Api\Data\FormInterface;
use MageMe\WebFormsFreshdesk\Config\Options\Agents;
use MageMe\WebFormsFreshdesk\Config\Options\Companies;
use MageMe\WebFormsFreshdesk\Config\Options\EmailConfigs;
use MageMe\WebFormsFreshdesk\Config\Options\Groups;
use MageMe\WebFormsFreshdesk\Config\Options\Priority;
use MageMe\WebFormsFreshdesk\Config\Options\Source;
use MageMe\WebFormsFreshdesk\Config\Options\Status;
use MageMe\WebFormsFreshdesk\Config\Options\TicketFields;
use MageMe\WebFormsFreshdesk\Config\Options\Type;
use MageMe\WebFormsFreshdesk\Helper\FreshdeskHelper;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Form;
use Magento\Ui\Component\Form\Element\ActionDelete;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;

class FreshdeskIntegrationSettings implements ModifierInterface
{
    const FRESHDESK_FIELD_ID = 'freshdesk_field_id';
    /**
     * @var FormRepositoryInterface
     */
    private $formRepository;
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var Agents
     */
    private $agents;
    /**
     * @var FreshdeskHelper
     */
    private $freshdeskHelper;
    /**
     * @var Companies
     */
    private $companies;
    /**
     * @var EmailConfigs
     */
    private $emailConfigs;
    /**
     * @var Groups
     */
    private $groups;
    /**
     * @var Priority
     */
    private $priority;
    /**
     * @var Source
     */
    private $source;
    /**
     * @var Status
     */
    private $status;
    /**
     * @var Type
     */
    private $type;
    /**
     * @var TicketFields
     */
    private $ticketFields;

    /**
     * @param TicketFields $ticketFields
     * @param Type $type
     * @param Status $status
     * @param Source $source
     * @param Priority $priority
     * @param Groups $groups
     * @param EmailConfigs $emailConfigs
     * @param Companies $companies
     * @param Agents $agents
     * @param FreshdeskHelper $freshdeskHelper
     * @param RequestInterface $request
     * @param FormRepositoryInterface $formRepository
     */
    public function __construct(
        TicketFields $ticketFields,
        Type $type,
        Status $status,
        Source $source,
        Priority $priority,
        Groups $groups,
        EmailConfigs $emailConfigs,
        Companies $companies,
        Agents $agents,
        FreshdeskHelper $freshdeskHelper,
        RequestInterface        $request,
        FormRepositoryInterface $formRepository
    )
    {
        $this->formRepository = $formRepository;
        $this->request        = $request;
        $this->freshdeskHelper        = $freshdeskHelper;
        $this->agents        = $agents;
        $this->companies        = $companies;
        $this->emailConfigs        = $emailConfigs;
        $this->groups        = $groups;
        $this->priority        = $priority;
        $this->source        = $source;
        $this->status        = $status;
        $this->type        = $type;
        $this->ticketFields        = $ticketFields;
    }

    /**
     * @inheritDoc
     */
    public function modifyData(array $data): array
    {
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function modifyMeta(array $meta): array
    {
        try {
            $this->freshdeskHelper->validateConfig();
        } catch (InvalidArgumentException $exception) {
            return $meta;
        }

        $meta['freshdesk_integration_settings'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => Form\Fieldset::NAME,
                        'label' => __('Freshdesk Integration Settings'),
                        'sortOrder' => 180,
                        'collapsible' => true,
                        'opened' => false,
                    ]
                ]
            ],
            'children' => [
                FormInterface::FRESHDESK_IS_TICKET_ENABLED => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Form\Field::NAME,
                                'formElement' => Form\Element\Checkbox::NAME,
                                'dataType' => Form\Element\DataType\Boolean::NAME,
                                'visible' => 1,
                                'sortOrder' => 10,
                                'label' => __('Create Ticket'),
                                'default' => '0',
                                'prefer' => 'toggle',
                                'valueMap' => ['false' => '0', 'true' => '1'],
                            ]
                        ]
                    ]
                ],
                FormInterface::FRESHDESK_TICKET_EMAIL_FIELD_ID => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Form\Field::NAME,
                                'formElement' => Form\Element\Select::NAME,
                                'dataType' => Form\Element\DataType\Number::NAME,
                                'visible' => 1,
                                'sortOrder' => 20,
                                'label' => __('Customer Email'),
                                'options' => $this->getFields(Email::class),
                                'caption' => __('Default'),
                            ]
                        ]
                    ]
                ],
                FormInterface::FRESHDESK_TICKET_RESPONDER_ID => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Form\Field::NAME,
                                'formElement' => Form\Element\Select::NAME,
                                'dataType' => Form\Element\DataType\Text::NAME,
                                'visible' => 1,
                                'sortOrder' => 30,
                                'label' => __('Agent'),
                                'options' => $this->agents->toOptionArray(),
                                'caption' => __('-- Unassigned --'),
                            ]
                        ]
                    ]
                ],
                FormInterface::FRESHDESK_TICKET_GROUP_ID => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Form\Field::NAME,
                                'formElement' => Form\Element\Select::NAME,
                                'dataType' => Form\Element\DataType\Text::NAME,
                                'visible' => 1,
                                'sortOrder' => 50,
                                'label' => __('Group'),
                                'options' => $this->groups->toOptionArray(),
                                'caption' => __('-- Default --'),
                            ]
                        ]
                    ]
                ],
                FormInterface::FRESHDESK_TICKET_TYPE => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Form\Field::NAME,
                                'formElement' => Form\Element\Select::NAME,
                                'dataType' => Form\Element\DataType\Text::NAME,
                                'visible' => 1,
                                'sortOrder' => 70,
                                'label' => __('Type'),
                                'options' => $this->type->toOptionArray(),
                                'caption' => __('-- Unassigned --'),
                            ]
                        ]
                    ]
                ],
                FormInterface::FRESHDESK_TICKET_STATUS => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Form\Field::NAME,
                                'formElement' => Form\Element\Select::NAME,
                                'dataType' => Form\Element\DataType\Text::NAME,
                                'visible' => 1,
                                'sortOrder' => 80,
                                'label' => __('Status'),
                                'options' => $this->status->toOptionArray(),
                                'caption' => __('-- Default --'),
                            ]
                        ]
                    ]
                ],
                FormInterface::FRESHDESK_TICKET_PRIORITY => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Form\Field::NAME,
                                'formElement' => Form\Element\Select::NAME,
                                'dataType' => Form\Element\DataType\Text::NAME,
                                'visible' => 1,
                                'sortOrder' => 90,
                                'label' => __('Priority'),
                                'options' => $this->priority->toOptionArray(),
                                'caption' => __('-- Default --'),
                            ]
                        ]
                    ]
                ],
                FormInterface::FRESHDESK_TICKET_SOURCE => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Form\Field::NAME,
                                'formElement' => Form\Element\Select::NAME,
                                'dataType' => Form\Element\DataType\Text::NAME,
                                'visible' => 1,
                                'sortOrder' => 100,
                                'label' => __('Source'),
                                'options' => $this->source->toOptionArray(),
                                'caption' => __('-- Default --'),
                            ]
                        ]
                    ]
                ],
                FormInterface::FRESHDESK_TICKET_TAGS => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Form\Field::NAME,
                                'formElement' => Form\Element\Textarea::NAME,
                                'dataType' => Form\Element\DataType\Text::NAME,
                                'visible' => 1,
                                'sortOrder' => 110,
                                'label' => __('Tags'),
                                'additionalInfo' => __('Tags should be separated with new line'),
                                'rows' => 5,
                            ]
                        ]
                    ]
                ],
                FormInterface::FRESHDESK_TICKET_MAP_FIELDS => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => DynamicRows::NAME,
                                'visible' => 1,
                                'sortOrder' => 120,
                                'label' => __('Fields Mapping'),
                            ]
                        ]
                    ],
                    'children' => [
                        'record' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'componentType' => Container::NAME,
                                        'isTemplate' => true,
                                        'is_collection' => true,
                                    ]
                                ]
                            ],
                            'children' => [
                                self::FRESHDESK_FIELD_ID => [
                                    'arguments' => [
                                        'data' => [
                                            'config' => [
                                                'componentType' => Form\Field::NAME,
                                                'formElement' => Form\Element\Select::NAME,
                                                'dataType' => Form\Element\DataType\Text::NAME,
                                                'visible' => 1,
                                                'sortOrder' => 10,
                                                'label' => __('Freshdesk Ticket Attribute'),
                                                'options' => $this->ticketFields->toOptionArray(),
                                                'validation' => [
                                                    'required-entry' => true,
                                                ],
                                            ]
                                        ]
                                    ]
                                ],
                                FieldInterface::ID => [
                                    'arguments' => [
                                        'data' => [
                                            'config' => [
                                                'componentType' => Form\Field::NAME,
                                                'formElement' => Form\Element\Select::NAME,
                                                'dataType' => Form\Element\DataType\Text::NAME,
                                                'visible' => 1,
                                                'sortOrder' => 20,
                                                'label' => __('Field'),
                                                'options' => $this->getFields(),
                                                'validation' => [
                                                    'required-entry' => true,
                                                ],
                                            ]
                                        ]
                                    ]
                                ],
                                ActionDelete::NAME => [
                                    'arguments' => [
                                        'data' => [
                                            'config' => [
                                                'componentType' => ActionDelete::NAME,
                                                'dataType' => Form\Element\DataType\Text::NAME,
                                                'label' => '',
                                                'sortOrder' => 30,
                                            ],
                                        ],
                                    ],
                                ],
                            ]
                        ]
                    ]
                ],
            ]
        ];
        return $meta;
    }

    /**
     * @param mixed $type
     * @return array
     */
    private function getFields($type = false): array
    {
        $formId = (int)$this->request->getParam(FormInterfaceAlias::ID);
        if (!$formId) {
            return [];
        }
        try {
            return $this->formRepository->getById($formId)->getFieldsAsOptions($type);
        } catch (NoSuchEntityException $e) {
            return [];
        }
    }
}