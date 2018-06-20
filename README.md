# Techspot - Brcustomer - Magento 2 Module

The Tech Spot Module - BRCustomer for Magento 2 enables the registration of PF (Individuals) and PJ (Legal Entity) clients in the customer register of their Magento application.


### Install

Installe via composer:

```
cd <your Magento install dir>
composer require techspot/brcustomer
php bin/magento module:enable --clear-static-content Techspot_Brcustomer
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy //ou php bin/magento setup:static-content:deploy pt_BR
```

## Authors

* **Bruno Monteiro** - *Initial work* - [TechSpot](https://github.com/techspotbr)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

