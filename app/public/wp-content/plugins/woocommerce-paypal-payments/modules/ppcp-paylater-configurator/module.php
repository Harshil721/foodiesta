<?php
/**
 * The Pay Later configurator module.
 *
 * @package WooCommerce\PayPalCommerce\PayLaterConfigurator
 */

declare(strict_types=1);

namespace WooCommerce\PayPalCommerce\PayLaterConfigurator;

return static function (): PayLaterConfiguratorModule {
	return new PayLaterConfiguratorModule();
};