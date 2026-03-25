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
use Magento\Framework\HTTP\Client\Curl;
use Psr\Log\LoggerInterface;

class Api
{
    const UNEXPECTED_ERROR = 'Unexpected error';

    private $domain;
    private $apiKey;

    /**
     * @var Curl
     */
    private $curl;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     * @param Curl $curl
     */
    public function __construct(
        LoggerInterface $logger,
        Curl            $curl
    ) {
        $this->curl   = $curl;
        $this->logger = $logger;
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, true);
        $this->curl->setOption(CURLOPT_FOLLOWLOCATION, true);
    }

    #region Getters\Setters

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string|null $domain
     * @return Api
     */
    public function setDomain(?string $domain): Api
    {
        $this->domain = 'https://' . $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string|null $apiKey
     * @return Api
     */
    public function setApiKey(?string $apiKey): Api
    {
        $this->apiKey = $apiKey;
        return $this;

    }
    #endregion

    /**
     * @return array
     * @throws Exception
     */
    public function getAgents(): array
    {
        $this->curl->setHeaders([]);
        $this->curl->setOptions([
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERPWD => $this->apiKey . ':X'
        ]);
        $this->curl->get($this->domain . '/api/v2/agents');
        $response = json_decode($this->curl->getBody(), true);
        if (!is_array($response)) {
            $this->logger->error(Api::UNEXPECTED_ERROR . ' body: ' . $this->curl->getBody());
            throw new Exception(__(Api::UNEXPECTED_ERROR));
        }
        if (isset($response['message'])) {
            $this->logger->error($response['message'] . ' body: ' . $this->curl->getBody());
            throw new Exception(__($response['message']));
        }
        return $response ?? [];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getEmailConfigs(): array
    {
        $this->curl->setHeaders([]);
        $this->curl->setOptions([
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERPWD => $this->apiKey . ':X'
        ]);
        $this->curl->get($this->domain . '/api/v2/email_configs');
        $response = json_decode($this->curl->getBody(), true);
        if (!is_array($response)) {
            $this->logger->error(Api::UNEXPECTED_ERROR . ' body: ' . $this->curl->getBody());
            throw new Exception(__(Api::UNEXPECTED_ERROR));
        }
        if (isset($response['message'])) {
            $this->logger->error($response['message'] . ' body: ' . $this->curl->getBody());
            throw new Exception(__($response['message']));
        }
        return $response ?? [];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getGroups(): array
    {
        $this->curl->setHeaders([]);
        $this->curl->setOptions([
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERPWD => $this->apiKey . ':X'
        ]);
        $this->curl->get($this->domain . '/api/v2/groups?per_page=100');
        $response = json_decode($this->curl->getBody(), true);
        if (!is_array($response)) {
            $this->logger->error(Api::UNEXPECTED_ERROR . ' body: ' . $this->curl->getBody());
            throw new Exception(__(Api::UNEXPECTED_ERROR));
        }
        if (isset($response['message'])) {
            $this->logger->error($response['message'] . ' body: ' . $this->curl->getBody());
            throw new Exception(__($response['message']));
        }
        return $response ?? [];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getCompanies(): array
    {
        $this->curl->setHeaders([]);
        $this->curl->setOptions([
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERPWD => $this->apiKey . ':X'
        ]);
        $this->curl->get($this->domain . '/api/v2/companies');
        $response = json_decode($this->curl->getBody(), true);
        if (!is_array($response)) {
            $this->logger->error(Api::UNEXPECTED_ERROR . ' body: ' . $this->curl->getBody());
            throw new Exception(__(Api::UNEXPECTED_ERROR));
        }
        if (isset($response['message'])) {
            $this->logger->error($response['message'] . ' body: ' . $this->curl->getBody());
            throw new Exception(__($response['message']));
        }
        return $response ?? [];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getTicketFields(): array
    {
        $this->curl->setHeaders([]);
        $this->curl->setOptions([
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERPWD => $this->apiKey . ':X'
        ]);
        $this->curl->get($this->domain . '/api/v2/admin/ticket_fields');
        $response = json_decode($this->curl->getBody(), true);
        if (!is_array($response)) {
            $this->logger->error(Api::UNEXPECTED_ERROR . ' body: ' . $this->curl->getBody());
            throw new Exception(__(Api::UNEXPECTED_ERROR));
        }
        if (isset($response['message'])) {
            $this->logger->error($response['message'] . ' body: ' . $this->curl->getBody());
            throw new Exception(__($response['message']));
        }
        return $response ?? [];
    }

    /**
     * @param array $ticket
     * @return string
     * @throws Exception
     */
    public function createTicket(array $ticket): string
    {
        $this->curl->setHeaders([
            'Content-Type' => 'application/json',
        ]);
        $this->curl->setOptions([
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERPWD => $this->apiKey . ':X'
        ]);
        $this->curl->post($this->domain . '/api/v2/tickets', json_encode($ticket));
        $response = json_decode($this->curl->getBody(), true);
        if (!is_array($response)) {
            $this->logger->error(Api::UNEXPECTED_ERROR . ' body: ' . $this->curl->getBody());
        }
        if (!isset($response['id'])) {
            $message = $response['message'] ?? Api::UNEXPECTED_ERROR;
            $this->logger->error($message . ' body: ' . $this->curl->getBody());
            throw new Exception(__($message));
        }
        return $response['id'];
    }

    /**
     * @param string $id
     * @param array $attachments
     * @return mixed
     * @throws Exception
     */
    public function addTicketAttachments(string $id, array $attachments) {
        $data = "";
        $eol = "\r\n";
        $mimeBoundary = md5(time());

        foreach ($attachments as $attachment) {
            $data .= '--' . $mimeBoundary . $eol;
            $data .= 'Content-Disposition: form-data; name="attachments[]"; filename="' . $attachment['name'] . '"' . $eol;
            $data .= "Content-Type: " . $attachment['type'] . $eol . $eol;
            $data .= file_get_contents(realpath($attachment['path'])) . $eol;
        }

        $data .= "--" . $mimeBoundary . "--" . $eol . $eol;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS | CURLPROTO_FTP | CURLPROTO_FTPS,
            CURLOPT_URL => $this->domain . '/api/v2/tickets/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_USERPWD => $this->apiKey . ':X',
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                'Content-type: multipart/form-data; boundary=' . $mimeBoundary
            ],
        ]);

        $body = curl_exec($curl);
        $err  = curl_errno($curl);
        if ($err) {
            $message = curl_error($curl);
            $this->logger->error('Curl error: ' . $message);
            throw new Exception(__($message));
        }
        curl_close($curl);
        $response = json_decode($body, true);


        if (!is_array($response)) {
            $this->logger->error(Api::UNEXPECTED_ERROR . ' body: ' . $body);

        }
        if (!isset($response['id'])) {
            $message = $response['message'] ?? Api::UNEXPECTED_ERROR;
            $this->logger->error($message . ' bodyS: ' . $body);
            throw new Exception(__($message));
        }
        return $response['id'];
    }
 }