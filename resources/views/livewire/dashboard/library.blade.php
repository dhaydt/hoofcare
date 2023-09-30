<div class="main_content_iner ">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_body pt-4">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Your Library</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                                <div class="search_field">
                                                    <input type="text" placeholder="Search item here..." wire:model.live="search">
                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        <a href="{{ route('user.add.item') }}" data-bs-toggle="modal" data-bs-target="#addcategory"
                                            class="btn_1">Add New</a>
                                    </div>
                                </div>
                            </div>
                            <div class="QA_table mb_30">

                                <table class="table lms_table_active ">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. </th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Picture 1</th>
                                            <th scope="col">Descripiton</th>
                                            <th scope="col">Online Link</th>
                                            <th scope="col">Credit</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $d)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $d['name'] }}</td>
                                            <td>{{ $d['category']['name'] }}</td>
                                            <td>{{ $d['user']['name'] }}</td>
                                            <td>
                                                <img height="100px" src="{{ asset('storage/'.$d['pic1']) }}" alt="">
                                            </td>
                                            <td>{{ $d['description'] }}</td>
                                            <td>
                                                <a target="_blank" href="{{ route('item.detail', [$d['id'], $d['name']]) }}" class="btn btn-sm btn-outline-secondary">Link</a>
                                            </td>
                                            <td>{{ $d['credit'] }}</td>
                                            <td>
                                                <a href="{{ route('user.detail.item', [$d['id']]) }}" data-bs-toggle="tooltip" title="Edit" class="btn btn-sm btn-icon btn-success">
                                                    <div class="fas fa-edit"></div>
                                                </a>
                                                <button type="button" wire:click.prevent="$dispatch('onClickDelete', `{{ $d->id }}`)"
                                                    class="btn btn-sm btn-icon bg-danger btn-hover-rotate-end" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="delete"><i
                                                        class="fas fa-trash text-light"></i></button>
                                                @if ($d['pic1'])
                                                <a href="javascript:void(0)"  data-id="{{ $d['id'] }}" class="btn btn-info btn-sm publishToProfile text-light" data-bs-toggle="tooltip" title="Post To Facebook" ><i class="fab fa-facebook-square"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('click','.publishToProfile',function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('page')}}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data:{id:id},
                success:function(data){
                    if (data.status == 200) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.msg,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                    }
                    if (data.status == 400) {
                        Swal.fire({
                            title: 'Error!',
                            text: data.msg,
                            icon: 'error',
                            confirmButtonText: 'Cancel'
                        })
                    }
                }
            });
        });
        });
        Livewire.on("finishCabang", (status, message) => {
            console.log('stat',status)
            alertMessage(status[0], status[1])
        })

        Livewire.on('onClickDelete', async (id) => {
            const response = await alertHapus('Warning !!!', 'Are you sure to delete this item?')
            if(response.isConfirmed == true){
                @this.set('library_id', id)
                Livewire.dispatch('delete')
            }
        })
    </script>
@endpush