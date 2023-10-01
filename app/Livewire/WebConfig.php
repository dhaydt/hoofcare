<?php

namespace App\Livewire;

use App\CPU\Helpers;
use App\Models\Config;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class WebConfig extends Component
{
    use WithFileUploads;

    public $name;
    public $country;
    public $email;
    public $phone;
    public $address;
    public $web_logo;
    public $new_web_logo;

    public function render()
    {
        return view('livewire.web-config');
    }

    public function mount(){
        $this->name = Config::where('title', 'web_name')->first()['value'];
        $this->country = Config::where('title', 'country')->first()['value'];
        $this->email = Config::where('title', 'email')->first()['value'];
        $this->phone = Config::where('title', 'phone')->first()['value'];
        $this->address = Config::where('title', 'address')->first()['value'];
        $this->web_logo = Config::where('title', 'web_logo')->first()['value'];
    }

    public function save(){
        $name = Config::where('title', 'web_name')->first();
        $country = Config::where('title', 'country')->first();
        $email = Config::where('title', 'email')->first();
        $phone = Config::where('title', 'phone')->first();
        $address = Config::where('title', 'address')->first();
        $web_logo = Config::where('title', 'web_logo')->first();

        $name->value = $this->name;
        $country->value = $this->country;
        $email->value = $this->email;
        $phone->value = $this->phone;
        $address->value = $this->address;

        $name->save();
        $country->save();
        $email->save();
        $phone->save();
        $address->save();

        if($this->new_web_logo != null){
            $dir = 'config/';
            $imageName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($web_logo->value);
            $this->new_web_logo->storeAs('public/' . $dir, $imageName);
            $img_name = $dir . $imageName;

            $web_logo->value = $img_name;
            $web_logo->save();

            $this->web_logo = $img_name;
        }

        $this->dispatch('finish', 1, 'Web Config Updated Successfully!');
    }
}
