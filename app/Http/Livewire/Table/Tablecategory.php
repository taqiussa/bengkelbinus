<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Traits\WithDataTable;
use Livewire\WithPagination;
class Tablecategory extends Component
{
    use WithPagination, WithDataTable;
    public $model;
    public $name;
    public $idcategory;
    public $category;

    public $button;
    public $action;
    public $isOpen = 0;
    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    protected $listeners = ["deleteItem" => "delete_item"];
    protected $rules = [
        'category' => 'required',
    ];
    protected $message = [
        'category.required' => 'Pilih Kategori',
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

        $this->model::updateOrCreate(['id' => $this->idcategory],[
            'category' => $this->category,
        ]);
        $this->clearvar();
        $this->emit('saved');
        $this->hideModal();
    }
    public function edit($id){
        $cari = $this->model::findOrFail($id);
        $this->idcategory = $id;
        $this->category = $cari->category;
        $this->button = create_button('update', "Category");
        $this->showModal();
    }
    public function clearvar(){
        $this->idcategory = '';
        $this->category = '';
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
        $this->button = create_button($this->action, "Category Baru");
    }
    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
