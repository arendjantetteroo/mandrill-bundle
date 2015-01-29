# Mandrill bundle [![Build Status](https://travis-ci.org/shareworks/mandrill-bundle.svg?branch=master)](https://travis-ci.org/shareworks/mandrill-bundle)

> A Symfony bundle for interfacing with the Mandrill API

## Installation

You can install this bundle using [Composer](https://getcomposer.org):

```
$ composer require shareworks/mandrill-bundle
```

Add the bundle and JMSSerializerBundle to the `app/AppKernel.php` file:

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Shareworks\Bundle\MandrillBundle\ShareworksMandrillBundle(),
        );
        
        return $bundles;
    }
}
```

Add the webhook route to your routing config:
 
```yml
shareworks_mandrill.webhooks:
    resource: @ShareworksMandrillBundle/Resources/config/routing/webhook.xml
```

## Configuration

This bundle exposes the following configuration options:

```yml
shareworks_mandrill:
    api_key:              ~ # Required
```

