<div>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="mb-4 input-group input-group-outline w-md-25 w-50">
                    <input type="text" class="form-control" placeholder="Find services" wire:model.live="search">
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
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">No
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">Name
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">Service
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Business name
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">Zip
                                code
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Detail
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($contacts) > 0)
                        @foreach ($contacts as $i => $item)
                        <tr>
                            <td class="align-middle text-center">{{ $i + 1 }}</td>
                            <td class="align-middle text-center text-capitalize">{{ $item->f_name . $item->l_name}}</td>
                            <td class="align-middle text-center text-capitalize">{{ $item->services}}</td>
                            <td class="align-middle text-center text-capitalize">
                                {{ $item->business_name }}
                            </td>
                            <td class="align-middle text-center text-capitalize">{{ $item->zipcode}}</td>
                            <td class="align-middle text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" wire:click.prevent="$dispatch('onClickDetail', { data : {{ $item }} })"
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
                                    <img src="{{ asset('assets/images/no_data.png') }}" alt="" class="h-125px w-125px" style="height: 250px; width: auto;">
                                    <div class="text-center">
                                        <span class="badge badge-square badge-lg badge-danger text-capitalize p-2 text-dark">
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

                            <button type="button" class="btn-close text-danger" style="opacity: unset;" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="tooltip" title="close">
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
                                    <input type="text" class="form-control form-control-solid" wire:model="business_name" disabled
                                        placeholder="Business name" />
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
                                    <label for="exampleFormControlInput1" class="required form-label">Service</label>
                                    <input type="text" class="form-control form-control-solid" wire:model="services" disabled
                                        placeholder="Zip code" />
                                </div>
                                <div class="mb-4">
                                    <label for="exampleFormControlInput1" class="required form-label">Certifications</label>
                                    <img src="{{ asset('storage/'.$certifications) }}" alt="" style="max-width: 100%; height: auto">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleFormControlInput1" class="required form-label">Online link 1</label>
                                    <input type="text" class="form-control form-control-solid" wire:model="online_link_1" disabled
                                        placeholder="Online link 1" />
                                </div>
                                <div class="mb-4">
                                    <label for="exampleFormControlInput1" class="required form-label">Online link 2</label>
                                    <input type="text" class="form-control form-control-solid" wire:model="online_link_2" disabled
                                        placeholder="Zip code" />
                                </div>
                                <div class="mb-4">
                                    <label for="exampleFormControlInput1" class="required form-label">Preferred contact method</label>
                                    <input type="text" class="form-control form-control-solid" wire:model="prefered_contact_method" disabled
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
                                    <input type="text" class="form-control form-control-solid" wire:model="text" disabled
                                        placeholder="text" />
                                </div>
                                <div class="mb-4">
                                    <label for="exampleFormControlInput1" class="required form-label">Messenger</label>
                                    <input type="text" class="form-control form-control-solid" wire:model="messenger" disabled
                                        placeholder="Messenger" />
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="background-color: #dc3545">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-9 pt-3 pb-5">
                <div
                    class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                    @include('livewire.helper.total-show')
                </div>
                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        Livewire.on('onClickDetail', (data) => {
            console.log('item', data);
            Livewire.dispatch('detailContact', { data: data});
            $('#modal_detail').modal('show')
        })
    })
</script>
@endpush