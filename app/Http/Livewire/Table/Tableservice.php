<?php

namespace App\Http\Livewire\Table;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithDataTable;
class Tableservice extends Component
{
    use WithPagination, WithDataTable;
    
    public $model;
    public $name;
    public $idservice;
    public $customer_id;
    public $customer;
    public $nama;
    public $nopol;
    public $category_id;
    public $category = Null;
    public $item;
    public $items;
    public $jumlah;
    public $harga;
    public $total;

    public $button;
    public $action;
    public $isOpen = 0;
    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    protected $listeners = ["deleteItem" => "delete_item"];
    protected $rules = [
        'item' => 'required',
        'jumlah' => 'required',
        'harga' => 'required',
        'customer_id' => 'required',
    ];
    protected $message = [
        'item.required' => 'Pilih Item',
        'jumlah.required' => 'jumlah harus diisi',
        'harga.required' => 'harga harus diisi',
        'customer_id.required' => 'Pilih Customer',
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
    public function pilih(){
        $this->model::create([
            'customer_id' => $this->customer_id,
            'status' => 'antri',
        ]);
    }
    public function store()
    {
        $this->resetErrorBag();
        $this->validate();

        $this->model::updateOrCreate(['id' => $this->idservice],[
            'customer_id' => $this->customer_id,
            'status' => 'antri',
            'harga' => $this->harga,
            'customer_id' => $this->customer_id,
            'tiket' => $this->tiket,
            'total' => $this->total,
        ]);
        $this->clearvar();
        $this->emit('saved');
        $this->hideModal();
    }
    public function edit($id){
        $cari = $this->model::findOrFail($id);
        $this->idcustomer = $id;
        $this->item = $cari->item;
        $this->jumlah = $cari->jumlah;
        $this->harga = $cari->harga;
        $this->customer_id = $cari->customer_id;
        $this->tiket = $cari->tiket;
        $this->total = $cari->total;
        $this->button = create_button('update', "Transaksi");
        $this->showModal();
    }
    public function clearvar(){
        $this->idservice = '';
        $this->items = collect();
        $this->item = '';
        $this->jumlah = 0;
        $this->harga = 0;
        $this->nama = '';
        $this->customer_id = '';
        $this->category_id = Category::all();
        $this->category = Null;
        $this->total = '';
    }
    public function delete_item ($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);
    }
    public function showModal()
    {
        $this->isOpen = true;
    }
    public function hideModal()
    {
        $this->resetErrorBag();
        $this->clearVar();
        $this->isOpen = false;
    }
    public function mount ()
    {
        $this->category_id = Category::all();
        $this->items = collect();
        $this->button = create_button($this->action, "Transaksi Baru");
    }
    public function updatedCategory($category){
        if (!is_null($category)){
            $this->items = Item::where('category_id', $category)->get();
        }
    }
    public function updatedItem($item){
        $cari = Item::find($item);
        if($cari){
            $this->harga = $cari->harga;
        }else{
            $this->harga = 0;
        }
    }
    public function updatedCustomer($customer){
        $cari = Customer::where('nopol',$customer)->first();
        if($cari){
            $this->nama = $cari->nama;
            $this->customer_id = $cari->id;
        }else{
            $this->nama = '';
            $this->customer_id = '';
        }
    }
    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
