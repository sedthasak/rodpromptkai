@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - Edit Deal</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Edit Deal</h2>
    </div>

    <form method="post" action="{{ route('BN_deals_edit_action') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->
        <input type="hidden" name="id" value="{{ $query->id }}">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box p-5">
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Deal Name -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="name" class="form-label">Deal Name</label>
                            <input type="text" id="name" name="name" class="form-control w-full" value="{{ old('name', $query->name) }}" />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Border Color -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="border" class="form-label">Border Color</label>
                            <input type="color" id="border" name="border" class="form-control w-full" value="{{ old('border', $query->border) }}" />
                            @error('border')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Background Color -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="background" class="form-label">Background Color</label>
                            <input type="color" id="background" name="background" class="form-control w-full" value="{{ old('background', $query->background) }}" />
                            @error('background')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Font Colors -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="font1" class="form-label">Font Color 1</label>
                            <input type="color" id="font1" name="font1" class="form-control w-full" value="{{ old('font1', $query->font1) }}" />
                            @error('font1')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="font2" class="form-label">Font Color 2</label>
                            <input type="color" id="font2" name="font2" class="form-control w-full" value="{{ old('font2', $query->font2) }}" />
                            @error('font2')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="font3" class="form-label">Font Color 3</label>
                            <input type="color" id="font3" name="font3" class="form-control w-full" value="{{ old('font3', $query->font3) }}" />
                            @error('font3')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="font4" class="form-label">Font Color 4</label>
                            <input type="color" id="font4" name="font4" class="form-control w-full" value="{{ old('font4', $query->font4) }}" />
                            @error('font4')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Background Image -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="image_background" class="form-label">Background Image</label>
                            <input type="file" id="image_background" name="image_background" class="form-control" />
                            @if($query->image_background)
                                @php
                                    $imagePath = str_replace('public/', '', $query->image_background);
                                @endphp
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Background Image" class="mt-2" style="max-width: 200px;">
                                <div class="mt-2">
                                    <label for="remove_background_image">
                                        <input type="checkbox" name="remove_background_image" id="remove_background_image" value="1">
                                        Remove Background Image
                                    </label>
                                </div>
                            @endif
                            @error('image_background')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Top Left Image -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="topleft" class="form-label">Top Left Image</label>
                            <input type="file" id="topleft" name="topleft" class="form-control" />
                            @if($query->topleft)
                                @php
                                    $topLeftPath = str_replace('public/', '', $query->topleft);
                                @endphp
                                <img src="{{ asset('storage/' . $topLeftPath) }}" alt="Top Left Image" class="mt-2" style="max-width: 200px;">
                                <div class="mt-2">
                                    <label for="remove_topleft_image">
                                        <input type="checkbox" name="remove_topleft_image" id="remove_topleft_image" value="1">
                                        Remove Top Left Image
                                    </label>
                                </div>
                            @endif
                            @error('topleft')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bottom Right Image -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="bottomright" class="form-label">Bottom Right Image</label>
                            <input type="file" id="bottomright" name="bottomright" class="form-control" />
                            @if($query->bottomright)
                                @php
                                    $bottomRightPath = str_replace('public/', '', $query->bottomright);
                                @endphp
                                <img src="{{ asset('storage/' . $bottomRightPath) }}" alt="Bottom Right Image" class="mt-2" style="max-width: 200px;">
                                <div class="mt-2">
                                    <label for="remove_bottomright_image">
                                        <input type="checkbox" name="remove_bottomright_image" id="remove_bottomright_image" value="1">
                                        Remove Bottom Right Image
                                    </label>
                                </div>
                            @endif
                            @error('bottomright')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Expiry Date -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="expire" class="form-label">Expiry Date</label>
                            <input type="date" id="expire" name="expire" class="form-control w-full" value="{{ old('expire', $query->expire ? $query->expire->format('Y-m-d') : '') }}" />
                            @error('expire')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-span-2">
                            <div class="text-right mt-5">
                                <button type="submit" class="btn btn-primary w-24">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
