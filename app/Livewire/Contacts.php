<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class Contacts extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $listeners = ['save', 'update', 'detailContact', 'delete', 'setLibrary', 'refreshLibrary' => '$refresh'];

    protected $contact;

    public $search;
    public $total_show = 10;

    public $zipsearch;

    public $f_name;
    public $l_name;
    public $business_name;
    public $zipcode;
    public $country;
    public $services;
    public $certifications;
    public $online_link_1;
    public $online_link_2;
    public $prefered_contact_method;
    public $phone;
    public $email;
    public $text;
    public $messenger;

    public function render()
    {
        $this->contact = Contact::when($this->search, function ($q, $s) {
            $q->where('services', 'LIKE', '%' . $s . '%');
        })->paginate($this->total_show);

        $data['contact'] = $this->contact;

        return view('livewire.contacts', $data);
    }

    public function detailContact($data)
    {
        // $data = json_decode($data);

        $this->f_name = $data['data']['f_name'];
        $this->l_name = $data['data']['l_name'];
        $this->business_name = $data['data']['business_name'];
        $this->zipcode = $data['data']['zipcode'];
        $this->country = $data['data']['country'];
        $this->services = $data['data']['services'];
        $this->certifications = $data['data']['certifications'];
        $this->online_link_1 = $data['data']['online_link_1'];
        $this->online_link_2 = $data['data']['online_link_1'];
        $this->prefered_contact_method = $data['data']['preferred_contact_method'];
        $this->phone = $data['data']['phone'];
        $this->email = $data['data']['email'];
        $this->text = $data['data']['text'];
        $this->messenger = $data['data']['messenger'];
    }
}
