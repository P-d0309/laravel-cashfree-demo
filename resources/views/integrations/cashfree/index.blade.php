<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            CashFree Links
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    @if(session()->has('message.content'))
                    @php
                        $level = session()->get('message.level') == 'success' ? 'alert-success' : 'alert-dager';
                    @endphp
                    <div class="alert {{ $level }} shadow-lg">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session()->get('message.content') }}</span>
                        </div>
                    </div>
                    @endif
                    <h2 class="card-title">CashFree Created Links</h2>
                    <div class="card-actions justify-end">
                        <a href="{{ route('cashfree-links.create') }}" class="btn btn-primary">Create a new Link</a>
                    </div>
                    <div>
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Job</th>
                                        <th>Favorite Color</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- row 1 -->
                                    <tr>
                                        <th>1</th>
                                        <td>Cy Ganderton</td>
                                        <td>Quality Control Specialist</td>
                                        <td>Blue</td>
                                    </tr>
                                    <!-- row 2 -->
                                    <tr class="active">
                                        <th>2</th>
                                        <td>Hart Hagerty</td>
                                        <td>Desktop Support Technician</td>
                                        <td>Purple</td>
                                    </tr>
                                    <!-- row 3 -->
                                    <tr>
                                        <th>3</th>
                                        <td>Brice Swyre</td>
                                        <td>Tax Accountant</td>
                                        <td>Red</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-actions justify-end">
                        <a href="{{ route('cashfree-links.create') }}" class="btn btn-primary">Create a new Link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>