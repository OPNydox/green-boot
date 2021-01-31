<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Delivery_With_Econt_Payment extends WC_Payment_Gateway {
    public function __construct() {
        $this->id = 'econt_payment';
        $this->has_fields = false;
        $this->method_title = __("Pay with Econt", 'delivery-with-econt');
        $this->method_description = __("Redirects to Econt online payment form", 'delivery-with-econt');

        $this->supports = array(
            'products'
        );

        $this->init_form_fields();
        $this->init_settings();

        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->enabled = $this->get_option('enabled');

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title' => __('Enable/Disable', 'delivery-with-econt'),
                'label' => __('Enable Pay with Econt', 'delivery-with-econt'),
                'type' => 'checkbox',
                'description' => '',
                'default' => 'no'
            ),
            'title' => array(
                'title' => __('Title', 'delivery-with-econt'),
                'type' => 'text',
                'description' => __('This controls the title which the user sees during checkout.', 'delivery-with-econt'),
                'default'     => __('Pay with Econt', 'delivery-with-econt'),
                'desc_tip'    => true
            ),
            'description' => array(
                'title'       => __('Description', 'delivery-with-econt'),
                'type'        => 'textarea',
                'desc_tip'    => true,
                'description' => __('This controls the description which the user sees during checkout.', 'delivery-with-econt'),
                'default'     => __('Pay online with Econt', 'delivery-with-econt')
            )
        );
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);

        $data = [
            'order' => ['orderNumber' => $order->get_id()]
        ];

        $settings = get_option( 'delivery_with_econt_settings' );
        DWEH()->check_econt_configuration($settings);

        $response = DWEH()->curl_request($data, DWEH()->get_service_url() . 'services/PaymentsService.createPayment.json');
        $response = json_decode($response, true);

        if($response['type'] != '') {
            $message = [];
            $message['text'] = $response['message'];
            $message['type'] = "error";

            // if we receive error message from econt, we save it in the database for display it later
            update_post_meta($order->get_id(), '_process_payment_error', sanitize_text_field( $message['text'] ));

            throw new Exception($message['text']);
        }

        $args = [
            'successUrl' => esc_url_raw(add_query_arg(['utm_nooverride' => '1', 'id_transaction' => $response['paymentIdentifier']], $this->get_return_url( $order ))),
            'failUrl' => esc_url_raw($order->get_cancel_order_url_raw()),
            'eMail' => $order->get_billing_email(),
        ];

        return [
            'result' => 'success',
            'redirect' => $response['paymentURI'] . '&' . http_build_query($args, '', '&')
        ];
    }

    /**
     * @param $id_order
     * @throws Exception
     */
    public function confirm_payment($id_order) {
        $order = wc_get_order($id_order);

        $data = [
            'paymentIdentifier' => $_GET['id_transaction']
        ];

        $response = DWEH()->curl_request($data, DWEH()->get_service_url() . 'services/PaymentsService.confirmPayment.json');
        $response = json_decode($response, true);

        if($response['type'] != '') {
            $message = [];
            $message['text'] = $response['message'];
            $message['type'] = "error";

            // if we receive error message from econt, we save it in the database for display it later
            update_post_meta($order->get_id(), '_confirm_payment_error', sanitize_text_field( $message['text'] ));

            throw new Exception($message['text']);
        }

        $order->payment_complete($_GET['id_transaction']);
        DWEH()->sync_order($order, [], false, $response['paymentToken']);
    }
}