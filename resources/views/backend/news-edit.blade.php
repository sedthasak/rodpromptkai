@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_news')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >ย้อนกลับ</a>    
        </div>
    </div>
    
    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{route('BN_news_edit_action')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="news_id" value="{{$mynews->id}}" required />
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" required />
        
        <!-- Title -->
        <div class="sm:grid grid-cols-1 gap-1">
            <div>
                <label for="title" class="form-label">ชื่อ</label>
                <input type="text" class="form-control w-full" id="title" name="title" autocomplete="off" value="{{$mynews->title}}" required/>
                @error('title')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Feature Image Upload -->
        <div class="sm:grid grid-cols-1 gap-1 mt-5">
            <div>
                <label for="feature" class="form-label">รูปภาพหน้าปก</label>
                <input type="file" class="form-control w-full" id="feature" name="feature" autocomplete="off"/>
                @error('feature')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Current Feature Image Display -->
        @if(isset($mynews->feature))
        <div class="sm:grid grid-cols-1 gap-1 mt-5">
            <div>
                <label for="current_feature" class="form-label">รูปภาพหน้าปกปัจจุบัน</label>
                <img width="150" src="{{ asset($mynews->feature) }}">
            </div>
        </div>
        @endif

        <!-- Excerpt -->
        <div class="sm:grid grid-cols-1 gap-1 mt-5">
            <div>
                <label for="excerpt" class="form-label">คำอธิบาย</label>
                <input type="text" class="form-control w-full" id="excerpt" name="excerpt" autocomplete="off" value="{{$mynews->excerpt}}" required/>
                @error('excerpt')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Content -->
        <div class="sm:grid grid-cols-1 gap-1 mt-5">
            <div>
                <label for="content" class="form-label">เนื้อหา</label>
                <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="content">{{$mynews->content}}</textarea>
                @error('content')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Meta Fields -->
        <div class="sm:grid grid-cols-1 gap-1 mt-5">
            <div class="">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" class="form-control w-full" id="meta_title" name="meta_title" value="{{$mynews->meta_title}}" autocomplete="off"/>
                @error('meta_title')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="sm:grid grid-cols-1 gap-1 mt-5">
            <div class="">
                <label for="meta_keyword" class="form-label">Meta Keyword</label>
                <input type="text" class="form-control w-full" id="meta_keyword" name="meta_keyword" value="{{$mynews->meta_keyword}}" autocomplete="off"/>
                @error('meta_keyword')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="sm:grid grid-cols-1 gap-1 mt-5">
            <div class="">
                <label for="meta_description" class="form-label">Meta Description</label>
                <input type="text" class="form-control w-full" id="meta_description" name="meta_description" value="{{$mynews->meta_description}}" autocomplete="off"/>
                @error('meta_description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-right mt-5">
            <button type="submit" class="btn btn-primary w-24">บันทึก</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector('#content'), {
                    toolbar: {
                        items: [
                            'undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'link',
                            'bulletedList', 'numberedList', '|', 'alignment', '|',
                            'fontColor', 'fontBackgroundColor', '|', 'fontSize', '|',
                            'insertTable', '|', 'mediaEmbed', '|', 'codeBlock', '|',
                            'highlight', '|', 'imageUpload', '|', 'imageTextAlternative',
                            'imageStyle:inline', 'imageStyle:block', 'imageStyle:side', '|',
                            'fullscreen'
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    language: 'en',
                    image: {
                        toolbar: [
                            'imageTextAlternative', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side'
                        ],
                        styles: [
                            'alignLeft', 'alignCenter', 'alignRight'
                        ]
                    }
                })
                .then(editor => {
                    // Custom upload adapter
                    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                        return {
                            upload: function() {
                                return loader.file
                                    .then(file => new Promise((resolve, reject) => {
                                        const formData = new FormData();
                                        formData.append('upload', file);

                                        // Send AJAX request
                                        fetch('{{ route("upload.image") }}', {
                                            method: 'POST',
                                            body: formData,
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            }
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Cannot upload file: ' + file.name);
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            resolve({
                                                default: data.url
                                            });
                                        })
                                        .catch(error => {
                                            reject(error.message);
                                        });
                                    }));
                            },
                            abort: function() {
                                console.log('Upload aborted');
                            }
                        };
                    };
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
