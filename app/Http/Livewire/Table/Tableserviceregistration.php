<?php

namespace App\Http\Livewire\Table;

use App\Models\Customer;
use App\Models\Service;
use Livewire\Component;
use App\Traits\WithDataTable;
use Livewire\WithPagination;

class Tableserviceregistration extends Component
{
    use WithDataTable, WithPagination;

    public $idservice;
    public $idcustomer;
    public $status;
    public $nopol;
    public $nama;
    public $alamat;
    public $tipe;
    public $tahun;

    public $model;
    public $name;
    public $read = 0;
    public $button;
    public $action;
    public $add;
    public $stat = 0;
    public $isOpen = 0;
    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = true;
    public $search = '';
    protected $listeners = ["deleteItem" => "delete_item"];
    protected $rules = [
        'nopol' => 'required',
    ];
    protected $message = [
        'nopol.required' => 'Pilih Nomor Polisi Customer',
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
    public function clearVar(){
        $this->idservice = '';
        $this->nopol = '';
        $this->nama = '';
        $this->alamat = '';
        $this->tipe = '';
        $this->tahun = '';
        $this->read = false;
        $this->add = 'Add';
        $this->stat = false;
    }
    public function mount ()
    {
        $this->add = 'Add';
        $this->button = create_button($this->action, "New Registration");
    }
    public function updatedNopol($nopol){
        $cari = Customer::where('nopol', $nopol)->first();
        if($cari){
            $this->idcustomer = $cari->id;
            $this->nama = $cari->nama;
            $this->alamat = $cari->alamat;
            $this->tipe = $cari->tipe;
            $this->tahun = $cari->tahun;
            $this->add = "Update";
            $this->status = 'Wait List';
            $this->read = true;
        }else{
            $this->idcustomer = '';
            $this->nama = '';
            $this->alamat = '';
            $this->tipe = '';
            $this->tahun = 0;
            $this->status = '';
            $this->read = false;
        }
    }
    public function store(){
        $this->resetErrorBag();
        $this->validate([
            'nopol' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tipe' => 'required',
            'tahun' => 'required',
        ]);
        Customer::create([
            'nopol' => $this->nopol,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'tipe' => $this->tipe,
            'tahun' => $this->tahun,
        ]);
    }
    public function add(){
        if($this->add == 'Update'){
            $this->resetErrorBag();
            $this->validate();
            Service::updateOrCreate(['id' => $this->idservice],
            [
                'customer_id' => $this->idcustomer,
                'status' => $this->status,
            ]);
            $this->clearvar();
            $this->emit('saved');
            $this->hideModal();
        }else{
            $this->store();
            $cari = Customer::latest()->first();
            $this->idcustomer = $cari->id;
            $this->status = 'Wait List';
            $this->resetErrorBag();
            $this->validate();
            Service::updateOrCreate(['id' => $this->idservice],
            [
                'customer_id' => $this->idcustomer,
                'status' => $this->status,
            ]);
            $this->clearvar();
            $this->emit('saved');
            $this->hideModal();
        }
    }
    public function edit($id){
        $cari = Service::find($id);
        $this->idservice = $cari->id;
        $this->idcustomer = $cari->customer_id;
        $this->status = $cari->status;
        $customer = Customer::find($this->idcustomer);
            $this->idcustomer = $customer->id;
            $this->nopol = $customer->nopol;
            $this->nama = $customer->nama;
            $this->alamat = $customer->alamat;
            $this->tipe = $customer->tipe;
            $this->tahun = $customer->tahun;
        $this->add = 'Update';
        $this->stat = true;
        $this->read = true;
        $this->button = create_button('update', "Service");
        $this->showModal();
    }
    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
