<?php

namespace App\Livewire\Dashboard;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Menu extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update', 'delete', 'setItem', 'refreshItem' => '$refresh'];
    public $total_show;

    protected $item;
    public $category_id;
    public $item_id;
    public $cat_name;

    public function render()
    {
        $this->item = Item::where(['category_id' => $this->category_id, 'user_id' => auth()->id()])->orderBy('updated_at', 'desc')->paginate($this->total_show);

        $data['items'] = $this->item;

        return view('livewire.dashboard.menu', $data);
    }

    public function mount($cat_id){
        $this->category_id = $cat_id;
        $category = Category::find($cat_id);
        $this->cat_name = $category['name'];
    }

    public function delete()
    {
        $item = Item::find($this->item_id);

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
        
        $this->dispatch('finishMenu', 1, 'Item deleted successfully!');
        $this->dispatch('refresh');
    }
}
