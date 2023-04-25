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
                                        <th>Phone</th>
                                        <th>Description</th>
                                        <th>Link ID</th>
                                        <th>Transaction ID</th>
                                        <th>Order ID</th>
                                        <th>Amount</th>
                                        <th>CF Link ID</th>
                                        <th>Status</th>
                                        <th>Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cashFreeLinks as $cashFreeLink)
                                        <tr  @class(['text-blue-500' => $cashFreeLink->link_status === "ACTIVE", 'text-green-500' => $cashFreeLink->link_status === "PAID"])>
                                            <td>{{ $cashFreeLink->customer_phone }}</td>
                                            <td>{{ $cashFreeLink->link_purpose }}</td>
                                            <td>{{ $cashFreeLink->link_id }}</td>
                                            <td>{{ $cashFreeLink->transaction_id }}</td>
                                            <td>{{ $cashFreeLink->order_id }}</td>
                                            <td>{{ $cashFreeLink->link_amount }}</td>
                                            <td>{{ $cashFreeLink->cf_link_id }}</td>
                                            <td>{{ $cashFreeLink->link_status }}</td>
                                            <td>{{ $cashFreeLink->link_url }}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $cashFreeLinks->links() }}
                    <div class="card-actions justify-end">
                        <a href="{{ route('cashfree-links.create') }}" class="btn btn-primary">Create a new Link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>