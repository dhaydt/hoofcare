<div>
    @if (count($iklan) > 0)
    <div class="iklan-section mb-3">
        @foreach ($iklan as $i)
        <a href="{{ $i['link'] }}" target="_blank" class="wrapper mb-1">
            <img src="{{ asset('storage/'.$i['image']) }}" height="100px" width="100%" alt="ad">
        </a>
        @endforeach
    </div>
    @endif
<div class="card">
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="mb-4 input-group input-group-outline w-md-25 w-50">
                {{-- <input type="text" class="form-control" placeholder="Find services" wire:model.live="search"> --}}
                <select name="search" wire:model.live="search" class="form-select">
                    <option value="">-- Find Services Offered --</option>
                    @foreach (\App\CPU\Helpers::serviceList() as $s)
                    <option value="{{ $s }}">{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 input-group input-group-outline w-md-25 w-50">
                {{-- <input type="number" class="form-control" placeholder="Find By Zipcode"
                    wire:model.live="zipsearch"> --}}
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Find by zipcode"
                        aria-describedby="basic-addon2" wire:model.live="zipsearch">
                    <button class="input-group-text" id="basic-addon2"
                        wire:click.prevent="$dispatch('onFindZipcode')">Find</button>
                    <button class="input-group-text" id="basic-addon2"
                        wire:click.prevent="$dispatch('onResetZipcode')">Reset</button>
                </div>
            </div>

            {{-- <div class="col-md-6 text-end">
                <button type="button" class="btn btn-light-success btn-sm" wire:click="$emit('onClickRefresh')"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh contact">
                    <i class="fas fa-sync-alt"></i> Segarkan
                </button>
            </div> --}}
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-capitalize text-sm text-dark font-weight-bolder opacity-75 text-center">No
                        </th>
                        <th class="text-capitalize text-sm text-dark font-weight-bolder opacity-75 text-center">Name
                        </th>
                        <th class="text-capitalize text-sm text-dark font-weight-bolder opacity-75 text-center">Service
                        </th>
                        <th class="text-capitalize text-sm text-dark font-weight-bolder opacity-75 text-center">Category
                        </th>
                        <th class="text-capitalize text-sm text-dark font-weight-bolder opacity-75 text-center">
                            Business name
                        </th>
                        <th class="text-capitalize text-sm text-dark font-weight-bolder opacity-75 text-center">Zip
                            code
                        </th>
                        <th class="text-capitalize text-sm text-dark font-weight-bolder opacity-75 text-center">Zip
                            Distance
                        </th>
                        <th class="text-capitalize text-sm text-dark font-weight-bolder opacity-75 text-center">
                            Detail
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($contacts) > 0)
                    @php($i=1)
                    @foreach ($contacts as $item)
                    <tr>
                        <td class="align-middle text-center">{{ $i++ }}</td>
                        <td class="align-middle text-center text-capitalize">{{ $item->f_name .' ' . $item->l_name}}
                        </td>
                        <td class="align-middle text-center text-capitalize">
                            @foreach (json_decode($item->services) as $s)
                            <span class="badge bg-success">{{ $s }}</span>
                            @endforeach
                        </td>
                        <td class="align-middle text-center text-capitalize">
                            @foreach (json_decode($item->category_id) as $c)
                            <span class="badge bg-secondary">{{ $c }}</span>
                            @endforeach
                        </td>
                        <td class="align-middle text-center text-capitalize">
                            {{ $item->business_name }}
                        </td>
                        <td class="align-middle text-center text-capitalize">{{ $item->zipcode}}</td>
                        <td class="align-middle text-center text-capitalize">{{ $item->distance ? '-/+
                            '.$item->distance.' km' : '-'}}</td>
                        <td class="align-middle text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button"
                                    wire:click.prevent="$dispatch('onClickDetail', { data : {{ $item }} })"
                                    class="btn btn-sm bg-success text-white btn-hover-rotate-start"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="View data"><i
                                        class="fas fa-eye text-light"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="no-data">
                        <td colspan="6">
                            <div class="row justify-content-center mx-0">
                                <img src="{{ asset('assets/images/no_data.png') }}" alt="" class="h-125px w-125px"
                                    style="height: 250px; width: auto;">
                                <div class="text-center">
                                    <span
                                        class="badge badge-square badge-lg badge-danger text-capitalize p-2 text-dark">
                                        No contact found</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!--Modal Update -->
        <div wire:ignore class="modal fade" tabindex="-1" id="modal_detail" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail contact</h5>

                        <button type="button" class="btn-close text-danger" style="opacity: unset;"
                            data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="tooltip" title="close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <form id="show_detail">
                        <input type="hidden" wire:mode="cabang_id">
                        <div class="modal-body">
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">First Name</label>
                                <input type="text" class="form-control form-control-solid" wire:model="f_name" disabled
                                    placeholder="first name" />
                                @error('f_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Last Name</label>
                                <input type="text" class="form-control form-control-solid" wire:model="l_name" disabled
                                    placeholder="last name" />
                                @error('l_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Business name</label>
                                <input type="text" class="form-control form-control-solid" wire:model="business_name"
                                    disabled placeholder="Business name" />
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">ZIP code</label>
                                <input type="text" class="form-control form-control-solid" wire:model="zipcode" disabled
                                    placeholder="Zip code" />
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Country</label>
                                <input type="text" class="form-control form-control-solid" wire:model="country" disabled
                                    placeholder="Country" />
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Services</label>
                                <div id="services"></div>
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Category</label>
                                <div id="category"></div>
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Certifications</label>
                                <img id="certifications" src="" alt="no_certitifcations" width="100%" height="auto">
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Online link 1</label>
                                <input type="text" class="form-control form-control-solid" wire:model="online_link_1"
                                    disabled placeholder="Online link 1" />
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Online link 2</label>
                                <input type="text" class="form-control form-control-solid" wire:model="online_link_2"
                                    disabled placeholder="Online link 2" />
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Preferred contact
                                    method</label>
                                <input type="text" class="form-control form-control-solid"
                                    wire:model="prefered_contact_method" disabled
                                    placeholder="Preferred contact method" />
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Phone</label>
                                <input type="text" class="form-control form-control-solid" wire:model="phone" disabled
                                    placeholder="phone" />
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Email</label>
                                <input type="text" class="form-control form-control-solid" wire:model="email" disabled
                                    placeholder="email" />
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Text</label>
                                <textarea type="text" class="form-control form-control-solid" wire:model="text" disabled
                                    placeholder="Description box">{{ $text }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="required form-label">Messenger</label>
                                <input type="text" class="form-control form-control-solid" wire:model="messenger"
                                    disabled placeholder="Messenger" />
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                            style="background-color: #dc3545">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-9 pt-3 pb-5">
            @if ($zipsearch == '')
            <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                @include('livewire.helper.total-show')
            </div>
            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                {{ $contacts->links() ?? '' }}
            </div>
            @endif
        </div>
    </div>
</div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        Livewire.on('onClickDetail', (data) => {
            $('#certifications').attr("src", `{{ asset('storage/') }}`)
            $('#services').empty()
            $('#category').empty()
            console.log('item', data);
            Livewire.dispatch('detailContact', { data: data});
            $('#certifications').attr("src", `{{ asset('storage/`+ data.data.certifications +`') }}`)
            $('#services').append('<input type="text" class="form-control form-control-solid" value="'+JSON.parse(data.data.services)+'" disabled/>')
            $('#category').append('<input type="text" class="form-control form-control-solid" value="'+JSON.parse(data.data.category_id)+'" disabled/>')
            $('#modal_detail').modal('show')
        })
        
        Livewire.on('onFindZipcode', () => {
            Livewire.dispatch('findZipcode');
        })
        
        Livewire.on('onResetZipcode', () => {
            Livewire.dispatch('resetZipcode');
        })

    })
</script>
@endpush