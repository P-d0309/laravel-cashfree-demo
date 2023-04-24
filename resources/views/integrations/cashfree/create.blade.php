<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create a new CashFree Link
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-xl">
                {!! Form::open(['url' => route('cashfree-links.store')]) !!}
                <div class="card-body">
                    <div class="grid grid-cols-2">
                        <div class="form-control w-full p-4">
                            <label class="label">
                                <span class="label-text">Customer Name or Description:</span>
                            </label>
                            <input type="text" placeholder="Type here" class="input input-bordered w-full" name="link_purpose" id="link_purpose" value="{{ old('link_purpose') }}"/>

                            @error('link_purpose')
                                <label class="label">
                                    <span class="label-text-alt text-red-500">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control w-full p-4">
                            <label class="label">
                                <span class="label-text">Amount To Receive:</span>
                            </label>
                            <input type="number" placeholder="Type here" class="input input-bordered w-full"
                                name="link_amount" id="link_amount" value="{{ old('link_amount') }}"/>

                            @error('link_amount')
                                <label class="label">
                                    <span class="label-text-alt text-red-500">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control w-full p-4">
                            <label class="label">
                                <span class="label-text">Phone Number:</span>
                            </label>
                            <input type="number" placeholder="Type here" class="input input-bordered w-full"
                                name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}"/>

                            @error('customer_phone')
                                <label class="label">
                                    <span class="label-text-alt text-red-500">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control w-full p-4">
                            <label class="label">
                                <span class="label-text">Email:</span>
                            </label>
                            <input type="email" placeholder="Type here" class="input input-bordered w-full"
                                name="customer_email" id="customer_email" value="{{ old('customer_email') }}"/>

                            @error('customer_email')
                                <label class="label">
                                    <span class="label-text-alt text-red-500">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                        <div class="form-control w-full p-4">
                            <label class="cursor-pointer label">
                                <span class="label-text">Send UPI Link</span>
                                <input type="checkbox" class="checkbox checkbox-success" name="is_upi" id="is_upi" @checked(old('is_upi'))/>
                            </label>
                        </div>
                    </div>
                    <div class="card-actions justify-end">
                        <button type="submit" class="btn btn-primary">Create a new Link</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</x-app-layout>