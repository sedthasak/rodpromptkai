@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - Create Deal</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Create New Deal</h2>
    </div>

    <form method="post" action="{{ route('BN_deals_add_action') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box p-5">
                    <div class="p-5">
                        <!-- Deal Name -->
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="name" class="form-label">Deal Name</label>
                                    <input type="text" id="name" name="name" class="form-control w-full" value="{{ old('name') }}" />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Border Color -->
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="border" class="form-label">Border Color</label>
                                    <input type="color" id="border" name="border" class="form-control w-full" value="{{ old('border') }}" />
                                    @error('border')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Background Color -->
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="background" class="form-label">Background Color</label>
                                    <input type="color" id="background" name="background" class="form-control w-full" value="{{ old('background') }}" />
                                    @error('background')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Font Color 1 -->
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="font1" class="form-label">Font Color 1</label>
                                    <input type="color" id="font1" name="font1" class="form-control w-full" value="{{ old('font1') }}" />
                                    @error('font1')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Font Colors 2 & 3 -->
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="font2" class="form-label">Font Color 2</label>
                                    <input type="color" id="font2" name="font2" class="form-control w-full" value="{{ old('font2') }}" />
                                    @error('font2')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="font3" class="form-label">Font Color 3</label>
                                    <input type="color" id="font3" name="font3" class="form-control w-full" value="{{ old('font3') }}" />
                                    @error('font3')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Font Color 4 -->
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="font4" class="form-label">Font Color 4</label>
                                    <input type="color" id="font4" name="font4" class="form-control w-full" value="{{ old('font4') }}" />
                                    @error('font4')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Image Background -->
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="image_background" class="form-label">Background Image</label>
                                    <input type="file" id="image_background" name="image_background" class="form-control" />
                                    @error('image_background')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>

                        
                        <div class="grid grid-cols-12 gap-6">
                            <!-- Top Left Image -->
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="topleft" class="form-label">Top Left Image</label>
                                    <input type="file" id="topleft" name="topleft" class="form-control" />
                                    @error('topleft')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Select for Top Left Position -->
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="topleft_position" class="form-label">Top Left Position</label>
                                    <select id="topleft_position" name="topleft_position" class="form-control w-full">
                                        <option value="1" {{ old('topleft_position', 1) == 1 ? 'selected' : '' }}>Aligned Top (default)</option>
                                        <option value="2" {{ old('topleft_position') == 2 ? 'selected' : '' }}>Aligned Left</option>
                                        <option value="3" {{ old('topleft_position') == 3 ? 'selected' : '' }}>Aligned Top Left</option>
                                        <option value="4" {{ old('topleft_position') == 4 ? 'selected' : '' }}>Aligned Left 2</option>
                                    </select>
                                    @error('topleft_position')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Right Image -->
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="bottomright" class="form-label">Bottom Right Image</label>
                                    <input type="file" id="bottomright" name="bottomright" class="form-control" />
                                    @error('bottomright')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Expiry Date -->
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="expire" class="form-label">Expiry Date</label>
                                    <input type="date" id="expire" name="expire" class="form-control w-full" value="{{ old('expire') }}" />
                                    @error('expire')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-right mt-5">
                            <button type="submit" class="btn btn-primary w-24">Save</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
