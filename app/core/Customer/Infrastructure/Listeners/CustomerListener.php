<?php

namespace Core\Customer\Infrastructure\Listeners;

use Core\Customer\Application\DTOs\OrderShippingCustomerRequest;
use Core\Customer\Application\UseCases\OrderShippingCustomer;
use Illuminate\Support\Facades\Event;

class CustomerListener
{
    public function handle(OrderShippingCustomer $OrderShippingCustomer)
    {
        Event::listen(
            'erp.order.*',
            function (string $eventName, array $data) use ($OrderShippingCustomer) {
                if ($eventName === 'erp.order.create') {
                    $OrderShippingCustomer->handle(OrderShippingCustomerRequest::fromArray([
                        'user_id' => $data['user_id'],
                        'business_id' => $data['business_id'],
                        'id' => $data['customer_id'],
                        'order_id' => $data['id']
                    ]));
                    
                }
            }
        );
    }
}
