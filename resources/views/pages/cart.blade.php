@extends('layouts.app')

@section('title', 'Cart | Bizu Agency')

@section('content')
    <section class="page-header section-padding" style="background-color: var(--color-surface);">
        <div class="container text-center">
            <h1 class="mb-sm">Your Cart</h1>
            <p class="text-light">Review your items before checkout.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success mb-lg" style="color: green; background: #e6fffa; padding: 1rem; border-radius: var(--radius-sm);">
                    {{ session('success') }}
                </div>
            @endif

            @if(isset($cart) && count($cart) > 0)
                <div class="grid grid-3 gap-lg" style="grid-template-columns: 2fr 1fr;">
                    <!-- Cart Items -->
                    <div class="card">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 1px solid var(--color-border); text-align: left;">
                                    <th style="padding: 1rem;">Product</th>
                                    <th style="padding: 1rem;">Price</th>
                                    <th style="padding: 1rem;">Quantity</th>
                                    <th style="padding: 1rem;">Subtotal</th>
                                    <th style="padding: 1rem;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity']; @endphp
                                    <tr data-id="{{ $id }}" style="border-bottom: 1px solid var(--color-border);">
                                        <td style="padding: 1rem; display: flex; align-items: center; gap: 1rem;">
                                            @if(isset($details['image']))
                                                <img src="{{ Str::startsWith($details['image'], 'http') ? $details['image'] : asset('storage/' . $details['image']) }}" width="50" height="50" style="border-radius: var(--radius-sm); object-fit: cover;">
                                            @else
                                                <div style="width: 50px; height: 50px; background: #eee; border-radius: var(--radius-sm);"></div>
                                            @endif
                                            <span>{{ $details['name'] }}</span>
                                        </td>
                                        <td style="padding: 1rem;">${{ $details['price'] }}</td>
                                        <td style="padding: 1rem;">
                                            <input type="number" value="{{ $details['quantity'] }}" class="form-input update-cart" min="1" style="width: 60px;">
                                        </td>
                                        <td style="padding: 1rem;" class="subtotal">${{ $details['price'] * $details['quantity'] }}</td>
                                        <td style="padding: 1rem;">
                                            <button type="button" class="btn btn-outline btn-sm remove-from-cart" style="color: red; border-color: red;">×</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary -->
                    <div>
                        <div class="card">
                            <h3 class="mb-md">Order Summary</h3>
                            <div class="flex justify-between mb-sm">
                                <span class="text-light">Subtotal</span>
                                <span class="font-bold cart-subtotal">${{ $total }}</span>
                            </div>
                            <div class="flex justify-between mb-lg">
                                <span class="text-light">Tax (5%)</span>
                                <span class="cart-tax">${{ number_format($tax ?? 0, 2) }}</span>
                            </div>
                            <div class="flex justify-between mb-lg" style="border-top: 1px solid var(--color-border); padding-top: 1rem;">
                                <span class="font-bold text-lg">Total</span>
                                <span class="font-bold text-lg text-primary cart-grand-total">${{ number_format($grandTotal ?? 0, 2) }}</span>
                            </div>
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary" style="width: 100%; text-align: center;">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <p class="mb-lg">Your cart is empty.</p>
                    <a href="{{ url('/products') }}" class="btn btn-primary">Start Shopping</a>
                </div>
            @endif
        </div>
    </section>

    @push('scripts')
    <script type="text/javascript">
        // Update Cart
        document.querySelectorAll('.update-cart').forEach(input => {
            input.addEventListener('change', function() {
                const id = this.closest('tr').getAttribute('data-id');
                const quantity = this.value;
                const tr = this.closest('tr');
                
                fetch('{{ route('cart.update') }}', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id, quantity: quantity })
                })
                .then(response => response.json())
                .then(data => {
                   if(data.success) {
                       tr.querySelector('.subtotal').textContent = '$' + data.subtotal;
                       document.querySelectorAll('.cart-subtotal').forEach(el => el.textContent = '$' + data.total);
                       document.querySelectorAll('.cart-tax').forEach(el => el.textContent = '$' + data.tax);
                       document.querySelectorAll('.cart-grand-total').forEach(el => el.textContent = '$' + data.grandTotal);
                   }
                });
            });
        });

        // Remove from Cart
        document.querySelectorAll('.remove-from-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                
                const tr = this.closest('tr');
                const id = tr.getAttribute('data-id');
                
                fetch('{{ route('cart.remove') }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>
    @endpush
@endsection
