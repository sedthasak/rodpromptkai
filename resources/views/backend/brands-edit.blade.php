@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_brands')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >ย้อนกลับ</a>    
        </div>
    </div>
    <form method="post" action="{{route('BN_brands_edit_action')}}" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" name="id" value="{{$brands->id}}" />
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <div class="sm:grid grid-cols-1 gap-1">
                            <div>
                                <label for="title" class="form-label">ชื่อยี่ห้อ</label>
                                <input type="text" class="form-control w-full" name="title" autocomplete="off" value="{{$brands->title}}" />
                            </div>
                        </div>
                        
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div>
                                <label for="feature" class="form-label">โลโก้</label>
                                <input type="file" class="form-control w-full" id="feature" name="feature" autocomplete="off" />
                            </div>
                        </div>
                        @if(isset($brands->feature))
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div>
                                <label for="current_logo" class="form-label">โลโก้ปัจจุบัน</label>
                                <image width="150" src="{{asset($brands->feature)}}">
                            </div>
                        </div>
                        @endif
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div>
                                <label for="excerpt" class="form-label">คำโปรย</label>
                                <input type="text" class="form-control w-full" id="excerpt" name="excerpt" autocomplete="off" value="{{$brands->excerpt}}" />
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div>
                                <label for="content" class="form-label">ข่าว</label>
                                <textarea class="form-control" id="content" rows="5" name="content">{{$brands->content}}</textarea>
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div>
                                <label for="meta_title" class="form-label">meta_title</label>
                                <input type="text" class="form-control w-full" id="meta_title" name="meta_title" value="{{$brands->meta_title}}"  autocomplete="off" />
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div>
                                <label for="meta_keyword" class="form-label">meta_keyword</label>
                                <input type="text" class="form-control w-full" id="meta_keyword" name="meta_keyword" value="{{$brands->meta_keyword}}"  autocomplete="off" />
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div>
                                <label for="meta_description" class="form-label">meta_description</label>
                                <input type="text" class="form-control w-full" id="meta_description" name="meta_description" value="{{$brands->meta_description}}"  autocomplete="off" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <div class="btn-delete-brand btn btn-danger mr-auto w-24" onclick="confirmDelete({{ $brands->id }})">ลบ</div>
                        <button type="submit" class="btn btn-primary w-24 mr-2">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'ยืนยัน?',
            text: 'ยืนยันการลบยี่ห้อรถนี้ใช่ไหม !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง !',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/backend/car/brands-delete/' + id;
            }
        });
    }

    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                    '|', 'fontColor', 'fontBackgroundColor', 'fontSize', '|', 'insertTable', '|', 'mediaEmbed', '|',
                    'imageUpload', '|', 'fullscreen'
                ],
                shouldNotGroupWhenFull: true
            },
            image: {
                toolbar: ['imageTextAlternative', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side'],
                styles: ['alignLeft', 'alignCenter', 'alignRight']
            },
            fileTools: {
                uploadUrl: '{{ route("upload.image") }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        })
        .then(editor => {
            console.log('Editor initialized', editor);
            editor.model.document.on('change:data', () => {
                document.getElementById('content').value = editor.getData();
            });

            editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                return {
                    upload: function() {
                        return loader.file
                            .then(file => new Promise((resolve, reject) => {
                                const formData = new FormData();
                                formData.append('upload', file);

                                fetch('{{ route("upload.image") }}', {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => resolve({ default: data.url }))
                                .catch(error => reject(error.message));
                            }));
                    },
                    abort: function() {
                        console.log('Upload aborted');
                    }
                };
            };
        })
        .catch(error => console.error(error));
</script>
@endsection
