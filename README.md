[![Packagist](https://img.shields.io/packagist/dt/drawmyattention/xerolaravel.svg)](https://packagist.org/packages/drawmyattention/xerolaravel)

# Xero Accounting API Laravel 5 Wrapper

A Laravel 5 wrapper for calcinai/xero-php (a custom API for integrating with Xero).

## Installation via Composer

**Require the package**

    composer require drawmyattention/xerolaravel "1.0.*"


**Add the Service Provider to your ```config/app.php``` under ```providers```**

    'DrawMyAttention\XeroLaravel\Providers\XeroServiceProvider',
   
**Register the Facades within ```config/app.php``` under ```aliases```

    'XeroPrivate'=> 'DrawMyAttention\XeroLaravel\Facades\XeroPrivate',
    
**Publish the configuration file**

    php artisan vendor:publish
       
This will create a ```xero/config.php``` within your ```config``` directory. (Note: Ensure that you have generated the
necessary tokens and have generated the RSA keys required by Xero for authentication.) Edit the relevant values in the
```config.php``` file.

Ensure that the location of the RSA keys matches the required format ```(file://absolutepath)```

## Dependencies and Requirements

This Service Provider current wraps the [calcinai/xero-php](https://github.com/calcinai/xero-php) version 1.1.* package.

Additionally, you must have PHP installed with the following extensions:

* php_curl (7.30+)
* php_openssl

## Usage

There are two ways to use the classes: via the IoC container, or via a Facade. They both offer the same functionality, so use each 
depending on your preference.

### Get all invoices 

Facade

    $invoices = XeroPrivate::load('Accounting\\Invoice')->execute();

IoC Container

    // Create an instance of the class, resolved out of the IoC container
    $xero = $this->app->make('XeroPrivate');
        
    $invoices = $xero->load('Accounting\\Invoice')->execute();
        
### Get a single invoice via GUID or invoice number

Facade 

    $invoice = XeroPrivate::loadByGUID('Accounting\\Invoice', 'inv-0004');
    
IoC Container

    $xero = $this->app->make('XeroPrivate');
    
    $invoice = $xero->loadByGUID('Accounting\\Invoice', 'inv-0004');
    
### Update an existing invoice

Facade

    $invoice = XeroPrivate::loadByGUID('Accounting\\Invoice', 'inv-0004');
    
    $invoice->setStatus('Paid');
    
    XeroPrivate::save($invoice);
    
IoC Container

    $xero = $this->app->make('XeroPrivate');
    
    $invoice = $xero->loadByGUID('Accounting\\Invoice', 'inv-0004');
    
    $invoice->setStatus('Paid');
    
    $xero->save($invoice);
    
### Creating a new invoice
    
    /* 
     * Resolve instances of Xero, XeroInvoice, XeroContact 
     * and XeroInvoiceLine out of the IoC container.
     */
     
    $xero = $this->app->make('XeroPrivate');
    $invoice = $this->app->make('XeroInvoice');
    $contact = $this->app->make('XeroContact');
    $line1 = $this->app->make('XeroInvoiceLine');
    $line2 = $this->app->make('XeroInvoiceLine');
    
    // Set up the invoice contact
    $contact->setAccountNumber('DMA01');
    $contact->setContactStatus('ACTIVE');
    $contact->setName('Amo Chohan');
    $contact->setFirstName('Amo');
    $contact->setLastName('Chohan');
    $contact->setEmailAddress('amo.chohan@gmail.com');
    $contact->setDefaultCurrency('GBP');
    
    // Assign the contact to the invoice
    $invoice->setContact($contact);
    
    // Set the type of invoice being created (ACCREC / ACCPAY)
    $invoice->setType('ACCREC');

    $dateInstance = new DateTime();
    $invoice->setDate($dateInstance);
    $invoice->setDueDate($dateInstance);
    $invoice->setInvoiceNumber('DMA-00001');
    $invoice->setReference('DMA-00001');
    
    // Provide an URL which can be linked to from Xero to view the full order
    $invoice->setUrl('http://yourdomain/fullpathtotheorder');
    
    $invoice->setCurrencyCode('GBP');
    $invoice->setStatus('Draft');
    
    // Create some order lines
    $line1->setDescription('Blue tshirt');

    $line1->setQuantity(1);
    $line1->setUnitAmount(99.99);
    $line1->setTaxAmount(0);
    $line1->setLineAmount(99.99);
    $line1->setDiscountRate(0); // Percentage

    // Add the line to the order
    $invoice->addLineItem($line1);

    // Repeat for all lines...

    $xero->save($invoice);

### Creating Attachments

    $xero = $this->app->make('XeroPrivate');
    
    $attachment = $this->app->make('XeroAttachment')
        ->createFromLocalFile(storage_path('your_file.pdf'));
      
    $invoice = $xero->loadByGUID('Accounting\\Invoice', 'AMO-00002');
    $invoice->addAttachment($attachment);
