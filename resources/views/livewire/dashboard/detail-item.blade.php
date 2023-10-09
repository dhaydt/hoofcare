<div>
    <style>
        .img-assset {
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
        @if ($method == 'update')
        <form action="{{ route('update.items') }}" method="post" enctype="multipart/form-data">
            <input type="text" wire:model="item_id" name="id" class="d-none">
            @else
            <form action="{{ route('post.items') }}" method="post" enctype="multipart/form-data">
                @endif
                @csrf
                <div class="row">
                    <div class="col col-md-6">
                        <div class="white_card_body">
                            <h6 class="card-subtitle mb-2 mb-2">Name</h6>
                            <div class=" mb-0">
                                <input type="text" class="form-control" name="name" id="inputText" placeholder="Name"
                                    wire:model="name">
                            </div>
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="white_card_body">
                            <h6 class="card-subtitle mb-2 mb-2">Category</h6>
                            <div class=" mb-0">
                                <select class="form-select required" wire:model="category" name="category">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($listCategory as $lc)
                                    <option value="{{ $lc['id'] }}">{{ $lc['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                    <img src="{{ asset('storage/'.$pic1) }}"
                                        onerror="this.src=`{{ asset('assets/images/no_img.jpeg') }}`" height="200px"
                                        alt="" class="img-assset">
                                    @endif
                                </div>
                                <input type="file" class="form-control mt-2 mx-auto"
                                    accept="image/jpeg, image/jpg, image/png" name="pic1">
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
                                    <img src="{{ asset('storage/'.$pic2) }}"
                                        onerror="this.src=`{{ asset('assets/images/no_img.jpeg') }}`" height="200px"
                                        alt="" class="img-assset" />
                                    @endif
                                </div>
                                <input type="file" name="pic2" class="form-control mt-2 mx-auto"
                                    accept="image/jpeg, image/jpg, image/png">
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
                                    <img src="{{ asset('storage/'.$pic3) }}"
                                        onerror="this.src=`{{ asset('assets/images/no_img.jpeg') }}`" height="200px"
                                        alt="" class="img-assset">
                                    @endif
                                </div>
                                <input type="file" name="pic3" class="form-control mt-2 mx-auto"
                                    accept="image/jpeg, image/jpg, image/png">
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
                                    <img src="{{ asset('storage/'.$pic4) }}"
                                        onerror="this.src=`{{ asset('assets/images/no_img.jpeg') }}`" height="200px"
                                        alt="" class="img-assset">
                                    @endif
                                </div>
                                <input type="file" name="pic4" class="form-control mt-2 mx-auto"
                                    accept="image/jpeg, image/jpg, image/png">
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
                                            <img src="{{ $newPic5->temporaryUrl() }}" height="200px" alt=""
                                                class="img-assset">
                                            @else
                                            <img src="{{ asset('storage/'.$pic5) }}"
                                                onerror="this.src=`{{ asset('assets/images/no_img.jpeg') }}`"
                                                height="200px" alt="" class="img-assset" />
                                            @endif
                                        </div>
                                        <input type="file" name="pic5" class="form-control mt-2 mx-auto"
                                            accept="image/jpeg, image/jpg, image/png">
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
                                <a href="{{ route('view_pdf', [$link1]) }}" target="_blank"
                                    class="btn btn-sm btn-warning">View PDF</a>
                                @endif --}}
                                @if ($itemDetail)
                                @if ($itemDetail['file1'])
                                <iframe src="{{ asset('storage'.'/'.$itemDetail['file1']['file']) }}" width="100%"
                                    height="600" frameborder="2">
                                    This browser does not support PDFs. Please download the PDF to view it: <a
                                        href="{{ asset('storage'.'/'.$file_link1) }}">Download PDF</a>
                                </iframe>
                                @if (count($file1_img) > 0)
                                <div class="magazine-viewport">
                                    <div class="container">
                                        <div class="magazine">
                                            <!-- Next button -->
                                            <div ignore="1" class="next-button"></div>
                                            <!-- Previous button -->
                                            <div ignore="1" class="previous-button"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnails">
                                    <div>
                                        <ul>
                                            @foreach ($file1_img as $f1)
                                            <li class="i">
                                                <img src="{{ asset('storage/flip/'.$f1['folder'].'/'.$f1['img']) }}"
                                                    width="76" height="100" class="page-1">
                                                <span>1</span>
                                            </li>
                                            @endforeach
                                            {{-- <img src="{{ asset('storage/flip/'.$f1['folder'].'/'.$f1['img']) }}"
                                                height="50px;" alt="not_found"> --}}
                                        <ul>
                                    <div>
                                </div>
                                    </div>
                                </div>
                                @endif
                                @endif
                                @endif
                                <input type="file" name="file1" class="form-control mt-2" accept="application/pdf">
                            </div>
                            @error('file_link1') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col col-md-6 mb-3">
                        <div class="white_card_body card shadow-sm me-4 pt-4 mt-4">
                            <h6 class="card-subtitle mb-4">File Link 2</h6>
                            <div class=" mb-0">
                                @if ($itemDetail)
                                @if ($itemDetail['file2'])
                                <iframe src="{{ asset('storage'.'/'.$itemDetail['file2']['file']) }}" width="100%"
                                    height="600" frameborder="2">
                                    This browser does not support PDFs. Please download the PDF to view it: <a
                                        href="{{ asset('storage'.'/'.$file_link2) }}">Download PDF</a>
                                </iframe>
                                @if (count($file2_img) > 0)
                                <div class="magazine-viewport">
                                    <div class="container">
                                        <div class="magazine">
                                            <!-- Next button -->
                                            <div ignore="1" class="next-button"></div>
                                            <!-- Previous button -->
                                            <div ignore="1" class="previous-button"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnails">
                                    <div>
                                        <ul>
                                            @foreach ($file2_img as $f2)
                                            <li class="i">
                                                <img src="{{ asset('storage/flip/'.$f2['folder'].'/'.$f2['img']) }}"
                                                    width="76" height="100" class="page-1">
                                                <span>1</span>
                                            </li>
                                            @endforeach
                                            {{-- <img src="{{ asset('storage/flip/'.$f2['folder'].'/'.$f2['img']) }}"
                                                height="50px;" alt="not_found"> --}}
                                        <ul>
                                    <div>
                                </div>
                                    </div>
                                @endif
                                @endif
                                @endif
                                    <input type="file" name="file2" class="form-control mt-2" accept="application/pdf">
                                </div>
                                @error('file_link2') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        {{-- <form wire:submit.prevent="{{ $method }}" class="d-flex pe-5"> --}}
                            <div class="d-flex pe-5">
                                <button type="submit" data-bs-toggle="tooltip" data-bs-placement="right" title="Update"
                                    class="btn btn-success mb-4 ms-auto"><i
                                        class="fa-solid fa-floppy-disk fa-beat me-2"></i>
                                    @if ($item_id == 0)
                                    Save
                                    @else
                                    Update
                                    @endif
                                </button>
                            </div>
                            {{--
                        </form> --}}
            </form>
    </div>
</div>
</div>
@push('scripts')
<script type="text/javascript">

    function loadApp() {
    
         $('#canvas').fadeIn(1000);
    
         var flipbook = $('.magazine');
    
         // Check if the CSS was already loaded
        
        if (flipbook.width()==0 || flipbook.height()==0) {
            setTimeout(loadApp, 10);
            return;
        }
        
        // Create the flipbook
    
        flipbook.turn({
                
                // Magazine width
    
                width: 922,
    
                // Magazine height
    
                height: 600,
    
                // Duration in millisecond
    
                duration: 1000,
    
                // Hardware acceleration
    
                acceleration: !isChrome(),
    
                // Enables gradients
    
                gradients: true,
                
                // Auto center this flipbook
    
                autoCenter: true,
    
                // Elevation from the edge of the flipbook when turning a page
    
                elevation: 50,
    
                // The number of pages
    
                pages: 12,
    
                // Events
    
                when: {
                    turning: function(event, page, view) {
                        
                        var book = $(this),
                        currentPage = book.turn('page'),
                        pages = book.turn('pages');
                
                        // Update the current URI
    
                        Hash.go('page/' + page).update();
    
                        // Show and hide navigation buttons
    
                        disableControls(page);
                        
    
                        $('.thumbnails .page-'+currentPage).
                            parent().
                            removeClass('current');
    
                        $('.thumbnails .page-'+page).
                            parent().
                            addClass('current');
    
    
    
                    },
    
                    turned: function(event, page, view) {
    
                        disableControls(page);
    
                        $(this).turn('center');
    
                        if (page==1) { 
                            $(this).turn('peel', 'br');
                        }
    
                    },
    
                    missing: function (event, pages) {
    
                        // Add pages that aren't in the magazine
    
                        for (var i = 0; i < pages.length; i++)
                            addPage(pages[i], $(this));
    
                    }
                }
    
        });
    
        // Zoom.js
    
        $('.magazine-viewport').zoom({
            flipbook: $('.magazine'),
    
            max: function() { 
                
                return largeMagazineWidth()/$('.magazine').width();
    
            }, 
    
            when: {
    
                swipeLeft: function() {
    
                    $(this).zoom('flipbook').turn('next');
    
                },
    
                swipeRight: function() {
                    
                    $(this).zoom('flipbook').turn('previous');
    
                },
    
                resize: function(event, scale, page, pageElement) {
    
                    if (scale==1)
                        loadSmallPage(page, pageElement);
                    else
                        loadLargePage(page, pageElement);
    
                },
    
                zoomIn: function () {
    
                    $('.thumbnails').hide();
                    $('.made').hide();
                    $('.magazine').removeClass('animated').addClass('zoom-in');
                    $('.zoom-icon').removeClass('zoom-icon-in').addClass('zoom-icon-out');
                    
                    if (!window.escTip && !$.isTouch) {
                        escTip = true;
    
                        $('<div />', {'class': 'exit-message'}).
                            html('<div>Press ESC to exit</div>').
                                appendTo($('body')).
                                delay(2000).
                                animate({opacity:0}, 500, function() {
                                    $(this).remove();
                                });
                    }
                },
    
                zoomOut: function () {
    
                    $('.exit-message').hide();
                    $('.thumbnails').fadeIn();
                    $('.made').fadeIn();
                    $('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');
    
                    setTimeout(function(){
                        $('.magazine').addClass('animated').removeClass('zoom-in');
                        resizeViewport();
                    }, 0);
    
                }
            }
        });
    
        // Zoom event
    
        if ($.isTouch)
            $('.magazine-viewport').bind('zoom.doubleTap', zoomTo);
        else
            $('.magazine-viewport').bind('zoom.tap', zoomTo);
    
    
        // Using arrow keys to turn the page
    
        $(document).keydown(function(e){
    
            var previous = 37, next = 39, esc = 27;
    
            switch (e.keyCode) {
                case previous:
    
                    // left arrow
                    $('.magazine').turn('previous');
                    e.preventDefault();
    
                break;
                case next:
    
                    //right arrow
                    $('.magazine').turn('next');
                    e.preventDefault();
    
                break;
                case esc:
                    
                    $('.magazine-viewport').zoom('zoomOut');	
                    e.preventDefault();
    
                break;
            }
        });
    
        // URIs - Format #/page/1 
    
        Hash.on('^page\/([0-9]*)$', {
            yep: function(path, parts) {
                var page = parts[1];
    
                if (page!==undefined) {
                    if ($('.magazine').turn('is'))
                        $('.magazine').turn('page', page);
                }
    
            },
            nop: function(path) {
    
                if ($('.magazine').turn('is'))
                    $('.magazine').turn('page', 1);
            }
        });
    
    
        $(window).resize(function() {
            resizeViewport();
        }).bind('orientationchange', function() {
            resizeViewport();
        });
    
        // Events for thumbnails
    
        $('.thumbnails').click(function(event) {
            
            var page;
    
            if (event.target && (page=/page-([0-9]+)/.exec($(event.target).attr('class'))) ) {
            
                $('.magazine').turn('page', page[1]);
            }
        });
    
        $('.thumbnails li').
            bind($.mouseEvents.over, function() {
                
                $(this).addClass('thumb-hover');
    
            }).bind($.mouseEvents.out, function() {
                
                $(this).removeClass('thumb-hover');
    
            });
    
        if ($.isTouch) {
        
            $('.thumbnails').
                addClass('thumbanils-touch').
                bind($.mouseEvents.move, function(event) {
                    event.preventDefault();
                });
    
        } else {
    
            $('.thumbnails ul').mouseover(function() {
    
                $('.thumbnails').addClass('thumbnails-hover');
    
            }).mousedown(function() {
    
                return false;
    
            }).mouseout(function() {
    
                $('.thumbnails').removeClass('thumbnails-hover');
    
            });
    
        }
    
    
        // Regions
    
        if ($.isTouch) {
            $('.magazine').bind('touchstart', regionClick);
        } else {
            $('.magazine').click(regionClick);
        }
    
        // Events for the next button
    
        $('.next-button').bind($.mouseEvents.over, function() {
            
            $(this).addClass('next-button-hover');
    
        }).bind($.mouseEvents.out, function() {
            
            $(this).removeClass('next-button-hover');
    
        }).bind($.mouseEvents.down, function() {
            
            $(this).addClass('next-button-down');
    
        }).bind($.mouseEvents.up, function() {
            
            $(this).removeClass('next-button-down');
    
        }).click(function() {
            
            $('.magazine').turn('next');
    
        });
    
        // Events for the next button
        
        $('.previous-button').bind($.mouseEvents.over, function() {
            
            $(this).addClass('previous-button-hover');
    
        }).bind($.mouseEvents.out, function() {
            
            $(this).removeClass('previous-button-hover');
    
        }).bind($.mouseEvents.down, function() {
            
            $(this).addClass('previous-button-down');
    
        }).bind($.mouseEvents.up, function() {
            
            $(this).removeClass('previous-button-down');
    
        }).click(function() {
            
            $('.magazine').turn('previous');
    
        });
    
    
        resizeViewport();
    
        $('.magazine').addClass('animated');
    
    }
    
    // Zoom icon
    
     $('.zoom-icon').bind('mouseover', function() { 
         
         if ($(this).hasClass('zoom-icon-in'))
             $(this).addClass('zoom-icon-in-hover');
    
         if ($(this).hasClass('zoom-icon-out'))
             $(this).addClass('zoom-icon-out-hover');
     
     }).bind('mouseout', function() { 
         
          if ($(this).hasClass('zoom-icon-in'))
             $(this).removeClass('zoom-icon-in-hover');
         
         if ($(this).hasClass('zoom-icon-out'))
             $(this).removeClass('zoom-icon-out-hover');
    
     }).bind('click', function() {
    
         if ($(this).hasClass('zoom-icon-in'))
             $('.magazine-viewport').zoom('zoomIn');
         else if ($(this).hasClass('zoom-icon-out'))	
            $('.magazine-viewport').zoom('zoomOut');
    
     });
    
     $('#canvas').hide();
    
    
    // Load the HTML4 version if there's not CSS transform
    
    yepnope({
        test : Modernizr.csstransforms,
        yep: ['{{ asset("assets/flipped/lib/turn.js") }}'],
        nope: ['{{ asset("assets/flipped/lib/turn.html4.min.js") }}'],
        both: ['{{ asset("assets/flipped/lib/zoom.min.js") }}', '{{ asset("assets/flipped/lib/magazine.js") }}', '{{ asset("assets/flipped/css/magazine.css") }}'],
        complete: loadApp
    });
    
    </script>
<script>
    Livewire.on("finish", (status, message) => {
            alertMessage(1, 'Item updated successfully!')
        })
</script>
@endpush