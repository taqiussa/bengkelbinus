<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Traits\WithDataTable;
use DateTime;
use Livewire\WithPagination;
class Tableitem extends Component
{
    use WithPagination, WithDataTable;
    
    public $model;
    public $name;
    public $iditem;
    public $category_id;
    public $item;
    public $jumlah;
    public $harga;

    public $button;
    public $action;
    public $isOpen = 0;
    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    protected $listeners = ["deleteItem" => "delete_item"];
    protected $rules = [
        'category_id' => 'required',
        'item' => 'required',
        'jumlah' => 'required',
        'harga' => 'required',
    ];
    protected $message = [
        'category_id.required' => 'Pilih Kategori',
        'item.required' => 'Nomor Polisi harus diisi',
        'jumlah.required' => 'jumlah harus diisi',
        'harga.required' => 'harga harus diisi',
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
    public function store()
    {
        $this->resetErrorBag();
        $this->validate();

        $this->model::updateOrCreate(['id' => $this->iditem],[
            'category_id' => $this->category_id,
            'item' => $this->item,
            'jumlah' => $this->jumlah,
            'harga' => $this->harga,
        ]);
        $this->clearvar();
        $this->emit('saved');
        $this->hideModal();
    }
    public function edit($id){
        $cari = $this->model::findOrFail($id);
        $this->iditem = $id;
        $this->category_id = $cari->category_id;
        $this->item = $cari->item;
        $this->jumlah = $cari->jumlah;
        $this->harga = $cari->harga;
        $this->button = create_button('update', "Item");
        $this->showModal();
    }
    public function clearvar(){
        $this->iditem = '';
        $this->category_id = '';
        $this->item = '';
        $this->jumlah = '';
        $this->harga = '';
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
        $this->button = create_button($this->action, "Item Baru");
    }
    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
