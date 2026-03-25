# Magento 2 Freshdesk Integration — MageMe WebForms

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mageme/module-webforms-3-freshdesk.svg)](https://packagist.org/packages/mageme/module-webforms-3-freshdesk)
[![Packagist Downloads](https://img.shields.io/packagist/dt/mageme/module-webforms-3-freshdesk.svg)](https://packagist.org/packages/mageme/module-webforms-3-freshdesk)
[![License](https://img.shields.io/packagist/l/mageme/module-webforms-3-freshdesk.svg)](https://mageme.com/license/)

Connect your Magento 2 store forms directly to Freshdesk. This free add-on for [MageMe WebForms](https://mageme.com/magento-2-form-builder.html) automatically creates Freshdesk support tickets from customer form submissions — no coding required.

## Features

- Automatically create Freshdesk tickets when customers submit a form
- Map form fields to Freshdesk ticket properties (type, status, priority, source)
- Auto-assign tickets to specific agents, groups, and companies
- Attach uploaded files and gallery images to tickets with MIME type preservation
- Support for Freshdesk custom fields (cf_* prefix) with automatic type conversion
- Apply multiple tags to tickets for organized ticket management
- Resend submissions to Freshdesk manually from the Magento admin panel

## Requirements

- Magento 2.4.x
- [MageMe WebForms 3](https://mageme.com/magento-2-form-builder.html) version 3.5.0 or higher
- PHP `curl` and `json` extensions
- Freshdesk account with API access

## Installation

```
composer require mageme/module-webforms-3-freshdesk
bin/magento setup:upgrade
bin/magento cache:flush
```

## Configuration

1. Go to **Stores > Configuration > MageMe > WebForms > Freshdesk** and enter your Freshdesk domain and API key.
2. Open any form in the admin panel and configure the Freshdesk integration tab to map fields and set ticket properties.

## Other MageMe WebForms Integrations

Extend your Magento 2 forms with more CRM and marketing integrations:

- [HubSpot](https://github.com/mageme/module-webforms-3-hubspot) — sync contacts, companies, and tickets
- [Salesforce](https://github.com/mageme/module-webforms-3-salesforce) — create leads from form submissions
- [Zoho CRM & Desk](https://github.com/mageme/module-webforms-3-zoho) — create leads and support tickets
- [Zendesk](https://github.com/mageme/module-webforms-3-zendesk) — create tickets with custom field types
- [Klaviyo](https://github.com/mageme/module-webforms-3-klaviyo) — build profiles and grow your email lists
- [Mailchimp](https://github.com/mageme/module-webforms-3-mailchimp) — subscribe customers to audiences
- [Zapier](https://github.com/mageme/module-webforms-3-zapier) — connect forms to 7000+ apps

## About MageMe WebForms

[MageMe WebForms](https://mageme.com/magento-2-form-builder.html) is a form builder extension for Magento 2 used by store owners to create contact forms, surveys, registration forms, order forms, and more. It features conditional logic, multi-step forms, file uploads, email notifications, customer submission dashboards, and integrations with popular CRM and marketing platforms.

[Get MageMe WebForms for Magento 2](https://mageme.com/magento-2-form-builder.html)

## Support

- Documentation: [docs.mageme.com](https://docs.mageme.com)
- Issue Tracker: [GitHub Issues](https://github.com/mageme/module-webforms-3-freshdesk/issues)

## License

Proprietary. See [License](https://mageme.com/license/) for details.
