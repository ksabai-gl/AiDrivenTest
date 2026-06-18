<?php 
namespace Core\OrderShipping\Infrastructure\Listeners;

use Core\OrderShipping\Application\DTOs\CheckReadyOrderShippingRequest;
use Core\OrderShipping\Application\UseCases\CheckReadyOrderShipping;
use Core\OrderShipping\Application\UseCases\CreateOrderShipping;
use Illuminate\Support\Facades\Event;

class OrderShippingListener {
    public function handle(CreateOrderShipping $createOrderShipping,
        CheckReadyOrderShipping $CheckReadyOrderShipping){
        Event::listen('erp.customer.*',function(string $eventName, array $data) use($createOrderShipping) {
            if($eventName === 'erp.customer.creatordershipping') {
                $createOrderShipping->handle($data);
            }
        });
        Event::listen('erp.order.*',function(string $eventName, array $data) 
            use($CheckReadyOrderShipping) {
            if($eventName === 'erp.order.approved') {
               $CheckReadyOrderShipping->handle(
                CheckReadyOrderShippingRequest::fromArray([
                        'business_id' => $data['business_id'],
                        'order_id' => $data['id'],
                        'user_id' => $data['user_id']
                ])
               );
            }
        });
    }
}