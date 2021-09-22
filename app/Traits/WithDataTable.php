<?php

namespace App\Traits;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Detail;
use App\Models\Item;
use App\Models\Temp;

trait WithDataTable {
    
    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'user':
                $users = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.user',
                    "users" => $users,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('user.new'),
                            'create_new_text' => 'Buat User Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            default:
            case 'customer':
                $customers = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.customer',
                    "customers" => $customers,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => 'showModal()',
                            'create_new_text' => 'Add Customer',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;
                case 'item':
                    $items = $this->model::search($this->search)
                    ->with('category')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                    return [
                        "view" => 'livewire.table.item',
                        "items" => $items,
                        "categories" => Category::get(),
                        "data" => array_to_object([
                            'href' => [
                                'create_new' => 'showModal()',
                                'create_new_text' => 'Add Item',
                                'export' => '#',
                                'export_text' => 'Export'
                            ]
                        ])
                    ];
                break;
                case 'category':
                    $categories = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                    return [
                        "view" => 'livewire.table.category',
                        "categories" => $categories,
                        "data" => array_to_object([
                            'href' => [
                                'create_new' => 'showModal()',
                                'create_new_text' => 'Add Category',
                                'export' => '#',
                                'export_text' => 'Export'
                            ]
                        ])
                    ];
                break;
                case 'service':
                    $services = $this->model::search($this->search)
                    ->with('customer')
                    ->where('status' , 'Wait List')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                    return [
                        "view" => 'livewire.table.serviceregistration',
                        "services" => $services,
                        "data" => array_to_object([
                            'href' => [
                                'create_new' => 'showModal()',
                                'create_new_text' => 'Add Service',
                                'export' => '#',
                                'export_text' => 'Export'
                            ]
                        ])
                    ];
                break;
                case 'serviceprocess':
                    $services = $this->model::search($this->search)
                    ->with('customer')
                    ->where('status' , 'Process')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                    return [
                        "view" => 'livewire.table.serviceprocess',
                        "services" => $services,
                        "data" => array_to_object([
                            'href' => [
                                'create_new' => 'hideModal()',
                                'create_new_text' => 'Disabled',
                                'export' => '#',
                                'export_text' => 'Export'
                            ]
                        ])
                    ];
                break;
                case 'servicedone':
                    $services = $this->model::search($this->search)
                    ->with('customer')
                    ->where('status' , 'Done')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                    $temps = Temp::where('service_id',$this->idservice)->orderBy('item_id','asc')->get();
                    $grandtotal = Temp::where('service_id',$this->idservice)->sum('total');
                    return [
                        "view" => 'livewire.table.servicedone',
                        "services" => $services,
                        "temps" => $temps,
                        "grandtotal" => $grandtotal,
                        "data" => array_to_object([
                            'href' => [
                                'create_new' => 'hideModal()',
                                'create_new_text' => 'Disabled',
                                'export' => '#',
                                'export_text' => 'Export'
                            ]
                        ])
                    ];
                break;
                case 'servicepaid':
                    $services = $this->model::search($this->search)
                    ->with('customer')
                    ->where('status' , 'Paid')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                    $temps = Detail::where('service_id',$this->idservice)->orderBy('item_id','asc')->get();
                    $grandtotal = Detail::where('service_id',$this->idservice)->sum('total');
                    return [
                        "view" => 'livewire.table.servicepaid',
                        "services" => $services,
                        "temps" => $temps,
                        "grandtotal" => $grandtotal,
                        "data" => array_to_object([
                            'href' => [
                                'create_new' => 'hideModal()',
                                'create_new_text' => 'Disabled',
                                'export' => '#',
                                'export_text' => 'Export'
                            ]
                        ])
                    ];
                break;
                
        }
    }
}