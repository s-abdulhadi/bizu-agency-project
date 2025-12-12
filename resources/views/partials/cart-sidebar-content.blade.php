@if(isset($addedSuccess) && $addedSuccess)
    <div
        style="background-color: #d1e7dd; color: #0f5132; padding: 12px; border-radius: var(--radius-sm); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem; font-size: 0.95rem; border: 1px solid #badbcc;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <strong>Success!</strong> Item added to cart.
    </div>
@endif
@if(session('cart'))
    @foreach(session('cart') as $id => $details)
        <div class="cart-sidebar-item">
            <div class="cart-sidebar-image">
                <img src="{{ Str::startsWith($details['image'], 'http') ? $details['image'] : asset('storage/' . $details['image']) }}"
                    alt="{{ $details['name'] }}">
            </div>
            <div class="cart-sidebar-details">
                <h4>{{ $details['name'] }}</h4>
                <p>{{ $details['quantity'] }} x ${{ $details['price'] }}</p>
                <button class="btn-remove-item" data-id="{{ $id }}">Remove</button>
            </div>
        </div>
    @endforeach
    <div class="cart-sidebar-footer">
        <div class="cart-total">
            <strong>Total:
                ${{ array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity']; }, session('cart'))) }}</strong>
        </div>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block">Checkout</a>
        <a href="{{ route('cart.index') }}" class="btn btn-secondary btn-block">View Cart</a>
    </div>
@else
    <p class="text-center">Your cart is empty.</p>
@endif