<?php

namespace App\Http\Livewire;

use App\Models\Food;
use App\Models\Order as ModelsOrder;
use App\Models\OrderDetail;
use App\Models\Table;
use Livewire\Component;

class Order extends Component
{
    public $customerName, $description, $tableId;
    public $totalPrice = 0;
    public $itemPrice = 0;
    public $isDisabled = 'disabled';
    public $items = [];

    public function addItem($price, $foodId)
    {
        $this->totalPrice += $price;
        array_push($this->items, $foodId); 
    }

    protected $rules = [
        'customerName' => 'required',
        'description' => 'nullable',
        'tableId' => 'required',
        'totalPrice' => 'required|numeric', 
    ];
 
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        if($this->tableId !== null && $this->customerName !== null) {
            $this->isDisabled = '';
        }
    }

    public function order()
    {
        $this->validate();
        $order = ModelsOrder::create([
            'customer_name' => $this->customerName,
            'total_price' => $this->totalPrice,
            'description' => $this->description,
            'table_id' => $this->tableId,
        ]);

        $table = Table::find($this->tableId);
        $table->update(['status' => 0]);

        for($i = 0; $i < count($this->items); $i++) {
            $food = Food::find($this->items[$i]);
            OrderDetail::create([ 
                'total' => $food->price,
                'food_id' => $food->id,
                'order_id' => $order->id,
            ]);
        }

        $this->reset(['customerName','itemPrice','totalPrice','description','tableId']);
        session()->flash('message','Pesanan Berhasil Dibuat');
    }

    public function render()
    {
        return view('livewire.order', [
            'foods' => Food::with('category')->get(),
            'tables' => Table::where('status', 1)->get(),
        ])->layout('layouts.livewire');
    }
}
