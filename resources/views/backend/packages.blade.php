@extends('backend.layout.side-menu')

@section('subhead')
    <title>Backend - Packages</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-5 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Packages</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <!-- Add any additional buttons or links here -->
        </div>
    </div>

    <!-- Dealer Packages -->
    <div class="intro-y mt-5">
        <h2 class="text-lg font-medium">Dealer Packages</h2>
        <div class="overflow-auto lg:overflow-visible mt-5">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Package Name</th>
                        <th>Price</th>
                        <th>Limit</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packageDealers as $key => $package)
                        <tr class="intro-x">
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $package->name }}</td>
                            <td>{{ $package->price }}</td>
                            <td>{{ $package->limit }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a href="{{ route('BN_packages_detail_dealer', ['id' => $package->id]) }}" class="flex items-center text-success mr-3">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> View Details
                                    </a>
                                    <a href="{{ route('BN_packages_edit', ['type' => 'dealer', 'id' => $package->id]) }}" class="flex items-center">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No dealer packages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: Dealer Packages -->

    <!-- VIP Packages -->
    <div class="intro-y mt-10">
        <h2 class="text-lg font-medium">VIP Packages</h2>
        <div class="overflow-auto lg:overflow-visible mt-5">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Package Name</th>
                        <th>Price</th>
                        <th>Limit</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vipPackages as $key => $package)
                        <tr class="intro-x">
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $package->name }}</td>
                            <td>{{ $package->price }}</td>
                            <td>{{ $package->limit }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a href="{{ route('BN_packages_detail_vip', ['id' => $package->id]) }}" class="flex items-center text-success mr-3">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> View Details
                                    </a>
                                    <a href="{{ route('BN_packages_edit', ['type' => 'vip', 'id' => $package->id]) }}" class="flex items-center">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No VIP packages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: VIP Packages -->
@endsection

@section('script')
    <!-- Additional scripts can be added here if necessary -->
@endsection
