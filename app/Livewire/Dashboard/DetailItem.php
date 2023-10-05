<?php

namespace App\Livewire\Dashboard;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Imagick;

class DetailItem extends Component
{
    use WithFileUploads;

    public $listeners = ['save', 'update', 'delete', 'setLibrary', 'refreshLibrary' => '$refresh'];

    protected $item;
    public $itemDetail;
    public $item_id;
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
    public $new_file_link1;
    public $new_file_link2;

    public $file1_img = [];
    public $file2_img = [];

    public $filterCategory;
    public $method;
    public $listCategory;

    protected $rules = [
        'name' => 'required',
        'category' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Name is required!',
        'category.required' => 'Please select category!',
    ];

    public function render()
    {
        return view('livewire.dashboard.detail-item');
    }

    public function mount($id)
    {
        $this->item_id = $id;
        $this->method = 'save';
        if($id != 0){
            $this->item = Item::find($id);
            $this->itemDetail = Item::find($id);
            $this->item_id = $id;
            $this->method = 'update';
    
            $this->name = $this->item['name'];
            $this->category = $this->item['category_id'];
            $this->user = $this->item['user_id'];
            $this->description = $this->item['description'];
            $this->online_link = $this->item['online_link'];
            $this->pic1 = $this->item['pic1'];
            $this->pic2 = $this->item['pic2'];
            $this->pic3 = $this->item['pic3'];
            $this->pic4 = $this->item['pic4'];
            $this->pic5 = $this->item['pic5'];
            $this->file_link1 = $this->item['file1']['file'] ?? null;
            $this->file_link2 = $this->item['file2']['file'] ?? null;
            $this->credit = $this->item['credit'];

            if($this->file_link1){
                $file1 = $this->item['file1'];
                if($file1->count > 0){
                    if($file1->count > 1){
                        for($i=1; $i <= $file1->count; $i++){
                            $item = [
                                'folder' => $file1->name,
                                'img' => $file1->name. '-'.$i - 1 .'.jpg',
                            ];
                            array_push($this->file1_img, $item);
                        }
                    }else{
                        $item = [
                            'folder' => $file1->name,
                            'img' => $file1->name.'.jpg',
                        ];
                        array_push($this->file1_img, $item);
                    }
                }
            }
           
            if($this->file_link2){
                $file2 = $this->item['file2'];
                if($file2->count > 0){
                    if($file2->count > 1){
                        for($i=1; $i <= $file2->count; $i++){
                            $item = [
                                'folder' => $file2->name,
                                'img' => $file2->name. '-'.$i - 1 .'.jpg',
                            ];
                            array_push($this->file2_img, $item);
                        }
                    }else{
                        $item = [
                            'folder' => $file2->name,
                            'img' => $file2->name.'.jpg',
                        ];
                        array_push($this->file2_img, $item);
                    }
                }
            }
    
        }
        $this->listCategory = Category::get();
    }

    public function update(){
        $item = Item::find($this->item_id);

        $item->name = $this->name;
        $item->category_id = $this->category;
        $item->description = $this->description;
        $item->online_link = $this->online_link;
        $item->credit = $this->credit;

        $dir = 'picture/';

        // if(!$item->online_link){
        $item->online_link = route('item.detail', [$item->id, $item->name]);
        // }

        if($this->newPic1){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($item['pic1']);
            $this->newPic1->storeAs('public/' . $dir, $imgName);

            $item->pic1 = $dir . $imgName;

            $this->newPic1 = '';
            $this->pic1 = $item->pic1;
        }
        if($this->newPic2){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($item['pic2']);
            $this->newPic2->storeAs('public/' . $dir, $imgName);

            $item->pic2 = $dir . $imgName;

            $this->newPic2 = '';
            $this->pic2 = $item->pic2;
        }
        if($this->newPic3){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($item['pic3']);
            $this->newPic3->storeAs('public/' . $dir, $imgName);

            $item->pic3 = $dir . $imgName;

            $this->newPic3 = '';
            $this->pic3 = $item->pic3;
        }
        if($this->newPic4){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($item['pic4']);
            $this->newPic4->storeAs('public/' . $dir, $imgName);

            $item->pic4 = $dir . $imgName;

            $this->newPic4 = '';
            $this->pic4 = $item->pic4;
        }
        if($this->newPic5){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($item['pic5']);
            $this->newPic5->storeAs('public/' . $dir, $imgName);

            $item->pic5 = $dir . $imgName;

            $this->newPic5 = '';
            $this->pic5 = $item->pic5;
        }

        $pdfDir = 'file/';
        
        if($this->new_file_link1){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'pdf';
            Helpers::deleteImg($item['file_link1']);
            $this->new_file_link1->storeAs('public/' . $pdfDir, $imgName);

            $item->file_link1 = $pdfDir . $imgName;

            $this->new_file_link1 = '';
            $this->file_link1 = $item->file_link1;
        
        }
        
        if($this->new_file_link2){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'pdf';
            Helpers::deleteImg($item['file_link2']);
            $this->new_file_link2->storeAs('public/' . $pdfDir, $imgName);

            $item->file_link2 = $pdfDir . $imgName;

            $this->new_file_link2 = '';
            $this->file_link2 = $item->file_link2;
        }

        $item->save();
        $item->online_link = route('item.detail', [$item->id, $item->name]);
        $item->save();

        $this->dispatch('finish', 1, 'Item updated successfully!');
        $this->dispatch('refresh');

        return redirect()->to('/library');
    }
    
    public function save(){
        $this->validate($this->rules, $this->messages);
        $item = new Item();

        $item->name = $this->name;
        $item->category_id = $this->category;
        $item->description = $this->description;
        $item->online_link = $this->online_link;
        $item->user_id = auth()->id();
        $item->credit = $this->credit;
        

        $dir = 'picture/';

        if($this->newPic1){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($item['pic1']);
            $this->newPic1->storeAs('public/' . $dir, $imgName);

            $item->pic1 = $dir . $imgName;

            $this->newPic1 = '';
            $this->pic1 = $item->pic1;
        }
        if($this->newPic2){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($item['pic2']);
            $this->newPic2->storeAs('public/' . $dir, $imgName);

            $item->pic2 = $dir . $imgName;

            $this->newPic2 = '';
            $this->pic2 = $item->pic2;
        }
        if($this->newPic3){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($item['pic3']);
            $this->newPic3->storeAs('public/' . $dir, $imgName);

            $item->pic3 = $dir . $imgName;

            $this->newPic3 = '';
            $this->pic3 = $item->pic3;
        }
        if($this->newPic4){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($item['pic4']);
            $this->newPic4->storeAs('public/' . $dir, $imgName);

            $item->pic4 = $dir . $imgName;

            $this->newPic4 = '';
            $this->pic4 = $item->pic4;
        }
        if($this->newPic5){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
            Helpers::deleteImg($item['pic5']);
            $this->newPic5->storeAs('public/' . $dir, $imgName);

            $item->pic5 = $dir . $imgName;

            $this->newPic5 = '';
            $this->pic5 = $item->pic5;
        }

        $pdfDir = 'file/';
        
        if($this->new_file_link1){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'pdf';
            Helpers::deleteImg($item['file_link1']);
            $this->new_file_link1->storeAs('public/' . $pdfDir, $imgName);

            $item->file_link1 = $pdfDir . $imgName;

            $this->new_file_link1 = '';
            $this->file_link1 = $item->file_link1;
        }
        
        if($this->new_file_link2){
            $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'pdf';
            Helpers::deleteImg($item['file_link2']);
            $this->new_file_link2->storeAs('public/' . $pdfDir, $imgName);

            $item->file_link2 = $pdfDir . $imgName;

            $this->new_file_link2 = '';
            $this->file_link2 = $item->file_link2;
        }

        $item->save();
        $item->online_link = route('item.detail', [$item->id, $item->name]);
        $item->save();

        $this->dispatch('finish', 1, 'Item created successfully!');
        $this->dispatch('refresh');
        return redirect()->to('/library');
    }
}
