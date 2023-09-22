<div>
    <style>
        .img-assset{
            border-radius: 20px;
        }
        input[type=file] {
            width: 350px;
            max-width: 100%;
            color: #444;
            padding: 5px;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #555;
        }

    </style>
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    {{-- <h3 class="m-0">{{ $item['name'] }}</h3> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <div class="white_card_body">
                    <h6 class="card-subtitle mb-2 mb-2">Name</h6>
                    <div class=" mb-0">
                        <input type="text" class="form-control" name="inputText" id="inputText" placeholder="Name"
                            wire:model="name">
                    </div>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col col-md-6">
                <div class="white_card_body">
                    <h6 class="card-subtitle mb-2 mb-2">Category</h6>
                    <div class=" mb-0">
                        <select class="form-select required" wire:model="category">
                            @foreach ($listCategory as $lc)
                            <option value="{{ $lc['id'] }}">{{ $lc['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col col-md-12">
                <div class="white_card_body">
                    <h6 class="card-subtitle mb-2 mb-2">Description</h6>
                    <div class=" mb-0">
                        <textarea name="descripiton" class="form-control" wire:model="description" cols="30"
                            rows="5"></textarea>
                    </div>
                    @error('description') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col col-md-6">
                <div class="white_card_body card ms-5 shadow-sm pt-4">
                    <h6 class="card-subtitle mb-4">Pictures 1</h6>
                    <div class=" mb-0">
                        <div class="d-flex justify-content-center">
                            @if ($newPic1)
                                <img src="{{ $newPic1->temporaryUrl() }}" height="200px" alt="" class="img-assset">
                            @else
                                <img src="{{ asset('storage/'.$pic1) }}" onerror="this.src=`{{ asset('assets/images/no_img.jpeg') }}`" height="200px" alt="" class="img-assset">
                            @endif
                        </div>
                        <input type="file" class="form-control mt-2 mx-auto" accept="image/jpeg, image/jpg, image/png" wire:model="newPic1" onchange="l">
                    </div>
                    @error('newPic1') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col col-md-6">
                <div class="white_card_body card me-5 shadow-sm pt-4">
                    <h6 class="card-subtitle mb-4">Pictures 2</h6>
                    <div class=" mb-0">
                        <div class="d-flex justify-content-center">
                            @if ($newPic2)
                                <img src="{{ $newPic2->temporaryUrl() }}" height="200px" alt="" class="img-assset">
                            @else
                                <img src="{{ asset('storage/'.$pic2) }}" onerror="this.src=`{{ asset('assets/images/no_img.jpeg') }}`" height="200px" alt="" class="img-assset" />
                            @endif
                        </div>
                        <input type="file" class="form-control mt-2 mx-auto" accept="image/jpeg, image/jpg, image/png" wire:model="newPic2">
                    </div>
                    @error('newPic2') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col col-md-6">
                <div class="white_card_body card ms-5 shadow-sm pt-4 mt-4">
                    <h6 class="card-subtitle mb-4">Pictures 3</h6>
                    <div class=" mb-0">
                        <div class="d-flex justify-content-center">
                            @if ($newPic3)
                                <img src="{{ $newPic3->temporaryUrl() }}" height="200px" alt="" class="img-assset">
                            @else
                                <img src="{{ asset('storage/'.$pic3) }}" onerror="this.src=`{{ asset('assets/images/no_img.jpeg') }}`" height="200px" alt="" class="img-assset">
                            @endif
                        </div>
                        <input type="file" class="form-control mt-2 mx-auto" accept="image/jpeg, image/jpg, image/png" wire:model="newPic3">
                    </div>
                    @error('newPic3') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col col-md-6">
                <div class="white_card_body card me-5 shadow-sm pt-4 mt-4">
                    <h6 class="card-subtitle mb-4">Pictures 4</h6>
                    <div class=" mb-0">
                        <div class="d-flex justify-content-center">
                            @if ($newPic4)
                                <img src="{{ $newPic4->temporaryUrl() }}" height="200px" alt="" class="img-assset">
                            @else
                                <img src="{{ asset('storage/'.$pic4) }}" onerror="this.src=`{{ asset('assets/images/no_img.jpeg') }}`" height="200px" alt="" class="img-assset">
                            @endif
                        </div>
                        <input type="file" class="form-control mt-2 mx-auto" accept="image/jpeg, image/jpg, image/png" wire:model="newPic4">
                    </div>
                    @error('newPic4') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col col-md-12">
                <div class="row justify-content-center">
                    <div class="col col-md-6">
                        <div class="white_card_body card shadow-sm pt-4 mt-4">
                            <h6 class="card-subtitle mb-4">Pictures 5</h6>
                            <div class=" mb-0">
                                <div class="d-flex justify-content-center">
                                    @if ($newPic5)
                                        <img src="{{ $newPic5->temporaryUrl() }}" height="200px" alt="" class="img-assset">
                                    @else
                                        <img src="{{ asset('storage/'.$pic5) }}" onerror="this.src=`{{ asset('assets/images/no_img.jpeg') }}`" height="200px" alt="" class="img-assset" />
                                    @endif
                                </div>
                                <input type="file" class="form-control mt-2 mx-auto" accept="image/jpeg, image/jpg, image/png" wire:model="newPic5">
                            </div>
                            @error('newPic5') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-6 mb-3">
                <div class="white_card_body card shadow-sm ms-4 pt-4 mt-4">
                    <h6 class="card-subtitle mb-4">File Link 1</h6>
                    <div class=" mb-0">
                        {{-- @if ($file_link1)
                        @php($link1 = str_replace('file/', '', $file_link1))
                        <a href="{{ route('view_pdf', [$link1]) }}" target="_blank" class="btn btn-sm btn-warning">View PDF</a>
                        @endif --}}
                        @if ($file_link1)
                        <iframe src="{{ asset('storage'.'/'.$file_link1) }}" width="100%" height="600" frameborder="2">
                            This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('storage'.'/'.$file_link1) }}">Download PDF</a>
                        </iframe>
                        @endif
                        <input type="file" class="form-control mt-2" accept="application/pdf" wire:model="new_file_link1">
                    </div>
                    @error('file_link1') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col col-md-6 mb-3">
                <div class="white_card_body card shadow-sm me-4 pt-4 mt-4">
                    <h6 class="card-subtitle mb-4">File Link 2</h6>
                    <div class=" mb-0">
                        @if ($file_link2)
                        <iframe src="{{ asset('storage'.'/'.$file_link2) }}" width="100%" height="600" frameborder="2">
                            This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('storage'.'/'.$file_link2) }}">Download PDF</a>
                        </iframe>
                        @endif
                        <input type="file" class="form-control mt-2" accept="application/pdf" wire:model="new_file_link2">
                    </div>
                    @error('file_link2') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <form wire:submit.prevent="update" class="d-flex pe-5">
                <button type="submit" data-bs-toggle="tooltip" data-bs-placement="right"
                    title="Update" class="btn btn-success mb-4 ms-auto"><i
                        class="fa-solid fa-floppy-disk fa-beat me-2"></i>
                    Update</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        Livewire.on("finish", (status, message) => {
            alertMessage(1, 'Item updated successfully!')
        })
    </script>
@endpush