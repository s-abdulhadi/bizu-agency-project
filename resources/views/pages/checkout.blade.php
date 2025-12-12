@extends('layouts.app')

@section('title', 'Checkout | Bizu Agency')

@section('content')
    <section class="page-header section-padding" style="background-color: var(--color-surface);">
        <div class="container text-center">
            <h1 class="mb-sm">Checkout</h1>
            <p class="text-light">Securely process your payment.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container grid grid-2 gap-lg" style="grid-template-columns: 2fr 1fr;">
            <!-- Checkout Form -->
            <div>
                <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                    @csrf

                    @if(session('error'))
                        <div class="alert alert-error mb-lg"
                            style="color: red; background: #fff5f5; padding: 1rem; border-radius: var(--radius-sm); border-left: 4px solid red;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Billing Details -->
                    <div class="card mb-lg" style="border: 1px solid var(--color-border); padding: 2rem;">
                        <h3 class="mb-lg" style="border-bottom: 2px solid var(--color-surface); padding-bottom: 0.5rem;">
                            Billing Details</h3>
                        <div class="grid grid-2 gap-md mb-md">
                            <div class="form-group">
                                <label class="form-label font-bold text-sm mb-xs block">First Name</label>
                                <input type="text" name="first_name" class="form-input w-full"
                                    style="padding: 0.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm);"
                                    required value="{{ old('first_name') }}" placeholder="John">
                                @error('first_name') <span class="text-error mt-xs block"
                                style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label font-bold text-sm mb-xs block">Last Name</label>
                                <input type="text" name="last_name" class="form-input w-full"
                                    style="padding: 0.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm);"
                                    required value="{{ old('last_name') }}" placeholder="Doe">
                                @error('last_name') <span class="text-error mt-xs block"
                                style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-md">
                            <label class="form-label font-bold text-sm mb-xs block">Email Address</label>
                            <input type="email" name="email" class="form-input w-full"
                                style="padding: 0.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm);"
                                required value="{{ old('email') }}" placeholder="john@example.com">
                            @error('email') <span class="text-error mt-xs block"
                            style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-md">
                            <label class="form-label font-bold text-sm mb-xs block">Address</label>
                            <input type="text" name="address" class="form-input w-full"
                                style="padding: 0.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm);"
                                required value="{{ old('address') }}" placeholder="123 Main St">
                            @error('address') <span class="text-error mt-xs block"
                            style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-2 gap-md">
                            <div class="form-group">
                                <label class="form-label font-bold text-sm mb-xs block">City</label>
                                <input type="text" name="city" class="form-input w-full"
                                    style="padding: 0.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm);"
                                    required value="{{ old('city') }}" placeholder="New York">
                                @error('city') <span class="text-error mt-xs block"
                                style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label font-bold text-sm mb-xs block">ZIP Code</label>
                                <input type="text" name="zip" class="form-input w-full"
                                    style="padding: 0.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm);"
                                    required value="{{ old('zip') }}" placeholder="10001">
                                @error('zip') <span class="text-error mt-xs block"
                                style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card mb-lg" style="border: 1px solid var(--color-border); padding: 2rem;">
                        <h3 class="mb-lg" style="border-bottom: 2px solid var(--color-surface); padding-bottom: 0.5rem;">
                            Payment</h3>
                        <div class="form-group mb-sm p-md"
                            style="border: 1px solid var(--color-primary); border-radius: var(--radius-sm); background: #fdfdfd;">
                            <label class="flex items-center gap-sm cursor-pointer">
                                <input type="radio" name="payment_method" value="card" checked
                                    style="accent-color: var(--color-primary);">
                                <span class="font-bold">Credit Card (Stripe)</span>
                            </label>
                        </div>
                        <div class="form-group p-md"
                            style="border: 1px solid var(--color-border); border-radius: var(--radius-sm);">
                            <label class="flex items-center gap-sm cursor-pointer">
                                <input type="radio" name="payment_method" value="paypal"
                                    style="accent-color: var(--color-primary);">
                                <span>PayPal</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; padding: 1rem; font-size: 1.1rem; border-radius: var(--radius-sm);">Place
                        Order</button>
                </form>
            </div>

            <!-- Order Summary Sidebar -->
            <div>
                <div class="card">
                    <h3 class="mb-md">Your Order</h3>
                    <table style="width: 100%; font-size: 0.9rem;">
                        <tbody>
                            @php $total = 0; @endphp
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity']; @endphp
                                    <tr style="border-bottom: 1px solid var(--color-border);">
                                        <td style="padding: 0.5rem 0;">
                                            <div>{{ $details['name'] }}</div>
                                            <div class="text-light">x {{ $details['quantity'] }}</div>
                                        </td>
                                        <td style="text-align: right; padding: 0.5rem 0;">
                                            ${{ $details['price'] * $details['quantity'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr style="border-top: 1px solid var(--color-border);">
                                <td style="padding-top: 1rem;">Subtotal</td>
                                <td style="padding-top: 1rem; text-align: right;">${{ number_format($subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.5rem 0;">Tax (5%)</td>
                                <td style="text-align: right; padding: 0.5rem 0;">${{ number_format($tax, 2) }}</td>
                            </tr>
                            <tr style="border-top: 2px solid var(--color-border);">
                                <td style="padding-top: 1rem; font-weight: bold; font-size: 1.2rem;">Total</td>
                                <td
                                    style="padding-top: 1rem; font-weight: bold; text-align: right; color: var(--color-primary); font-size: 1.2rem;">
                                    ${{ number_format($grandTotal, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- Promo Code -->
                    <div class="mt-lg pt-lg" style="border-top: 1px dashed var(--color-border);">
                        <label class="form-label font-bold text-sm mb-xs block text-light">Have a promo code?</label>
                        <div class="flex gap-sm">
                            <input type="text" placeholder="Promo Code" class="form-input flex-grow-1"
                                style="padding: 0.5rem;">
                            <button type="button" class="btn btn-outline btn-sm">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection