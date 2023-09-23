<?php

namespace App\Livewire\Dashboard;

use App\CPU\Helpers;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Library extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update', 'delete', 'setLibrary', 'refreshLibrary' => '$refresh'];
    protected $library;

    public $search;
    public $total_show = 10;

    public $library_id;
    public $name;
    public $category;
    public $user;
    public $description;
    public $online_link;
    public $pic1;
    public $pic2;
    public $pic3;
    public $pic4;
    public $pic5;
    public $file_link1;
    public $file_link2;
    public $credit;

    public $newPic1;
    public $newPic2;
    public $newPic3;
    public $newPic4;
    public $newPic5;

    public $filterCategory;

    public $listCategory;

    protected $rules = [
        'name' => 'required',
        'category' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Please fill name',
        'category.required' => 'Please select category',
    ];

    public function render()
    {
        $user = auth()->user();
        if($user['user_is'] == 'user'){
            $this->library = Item::whereHas('user', function($u){
                $u->where(['user_is' => 'user', 'id' => auth()->id()]);
            })->when($this->search, function($s, $search){
                $s->where('name', 'LIKE', '%'.$search.'%');
            })->orderBy('created_at', 'desc')->paginate($this->total_show);
            
        }

        $data['data'] = $this->library ?? [];

        return view('livewire.dashboard.library', $data);
    }

    public function delete()
    {
        $item = Item::find($this->library_id);

        if (!$item) {
            return session()->flash('fail', 'Item not found!');
        }
        $name = $item->name;

        if($item['pic1']){
            Helpers::deleteImg($item['pic1']);
        }
        if($item['pic2']){
            Helpers::deleteImg($item['pic2']);
        }
        if($item['pic3']){
            Helpers::deleteImg($item['pic3']);
        }
        if($item['pic4']){
            Helpers::deleteImg($item['pic4']);
        }
        if($item['pic5']){
            Helpers::deleteImg($item['pic5']);
        }
        if($item['file_link1']){
            Helpers::deleteImg($item['file_link1']);
        }
        if($item['file_link2']){
            Helpers::deleteImg($item['file_link2']);
        }

        $item->delete();
        
        $this->dispatch('finishCabang', 1, 'Item deleted successfully!');
        $this->dispatch('refresh');

        return session()->flash('success', 'Kantor cabang '.$name.' Berhasil dihapus');
    }
}
