<?php

namespace App\Livewire;

use App\CPU\Helpers;
use App\Models\Ads;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use stdClass;

class Contacts extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $listeners = ['save', 'update', 'detailContact', 'resetZipcode', 'findZipcode','delete', 'setLibrary', 'refreshLibrary' => '$refresh'];

    protected $contact;

    public $search;
    public $total_show = 10;

    public $zipsearch;
    public $zipdistance;

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
    public $iklan;

    public function render()
    {
        $this->contact = Contact::when($this->search, function($s, $search){
            $s->where('services', 'LIKE', '%'.$search.'%');
        })->paginate($this->total_show);

        if($this->zipdistance){
            $this->contact = Contact::when($this->search, function($s, $search){
                $s->where('services', 'LIKE', '%'.$search.'%');
            })->get();

            $contact = [];

            foreach($this->contact as $key => $c) {
                array_push($contact, $c['zipcode']);
            }

            // {#2613 ▼ // app\Livewire\Contacts.php:70
            //     +"query": {#2611 ▼
            //         +"code": "11201"
            //         +"compare": array:2 [▼
            //         0 => "10199"
            //         1 => "10001"
            //         ]
            //         +"country": "us"
            //         +"unit": "km"
            //     }
            //     +"results": {#2651 ▼
            //         +"10199": 6.32
            //         +"10001": 6.07
            //     }
            // }
            
            // $replace = str_replace('[','',str_replace('"', '',json_encode($contact)));
            $replace = implode(',', $contact);

            $distance = Helpers::getDistance($this->zipdistance, $replace);

            $query = $distance->query->compare;
            $result = $distance->results;
            // $result = new stdClass;
            // $result->{10199} = 6.32;
            // $result->{10001} = 6.07;
            // $result->{21222} = 8.07;
            // $result->{33101} = 2.07;
            
            // $query = ["10199", "10001", "21222", "33101"];

            foreach($this->contact as $co){
                if(in_array($co['zipcode'], $query)){
                    $co['distance'] = $result->{$co['zipcode']};
                }
            }

            // $sortable = $this->contact->toArray();

            // $dist = array_column($sortable, 'distance');

            
            // array_multisort($dist, SORT_DESC, $sortable);

            $this->contact = $this->contact->sortBy('distance');
            
        }

        $data['contacts'] = $this->contact;

        $this->dispatch('refresh');

        return view('livewire.contacts', $data);
    }

    public function mount(){
        $this->iklan = Ads::where(['show_in' => 9998, 'status' => 1])->orderBy('created_at', 'desc')->get();
    }

    public function resetZipcode(){
        $this->zipdistance = '';
        $this->zipsearch = '';
    }

    public function findZipcode(){
        $this->zipdistance = $this->zipsearch;
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
