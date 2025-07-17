@extends('layouts.app')

@section('title', 'Point of Sale - School POS System')

@section('content')
<div class="row">
    <!-- Products Section -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-box"></i> Products</h5>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control" id="productSearch" placeholder="Search products..." style="width: 300px;">
                    <select class="form-select" id="categoryFilter" style="width: 200px;">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body">
                <!-- Category Tabs -->
                <ul class="nav nav-tabs mb-3" id="categoryTabs">
                    <li class="nav-item">
                        <button class="nav-link active" data-category="all">All Products</button>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <button class="nav-link" data-category="{{ $category->id }}" style="color: {{ $category->color }}">
                                {{ $category->name }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <!-- Products Grid -->
                <div class="row" id="productsGrid">
                    @foreach($products as $product)
                        <div class="col-md-3 col-sm-4 col-6 mb-3 product-item" data-category="{{ $product->category_id }}">
                            <div class="card product-card h-100 {{ $product->stock_quantity <= 0 ? 'out-of-stock' : '' }}" 
                                 data-product-id="{{ $product->id }}" 
                                 data-product-name="{{ $product->name }}"
                                 data-product-price="{{ $product->price }}"
                                 data-product-stock="{{ $product->stock_quantity }}">
                                <div class="card-body text-center p-2">
                                    <div class="mb-2">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 60px;">
                                        @else
                                            <i class="fas fa-box fa-2x text-muted"></i>
                                        @endif
                                    </div>
                                    <h6 class="card-title mb-1" style="font-size: 0.9rem;">{{ $product->name }}</h6>
                                    <p class="text-primary fw-bold mb-1">${{ number_format($product->price, 2) }}</p>
                                    <small class="text-muted">{{ $product->sku }}</small>
                                    @if($product->stock_quantity <= $product->min_stock_level)
                                        <div class="mt-1">
                                            <small class="low-stock">
                                                <i class="fas fa-exclamation-triangle"></i> 
                                                Stock: {{ $product->stock_quantity }}
                                            </small>
                                        </div>
                                    @endif
                                    @if($product->stock_quantity <= 0)
                                        <div class="mt-1">
                                            <small class="text-danger">Out of Stock</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Cart & Checkout Section -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Cart</h5>
            </div>
            <div class="card-body">
                <!-- Customer Selection -->
                <div class="mb-3">
                    <label class="form-label">Customer</label>
                    <select class="form-select" id="customerSelect">
                        <option value="">Walk-in Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" data-balance="{{ $customer->balance }}">
                                {{ $customer->name }} 
                                @if($customer->student_id)
                                    ({{ $customer->student_id }})
                                @endif
                                @if($customer->balance > 0)
                                    - Balance: ${{ number_format($customer->balance, 2) }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Cart Items -->
                <div class="cart-items mb-3" id="cartItems" style="max-height: 300px; overflow-y: auto;">
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                        <p>Cart is empty</p>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span id="subtotal">$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax (10%):</span>
                        <span id="tax">$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 fw-bold fs-5">
                        <span>Total:</span>
                        <span id="total">$0.00</span>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select class="form-select" id="paymentMethod">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="account">Account Balance</option>
                        </select>
                    </div>

                    <!-- Payment Amount -->
                    <div class="mb-3" id="paymentAmountDiv">
                        <label class="form-label">Amount Paid</label>
                        <input type="number" class="form-control" id="paidAmount" step="0.01" min="0">
                        <div class="mt-2">
                            <small class="text-muted">Change: <span id="change">$0.00</span></small>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-success btn-lg" id="checkoutBtn" disabled>
                            <i class="fas fa-credit-card"></i> Checkout
                        </button>
                        <button class="btn btn-outline-secondary" id="clearCartBtn">
                            <i class="fas fa-trash"></i> Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let cart = [];
    let taxRate = 0.10;

    // Product search
    $('#productSearch').on('keyup', function() {
        let searchTerm = $(this).val().toLowerCase();
        $('.product-item').each(function() {
            let productName = $(this).find('.card-title').text().toLowerCase();
            let productSku = $(this).find('.text-muted').text().toLowerCase();
            
            if (productName.includes(searchTerm) || productSku.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Category filter
    $('.nav-link[data-category]').on('click', function() {
        $('.nav-link[data-category]').removeClass('active');
        $(this).addClass('active');
        
        let categoryId = $(this).data('category');
        
        if (categoryId === 'all') {
            $('.product-item').show();
        } else {
            $('.product-item').hide();
            $('.product-item[data-category="' + categoryId + '"]').show();
        }
    });

    // Add to cart
    $(document).on('click', '.product-card', function() {
        if ($(this).hasClass('out-of-stock')) return;
        
        let productId = $(this).data('product-id');
        let productName = $(this).data('product-name');
        let productPrice = parseFloat($(this).data('product-price'));
        let productStock = parseInt($(this).data('product-stock'));
        
        let existingItem = cart.find(item => item.id === productId);
        
        if (existingItem) {
            if (existingItem.quantity < productStock) {
                existingItem.quantity++;
            } else {
                alert('Insufficient stock!');
                return;
            }
        } else {
            cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: 1,
                stock: productStock
            });
        }
        
        updateCartDisplay();
    });

    // Update quantity
    $(document).on('change', '.quantity-input', function() {
        let productId = parseInt($(this).data('product-id'));
        let newQuantity = parseInt($(this).val());
        let item = cart.find(item => item.id === productId);
        
        if (item) {
            if (newQuantity <= 0) {
                cart = cart.filter(item => item.id !== productId);
            } else if (newQuantity <= item.stock) {
                item.quantity = newQuantity;
            } else {
                alert('Insufficient stock!');
                $(this).val(item.quantity);
                return;
            }
        }
        
        updateCartDisplay();
    });

    // Remove from cart
    $(document).on('click', '.remove-item', function() {
        let productId = parseInt($(this).data('product-id'));
        cart = cart.filter(item => item.id !== productId);
        updateCartDisplay();
    });

    // Clear cart
    $('#clearCartBtn').on('click', function() {
        cart = [];
        updateCartDisplay();
    });

    // Payment method change
    $('#paymentMethod').on('change', function() {
        let method = $(this).val();
        if (method === 'account') {
            $('#paymentAmountDiv').hide();
            $('#paidAmount').val($('#total').text().replace('$', ''));
        } else {
            $('#paymentAmountDiv').show();
        }
        updateChange();
    });

    // Payment amount change
    $('#paidAmount').on('input', function() {
        updateChange();
    });

    // Checkout
    $('#checkoutBtn').on('click', function() {
        if (cart.length === 0) {
            alert('Cart is empty!');
            return;
        }

        let customerId = $('#customerSelect').val() || null;
        let paymentMethod = $('#paymentMethod').val();
        let paidAmount = parseFloat($('#paidAmount').val()) || 0;
        let totalAmount = parseFloat($('#total').text().replace('$', ''));

        if (paymentMethod !== 'account' && paidAmount < totalAmount) {
            alert('Insufficient payment amount!');
            return;
        }

        if (paymentMethod === 'account' && customerId) {
            let customerBalance = parseFloat($('#customerSelect option:selected').data('balance')) || 0;
            if (customerBalance < totalAmount) {
                alert('Insufficient account balance!');
                return;
            }
        }

        let saleData = {
            customer_id: customerId,
            items: cart.map(item => ({
                product_id: item.id,
                quantity: item.quantity
            })),
            payment_method: paymentMethod,
            paid_amount: paidAmount,
            notes: ''
        };

        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

        $.ajax({
            url: '{{ route("pos.process-sale") }}',
            method: 'POST',
            data: saleData,
            success: function(response) {
                if (response.success) {
                    alert('Sale processed successfully!');
                    window.open(response.receipt_url, '_blank');
                    cart = [];
                    updateCartDisplay();
                    $('#customerSelect').val('');
                    $('#paymentMethod').val('cash');
                    $('#paidAmount').val('');
                    $('#paymentAmountDiv').show();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                let errorMessage = 'An error occurred';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                alert('Error: ' + errorMessage);
            },
            complete: function() {
                $('#checkoutBtn').prop('disabled', false).html('<i class="fas fa-credit-card"></i> Checkout');
            }
        });
    });

    function updateCartDisplay() {
        let cartHtml = '';
        let subtotal = 0;

        if (cart.length === 0) {
            cartHtml = `
                <div class="text-center text-muted py-4">
                    <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                    <p>Cart is empty</p>
                </div>
            `;
        } else {
            cart.forEach(item => {
                let itemTotal = item.price * item.quantity;
                subtotal += itemTotal;
                
                cartHtml += `
                    <div class="cart-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">${item.name}</h6>
                                <small class="text-muted">$${item.price.toFixed(2)} each</small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <input type="number" class="form-control form-control-sm quantity-input" 
                                       style="width: 60px;" value="${item.quantity}" min="1" max="${item.stock}"
                                       data-product-id="${item.id}">
                                <button class="btn btn-sm btn-outline-danger remove-item" data-product-id="${item.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-end mt-1">
                            <strong>$${itemTotal.toFixed(2)}</strong>
                        </div>
                    </div>
                `;
            });
        }

        $('#cartItems').html(cartHtml);
        
        let tax = subtotal * taxRate;
        let total = subtotal + tax;

        $('#subtotal').text('$' + subtotal.toFixed(2));
        $('#tax').text('$' + tax.toFixed(2));
        $('#total').text('$' + total.toFixed(2));
        
        $('#paidAmount').val(total.toFixed(2));
        updateChange();
        
        $('#checkoutBtn').prop('disabled', cart.length === 0);
    }

    function updateChange() {
        let total = parseFloat($('#total').text().replace('$', ''));
        let paid = parseFloat($('#paidAmount').val()) || 0;
        let change = paid - total;
        
        $('#change').text('$' + Math.max(0, change).toFixed(2));
    }

    // Initialize
    updateCartDisplay();
});
</script>
@endpush