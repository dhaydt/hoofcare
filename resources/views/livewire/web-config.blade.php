<div>
    <style>
        .col-6 {
            flex: 0 0 auto;
            width: 50%;
        }

        .image-input:not(.image-input-empty) {
            background-image: none !important;
        }

        .image-input {
            position: relative;
            display: inline-block;
            border-radius: 0.475rem;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .img-profile {
            height: 100px;
            border-radius: 12%;
            box-shadow: 0px 2px 6px 0px rgb(0 0 0 / 20%);
        }

        .btn.btn-icon:not(.btn-outline):not(.btn-dashed):not(.border-hover):not(.border-active):not(.btn-flush) {
            border: 0;
        }

        .btn.btn-icon.btn-circle {
            border-radius: 50%;
        }

        .image-input [data-kt-image-input-action=change] {
            left: 96%;
            top: 5px;
            background: #959595;
        }

        .image-input [data-kt-image-input-action] {
            cursor: pointer;
            position: absolute;
            transform: translate(-50%, -50%);
        }

        .btn.btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            height: calc(1em + 1rem);
            width: calc(1em + 1rem);
        }

        .image-input [data-kt-image-input-action=change] input {
            width: 0 !important;
            height: 0 !important;
            overflow: hidden;
            opacity: 0;
        }

    </style>
    <form wire:submit.prevent="save" id="form_add">
        <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
            class="grid grid-cols-[--cols-default] lg:grid-cols-[--cols-lg] fi-fo-component-ctn gap-6">

            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="data.name">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Web Name<sup class="text-danger-600 dark:text-danger-400 font-medium">*</sup>
                                </span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div
                                class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white focus-within:ring-2 dark:bg-white/5 ring-gray-950/10 focus-within:ring-primary-600 dark:ring-white/20 dark:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                                <div class="min-w-0 flex-1">
                                    <input
                                        class="fi-input block w-full border-none bg-transparent py-1.5 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 ps-3 pe-3"
                                        id="data.name" maxlength="255" wire:model="name" required="required"
                                        type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="data.name">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Country
                                </span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div
                                class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white focus-within:ring-2 dark:bg-white/5 ring-gray-950/10 focus-within:ring-primary-600 dark:ring-white/20 dark:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                                <div class="min-w-0 flex-1">
                                    <input
                                        class="fi-input block w-full border-none bg-transparent py-1.5 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 ps-3 pe-3"
                                        id="data.country" maxlength="255" wire:model="country" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="data.name">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Email
                                </span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div
                                class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white focus-within:ring-2 dark:bg-white/5 ring-gray-950/10 focus-within:ring-primary-600 dark:ring-white/20 dark:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                                <div class="min-w-0 flex-1">
                                    <input
                                        class="fi-input block w-full border-none bg-transparent py-1.5 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 ps-3 pe-3"
                                        id="data.email" maxlength="255" wire:model="email" type="email">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="data.name">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Phone number
                                </span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div
                                class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white focus-within:ring-2 dark:bg-white/5 ring-gray-950/10 focus-within:ring-primary-600 dark:ring-white/20 dark:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                                <div class="min-w-0 flex-1">
                                    <input
                                        class="fi-input block w-full border-none bg-transparent py-1.5 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 ps-3 pe-3"
                                        id="data.phone" maxlength="255" wire:model="phone" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="data.name">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Link Advertising (URL ex: http://www.google.com, need to use "http" or "https" in URL)
                                </span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div
                                class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white focus-within:ring-2 dark:bg-white/5 ring-gray-950/10 focus-within:ring-primary-600 dark:ring-white/20 dark:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                                <div class="min-w-0 flex-1">
                                    <input
                                        class="fi-input block w-full border-none bg-transparent py-1.5 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 ps-3 pe-3"
                                        id="ads" maxlength="500" wire:model="link_ads" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="data.email">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Address
                                </span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div
                                class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white focus-within:ring-2 dark:bg-white/5 ring-gray-950/10 focus-within:ring-primary-600 dark:ring-white/20 dark:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                                <div class="min-w-0 flex-1">
                                    <textarea
                                        class="fi-input block w-full border-none bg-transparent py-1.5 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 ps-3 pe-3"
                                        id="data.email" required="required" type="text" wire:model="address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="data.pic2">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Web Logo
                                </span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div class="col-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                    @if ($new_web_logo)
                                    <img class="image-input image-input-outline img-profile"
                                        src="{{ $new_web_logo->temporaryUrl() }}"></img>
                                    @else
                                    <img id="placeholder" src="{{ asset('storage/'.$web_logo) }}" class="img-profile preview-img"
                                        onerror="this.src='{{ asset('assets/images/placeholder.png') }}'">
                                    @endif
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        aria-label="Masukan foto outlet" data-bs-original-title="Masukan foto outlet"
                                        title="change logo" data-kt-initialized="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" style="height: 20px;">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                        <input type="file" id="profile" name="img" accept=".png, .jpg, .jpeg"
                                            wire:model="new_web_logo">
                                    </label>
                                </div>
                                <div class="form-text">Accepted file: png, jpg, jpeg.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="fi-form-actions" style="margin-top: 20px;">
            <div class="fi-ac gap-3 flex flex-wrap items-center justify-start">
                <button style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);"
                    class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus:ring-custom-500/50 dark:focus:ring-custom-400/50 fi-ac-btn-action"
                    type="submit">
                    <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        class="animate-spin fi-btn-icon h-5 w-5" style="display: none;">
                        <path clip-rule="evenodd"
                            d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                            fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                        <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor">
                        </path>
                    </svg>
                    Update
                </button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@livewireScripts()
<script>
    Livewire.on("finish", (status, message) => {
        console.log(status)
        Swal.fire({
            title: 'Success!',
            text: status[1],
            icon: 'success',
            confirmButtonText: 'OK'
        })
    })
</script>