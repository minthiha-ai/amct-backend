<?php

namespace App\Http\Controllers\API;

use App\Events\NewOrderEvent;
use Exception;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Models\OrderSuccessMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\API\StoreOrderRequest;

class OrderController extends BaseController
{
    //list
    public function list()
    {
        $orders = Order::getRelationData()->orderBy('id', 'DESC')->get();
        if(!count($orders)){
            return $this->sendError(204,'No Data Found');
        }
        return $this->sendResponse('success', OrderResource::collection($orders));
    }

    //detail
    public function detail($id)
    {
        $order = Order::getRelationData()->where('id', $id)->get();
        if (!$order->count()) {
            return $this->sendError(204, 'No Order Found');
        }
        return $this->sendResponse('success', new OrderResource($order[0]));
    }

    //create order
    public function create(StoreOrderRequest $request)
    {
        $orderData = $this->getRequestOrderData($request);

        DB::beginTransaction();
        try {

            $order = Order::create($orderData);

            $orderItemsData = $this->getRequestOrderItemsData($request, $order->id);
            OrderItem::insert($orderItemsData);

            event(new NewOrderEvent($this->getNotificationData($order->id)));

            $message = $this->getOrderSuccessfulMessage();
            DB::commit();

            return $this->sendResponse($message, $order);
        } catch (Exception $e) {

            DB::rollBack();
            throw $e;
            return $this->sendError(500, 'Something wrong!Please Try Again.');
        }
    }

    // get new order notification data for admin
    private function getNotificationData($orderId)
    {
        $data = Order::with(['customer' => function ($query) {
            $query->select('id', 'name');
        }])->where('id', $orderId)->first();

        $data->message = 'placed a new order';

        return $data;
    }

    //get order successful message
    private function getOrderSuccessfulMessage()
    {
        $orderSuccessMessage = OrderSuccessMessage::first();
        if (!$orderSuccessMessage) {
            return 'Order တင်ခြင်း အောင်မြင်ပါသည်။';
        }
        return $orderSuccessMessage->value('message');
    }

    //get order data
    private function getRequestOrderData($request)
    {
        $data = [
            'customer_id' => Auth::guard('api')->user()->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'delivery_fee' => $request->delivery_fee,
            'region_id' => $request->region_id,
            'delivery_fee_id' => $request->delivery_fee_id,
            'remark' => $request->remark,
        ];

        if ($request->payment_method == 'payment') {
            $data['payment_id'] = $request->payment_id;
            if ($request->hasFile('payment_photo')) {
                $image = $request->file('payment_photo');
                $data['payment_photo'] = $image->store('payment-photos');
            }
        }

        $subTotal = 0;

        foreach (json_decode($request->carts) as $cart) {
            $subTotal += $cart->total_price;
        }

        $data['sub_total'] = $subTotal;

        $data['grand_total'] = $request->delivery_fee + $subTotal;

        return $data;
    }

    //get order items data
    private function getRequestOrderItemsData($request, $orderId)
    {
        $carts = json_decode($request->carts);

        foreach ($carts as $cart) {
            $orderItem = [
                'order_id' => $orderId,
                'product_id' => $cart->product_id,
                'model' => $cart->model ?? '',
                'type' => $cart->type ?? '',
                'range' => $cart->range ?? '',
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'total_price' => $cart->total_price,
            ];
            $orderItems[] = $orderItem;
        }

        return $orderItems;
    }

}
