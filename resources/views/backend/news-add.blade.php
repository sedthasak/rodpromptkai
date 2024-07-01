@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/classic/ckeditor.css">
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_news')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">ย้อนกลับ</a>    
        </div>
    </div>
    <form method="post" action="{{ route('BN_news_add_action') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required />
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <div class="sm:grid grid-cols-1 gap-1">
                            <div>
                                <label for="title" class="form-label">ชื่อ</label>
                                <input type="text" class="form-control w-full" id="title" name="title" autocomplete="on" required/>
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div>
                                <label for="feature" class="form-label">รูปภาพหน้าปก</label>
                                <input type="file" class="form-control w-full" id="feature" name="feature" autocomplete="off" required/>
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div>
                                <label for="excerpt" class="form-label">คำอธิบาย</label>
                                <input type="text" class="form-control w-full" id="excerpt" name="excerpt"  autocomplete="on" required/>
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div>
                                <label for="content" class="form-label">เนื้อหา</label>
                                <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="content"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary w-24">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create( document.querySelector( '#content' ), {
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'link',
                            'bulletedList',
                            'numberedList',
                            '|',
                            'alignment', // Include alignment plugin
                            '|',
                            'fontColor',
                            'fontBackgroundColor',
                            '|',
                            'fontSize',
                            '|',
                            'insertTable',
                            '|',
                            'mediaEmbed',
                            '|',
                            'codeBlock',
                            '|',
                            'highlight',
                            '|',
                            'undo',
                            'redo',
                            '|',
                            'imageUpload',
                            '|',
                            'imageTextAlternative',
                            'imageStyle:inline',
                            'imageStyle:block',
                            'imageStyle:side',
                            '|',
                            'fullscreen'
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    language: 'en',
                    image: {
                        toolbar: [
                            'imageTextAlternative',
                            'imageStyle:inline',
                            'imageStyle:block',
                            'imageStyle:side'
                        ],
                        styles: [
                            'alignLeft', 'alignCenter', 'alignRight'
                        ]
                    },
                    // Customize the image upload handler
                    // Ensure CSRF token is sent with the request
                    fileTools: {
                        uploadUrl: '{{ route("upload.image") }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }
                } )
                .then( editor => {
                    console.log( 'Editor was initialized', editor );

                    // Update hidden textarea on editor change
                    editor.model.document.on( 'change:data', () => {
                        document.getElementById( 'content' ).value = editor.getData();
                    } );

                    // Error handling for image upload
                    editor.plugins.get( 'FileRepository' ).createUploadAdapter = function( loader ) {
                        return {
                            upload: function() {
                                return loader.file
                                    .then( file => new Promise( ( resolve, reject ) => {
                                        const formData = new FormData();
                                        formData.append( 'upload', file );

                                        // Send AJAX request
                                        fetch( '{{ route("upload.image") }}', {
                                            method: 'POST',
                                            body: formData,
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            }
                                        } )
                                        .then( response => {
                                            if ( !response.ok ) {
                                                throw new Error( 'Cannot upload file: ' + file.name );
                                            }

                                            return response.json();
                                        } )
                                        .then( data => {
                                            resolve( {
                                                default: data.url
                                            } );
                                        } )
                                        .catch( error => {
                                            reject( error.message );
                                        } );
                                    } ) );
                            },
                            abort: function() {
                                console.log( 'Upload aborted' );
                            }
                        };
                    };
                } )
                .catch( error => {
                    console.error( error );
                } );
        });
    </script>
@endsection
