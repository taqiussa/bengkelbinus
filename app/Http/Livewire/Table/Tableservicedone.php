<?php

namespace App\Http\Livewire\Table;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Detail;
use App\Models\Item;
use App\Models\Service;
use App\Models\Temp;
use Livewire\Component;
use App\Http\Livewire\Iprint;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use App\Traits\WithDataTable;
use Livewire\WithPagination;

class Tableservicedone extends Component
{
    use WithDataTable, WithPagination;
    // Modal Service Data
    public $idservice;
    public $idcustomer;
    public $status;
    public $nopol;
    public $nama;
    public $alamat;
    public $tipe;
    public $tahun;

    //Modal Payment
    public $category;
    public $categories;
    public $item;
    public $items;
    public $harga;
    public $jumlah;
    public $total;
    public $grandtotal;

    // Utilities
    public $model;
    public $name;
    public $button;
    public $action;
    public $add;
    public $stat = 0;
    public $isOpen = 0;
    public $isOpens = 0;
    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = true;
    public $search = '';
    protected $listeners = ["deleteItem" => "delete_item"];

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
    public function showModals()
    {
        $this->isOpens = true;
    }
    public function hideModal()
    {
        $this->resetErrorBag();
        $this->clearVar();
        $this->isOpen = false;
    }
    public function hideModals()
    {
        $this->resetErrorBag();
        $this->clearVars();
        $this->isOpens = false;
    }
    public function clearVars(){
        $this->categories = Category::all();
        $this->category = null;
        $this->items = collect();
        $this->item = null;
        $this->jumlah = '';
        $this->harga = 0;
        $this->total = 0;
    }
    public function clearVar(){
        $this->idservice = '';
        $this->nopol = '';
        $this->nama = '';
        $this->alamat = '';
        $this->tipe = '';
        $this->tahun = '';
        $this->add = 'Add';
        $this->stat = false;
    }
    public function mount ()
    {
        $this->categories = Category::all();
        $this->items = collect();
        $this->add = 'Add';
        $this->button = create_button($this->action, "New Registration");
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
    public function updatedNopol($nopol){
        $cari = Customer::where('nopol', $nopol)->first();
        if($cari){
            $this->idcustomer = $cari->id;
            $this->nama = $cari->nama;
            $this->alamat = $cari->alamat;
            $this->tipe = $cari->tipe;
            $this->tahun = $cari->tahun;
            $this->status = 'Wait List';
        }else{
            $this->idcustomer = '';
            $this->nama = '';
            $this->alamat = '';
            $this->tipe = '';
            $this->tahun = 0;
            $this->status = '';
        }
    }
    public function add(){
        $this->resetErrorBag();
        $this->validate([
            'category' => 'required',
            'item' => 'required',
            'jumlah' => 'required|numeric',
        ]);
        $this->total = intval($this->jumlah) * intval($this->harga);
        Temp::create(
        [
            'service_id' => $this->idservice,
            'item_id' => $this->item,
            'jumlah' => $this->jumlah,
            'harga' => $this->harga,
            'total' => $this->total,
        ]);
        $this->clearVars();
    }
    public function store(){
        $cari = Temp::where('service_id', $this->idservice)->get();
        foreach($cari as $c){
            Detail::create([
                'service_id' => $c->service_id,
                'item_id' => $c->item_id,
                'jumlah' => $c->jumlah,
                'harga' => $c->harga,
                'total' => $c->total,
            ]);
        }
        $this->grandtotal = Temp::where('service_id', $this->idservice)->sum('total');
        Service::where('id', $this->idservice)
        ->update([
            'status' => 'Paid',
            'total' => $this->grandtotal]);
        Temp::where('service_id', $this->idservice)->delete();
        $this->print();
        $this->emit('saved');
        $this->clearVars();
        $this->hideModals();
    }
    public function editpayment($id){
        $cari = Service::find($id);
            $this->idservice = $cari->id;
            $this->idcustomer = $cari->customer_id;
        $customer = Customer::find($this->idcustomer);
            $this->idcustomer = $customer->id;
            $this->nopol = $customer->nopol;
            $this->nama = $customer->nama;
            $this->button = create_button($this->action, "Payment");
            $this->showModals();
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
        $this->button = create_button('update', "Service");
        $this->showModal();
    }
    public function print(){
        $cari = Service::with('customer')->where('id', $this->idservice)->first();
        $details = Detail::with('item')->where('service_id', $this->idservice)->get();
        $total = Detail::where('service_id', $this->idservice)->sum('total');
        $date = gmdate('d M Y');
    
        /* Open file */
        $tmpdir = sys_get_temp_dir();
        $file =  tempnam($tmpdir, 'cetak');

        /* Do some printing */
        $connector = new FilePrintConnector($file);
        $printer = new Printer($connector);
        
        /* Print Logo */
        $img = EscposImage::load('image/logo.png');
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->bitImageColumnFormat($img);
        /* Title of receipt */
        $printer->setEmphasis(true);
        $printer->text("BENGKEL BINUSA INVOICE\n");
        $printer->setEmphasis(false);
        /* Items */
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->setEmphasis(false);
        $printer->text(new Iprint('Customer :', $cari->customer->nama));
        $printer->text(new Iprint('Nopol :', $cari->customer->nopol));
        $printer->text("--------------------------------\n");
        foreach($details as $d){
            $printer->text(new Iprint($d->item->item .' X '. $d->jumlah, 'Rp. '.number_format($d->harga,0,",",".")));
        }
        $printer->text("--------------------------------\n");
        $printer->setEmphasis(true);
        $printer->text(new Iprint("Total", 'Rp. '.number_format($total,0,",",".")));
        $printer->setEmphasis(false);
        $printer->text("\n");
        /* Footer */
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Kasir\n");
        $printer->feed();
        $printer->text($date."\n");
        /* Cut the receipt and open the cash drawer */
        $printer->cut();
        $printer->pulse();
        $printer->close();

        /* Copy it over to the printer */
        copy($file, "//localhost/Gudang");
        // copy($file, "//localhost/EPSONTU");
        unlink($file);
        // return redirect('/laporan'
    }
    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
