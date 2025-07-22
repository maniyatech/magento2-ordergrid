# ManiyaTech OrderGrid module for Magento 2

Enhanced Sales Order Grid by ManiyaTech improves the default Magento admin order grid experience by adding advanced configuration options and visual enhancements. This module gives merchants better insights into sales performance and order data at a glance.

Admins can enable or disable the module from the configuration, customize the sales amount display message with dynamic total replacement, round off prices for easier readability, and enable or disable a new “Purchased Items” column showing product names, SKUs, and quantities. The module also offers the ability to color-code order statuses directly from the backend to improve workflow and highlight specific order states.

### Key Features

<ul>
	<li>✅ <strong>Module Enable/Disable Toggle</strong>: Control whether the enhancements are applied without uninstalling the module.</li>
	<li>💬 <strong>Sales Amount Display Text</strong>: Customize the footer text below the grid with support for Total {{amount}} placeholder.</li>
	<li>💲 <strong>Price Rounding Option</strong>: Round sales amounts to whole numbers to improve visual clarity.</li>
	<li>📦 <strong>Purchased Items Column</strong>: Show detailed item info (name, SKU, quantity) within the grid.</li>
	<li>🎨 <strong>Order Status Colors</strong>: Visually highlight orders using color-coded status mapping.</li>
</ul>

## How to install ManiyaTech_OrderGrid module

### Composer Installation

Run the following command in Magento 2 root directory to install ManiyaTech_OrderGrid module via composer.

#### Install

```
composer require maniyatech/magento2-ordergrid
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```

#### Update

```
composer update maniyatech/magento2-ordergrid
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```

Run below command if your store is in the production mode:

```
php bin/magento setup:di:compile
```

### Manual Installation

If you prefer to install this module manually, kindly follow the steps described below - 

- Download the latest version [here](https://github.com/maniyatech/magento2-ordergrid/archive/refs/heads/main.zip) 
- Create a folder path like this `app/code/ManiyaTech/OrderGrid` and extract the `main.zip` file into it.
- Navigate to Magento root directory and execute the below commands.

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```
