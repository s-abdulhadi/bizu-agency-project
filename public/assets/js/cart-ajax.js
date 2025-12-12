
document.addEventListener('DOMContentLoaded', () => {
    initSlidingCart();
});

function initSlidingCart() {
    const cartSidebar = document.getElementById('cart-sidebar');
    const closeBtn = document.getElementById('close-cart-sidebar');
    const overlay = document.getElementById('cart-overlay');
    const cartBody = document.getElementById('cart-sidebar-body');

    // Open/Close functions
    window.openCart = () => {
        cartSidebar.classList.add('open');
        overlay.classList.add('open');
    };

    window.closeCart = () => {
        cartSidebar.classList.remove('open');
        overlay.classList.remove('open');
    };

    if (closeBtn) closeBtn.addEventListener('click', window.closeCart);
    if (overlay) overlay.addEventListener('click', window.closeCart);

    // Add to Cart Interception
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const actionUrl = this.action;
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerText;

            submitBtn.disabled = true;
            submitBtn.innerText = 'Adding...';

            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update Cart Sidebar Content
                    if (data.html) {
                        cartBody.innerHTML = data.html;
                    }
                    
                    // Update Badge
                    const badges = document.querySelectorAll('.cart-badge');
                    badges.forEach(b => {
                        b.innerText = data.totalItems;
                        b.style.display = data.totalItems > 0 ? 'block' : 'none';
                    });

                    // Open Sidebar
                    window.openCart();
                } else {
                    alert('Error adding to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerText = originalText;
            });
        });
    });
    
    // Remove Item from Sidebar (Event Delegation)
    cartBody.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove-item')) {
            e.preventDefault();
            const id = e.target.getAttribute('data-id');
            removeCartItem(id);
        }
    });

    function removeCartItem(id) {
        fetch('/cart/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value // Fallback or meta
            },
            body: JSON.stringify({ id: id, _token: document.querySelector('input[name="_token"]').value })
        })
        .then(response => response.json())
        .then(data => {
             if (data.success) {
                  // Reload sidebar content? 
                  // Ideally server returns HTML again. 
                  // For now, let's just reload the page or fetch updated cart.
                  // BETTER: standard remove returns total, but not HTML. 
                  // Let's reload to keep it simple or implement a separate "get cart html" endpoint.
                  // For "Quick Fix" speed, I'll modify the remove method to ALSO return HTML.
                  if (data.html) {
                      cartBody.innerHTML = data.html;
                  }
                  
                   // Update Badge
                    const badges = document.querySelectorAll('.cart-badge');
                    badges.forEach(b => {
                        b.innerText = data.totalItems; // Ensure remove returns this
                        b.style.display = data.totalItems > 0 ? 'block' : 'none';
                    });
             }
        })
        .catch(error => console.error('Error:', error));
    }
}
