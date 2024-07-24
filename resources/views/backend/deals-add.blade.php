@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - Create Deal</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Create New Deal</h2>
    </div>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <form method="post" action="{{ route('BN_deals_add_action') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box p-5">
                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control w-full" name="name" value="{{ old('name') }}" autocomplete="off" required/>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="border" class="form-label">Border Color</label>
                                    <input type="color" class="form-control w-full" name="border" value="{{ old('border') }}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="background" class="form-label">Background Color</label>
                                    <input type="color" class="form-control w-full" name="background" value="{{ old('background') }}" required/>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="font1" class="form-label">Font Color 1</label>
                                    <input type="color" class="form-control w-full" name="font1" value="{{ old('font1') }}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="font2" class="form-label">Font Color 2</label>
                                    <input type="color" class="form-control w-full" name="font2" value="{{ old('font2') }}" required/>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="font3" class="form-label">Font Color 3</label>
                                    <input type="color" class="form-control w-full" name="font3" value="{{ old('font3') }}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="image_background" class="form-label">Image Background</label>
                                    <input type="file" class="form-control w-full" name="image_background" />
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="topleft" class="form-label">Top Left Image</label>
                                    <input type="file" class="form-control w-full" name="topleft" />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="bottomright" class="form-label">Bottom Right Image</label>
                                    <input type="file" class="form-control w-full" name="bottomright" />
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="expire" class="form-label">Expiration Date</label>
                                    <input type="date" class="form-control w-full" name="expire" value="{{ old('expire') }}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="bigbrand" class="form-label">Big Brand</label>
                                    <select class="form-control w-full" name="bigbrand" required>
                                        <option value="0" {{ old('bigbrand') == '0' ? 'selected' : '' }}>ไม่</option>
                                        <option value="1" {{ old('bigbrand') == '1' ? 'selected' : '' }}>ใช่</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary w-24">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
<script>
    // Add any custom scripts here
</script>
@endsection
