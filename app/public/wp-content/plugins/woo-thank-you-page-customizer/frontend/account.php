<?php
/*
Class Name: VI_WOO_THANK_YOU_PAGE_Frontend_Account
Author: Andy Ha (support@villatheme.com)
Author URI: http://villatheme.com
Copyright 2018 villatheme.com. All rights reserved.
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VI_WOO_THANK_YOU_PAGE_Frontend_Account {
	protected $settings;

	public function __construct() {
		$this->settings = new VI_WOO_THANK_YOU_PAGE_DATA();
		if ( $this->settings->get_params( 'my_account_coupon_enable' ) ) {
			add_filter( 'woocommerce_account_orders_columns', array( $this, 'woocommerce_account_orders_columns' ) );
			add_action( 'woocommerce_my_account_my_orders_column_wtypc_coupon', array(
				$this,
				'woocommerce_my_account_my_orders_column_wtypc_coupon'
			) );
		}
	}

	public function woocommerce_my_account_my_orders_column_wtypc_coupon( $order ) {
		$order_id    = $order->get_id();
		$coupon_code = $order->get_meta( 'woo_thank_you_page_coupon_code', true );
		if ( $coupon_code ) {
			$coupon = new WC_Coupon( $coupon_code );
			$title  = '';
			$css    = '';
			if ( $coupon ) {
				$usage_count  = $coupon->get_usage_count();
				$usage_limit  = $coupon->get_usage_limit();
				$title        .= sprintf( esc_html( 'Used: %1$s/%2$s.' ), esc_html($usage_count), esc_html($usage_limit) );
				$today        = strtotime( 'today' );
				$date_expires = $coupon->get_date_expires();
				$expires      = esc_html__( 'Never', 'woo-thank-you-page-customizer' );
				$date_format = wc_date_format();
				if ( $coupon->get_discount_type() == 'percent' ) {
					$coupon_amount = $coupon->get_amount() . '%';
				} else {
					$coupon_amount = $this->wc_price( $coupon->get_amount() );
				}
				if ( $date_expires ) {
					$expires = $date_expires->date_i18n( $date_format );
					if ( $date_expires->getTimestamp() <= $today ) {
						$css     = 'color:red;';
						$expires = '<span style="' . $css . '">' . $expires . '</span>';
					}
					if ( $usage_count == $usage_limit ) {
						$css = 'color:red;';
					}
				}
				$coupon_info = sprintf( esc_html( '(%1$s - Expires: %2$s)' ), esc_html($coupon_amount), esc_html($expires) );

			}
			?>
            <div title="<?php echo esc_attr( $title ) ?>">
                <span class="woocommerce-thank-you-page-orders-coupon"
                      style="<?php echo esc_attr( $css ) ?>"><?php echo esc_html( strtoupper( $coupon_code ) ) ?></span>
				<?php
				if ( isset( $coupon_info ) ) {
					?>
                    <p><?php echo esc_html( $coupon_info ) ?></p>
					<?php
				}
				?>
            </div>
			<?php
		}
	}

	public function woocommerce_account_orders_columns( $columns ) {
		if ( isset( $columns['order-actions'] ) ) {
			$order_action = $columns['order-actions'];
			unset( $columns['order-actions'] );
			$columns['wtypc_coupon']  = esc_html__( 'Coupon gift', 'woo-thank-you-page-customizer' );
			$columns['order-actions'] = $order_action;
		} else {
			$columns['wtypc_coupon'] = esc_html__( 'Coupon gift', 'woo-thank-you-page-customizer' );

		}

		return $columns;
	}

	public function wc_price( $price, $args = array() ) {
		extract(
			apply_filters(
				'wc_price_args', wp_parse_args(
					$args, array(
						'ex_tax_label'       => false,
						'currency'           => get_option( 'woocommerce_currency' ),
						'decimal_separator'  => get_option( 'woocommerce_price_decimal_sep' ),
						'thousand_separator' => get_option( 'woocommerce_price_thousand_sep' ),
						'decimals'           => get_option( 'woocommerce_price_num_decimals', 2 ),
						'price_format'       => get_woocommerce_price_format(),
					)
				)
			)
		);
		$currency_pos = get_option( 'woocommerce_currency_pos' );
		$price_format = '%1$s%2$s';

		switch ( $currency_pos ) {
			case 'left' :
				$price_format = '%1$s%2$s';
				break;
			case 'right' :
				$price_format = '%2$s%1$s';
				break;
			case 'left_space' :
				$price_format = '%1$s&nbsp;%2$s';
				break;
			case 'right_space' :
				$price_format = '%2$s&nbsp;%1$s';
				break;
		}

		$negative = $price < 0;
		$price    = apply_filters( 'raw_woocommerce_price', floatval( $negative ? $price * - 1 : $price ) );
		$price    = apply_filters( 'formatted_woocommerce_price', number_format( $price, $decimals, $decimal_separator, $thousand_separator ), $price, $decimals, $decimal_separator, $thousand_separator );

		if ( apply_filters( 'woocommerce_price_trim_zeros', false ) && $decimals > 0 ) {
			$price = wc_trim_zeros( $price );
		}

		$formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format, $currency, $price );

		return $formatted_price;
	}

}