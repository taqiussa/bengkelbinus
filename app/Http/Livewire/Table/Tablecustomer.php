<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithDataTable;
use App\Models\Customer;
class Tablecustomer extends Component
{
    use WithPagination, WithDataTable;

    public $model;
    public $name;
    public $idcustomer;
    public $nopol;
    public $nama;
    public $alamat;
    public $tipe;
    public $tahun;

    public $button;
    public $action;
    public $isOpen = 0;
    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    protected $listeners = ["deleteItem" => "delete_item"];
    protected $rules = [
        'nopol' => 'required',
        'nama' => 'required',
        'alamat' => 'required',
        'tipe' => 'required',
        'tahun' => 'required',
    ];
    protected $message = [
        'nopol.required' => 'Nomor Polisi harus diisi',
        'nama.required' => 'Nama harus diisi',
        'alamat.required' => 'Alamat harus diisi',
        'tipe.required' => 'Tipe harus diisi',
        'tahun.required' => 'Tahun Rakit harus diisi',
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

        $this->model::updateOrCreate(['id' => $this->idcustomer],[
            'nopol' => $this->nopol,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'tipe' => $this->tipe,
            'tahun' => $this->tahun,
        ]);
        $this->clearvar();
        $this->emit('saved');
        $this->hideModal();
    }
    public function edit($id){
        $cari = $this->model::findOrFail($id);
        $this->idcustomer = $id;
        $this->nopol = $cari->nopol;
        $this->nama = $cari->nama;
        $this->tipe = $cari->tipe;
        $this->tahun = $cari->tahun;
        $this->alamat = $cari->alamat;
        $this->button = create_button('update', "Customer");
        $this->showModal();
    }
    public function clearvar(){
        $this->idcustomer = '';
        $this->nopol = '';
        $this->nama = '';
        $this->tahun = '';
        $this->tipe = '';
        $this->alamat = '';
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
        $this->button = create_button($this->action, "Customer Baru");
    }
    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
