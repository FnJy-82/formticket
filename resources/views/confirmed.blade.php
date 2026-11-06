@extends('layouts.app')

@section('title', 'Book tickets')

@php
    $tickets = config('concert.tickets');
    $max = (int) config('concert.max_per_booking');
    $oldType = old('ticket_type');
    $oldQty = (int) old('quantity', 1);
@endphp

@section('content')
    @if ($errors->any() && ! $errors->hasAny(['full_name', 'email', 'phone', 'birthdate', 'ticket_type', 'quantity']))
        <div class="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('booking.store') }}" id="bookForm" novalidate>
        @csrf

        <p class="section-title">Your details</p>

        <div class="field">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                   placeholder="Enter your full name" autocomplete="name" required
                   class="{{ $errors->has('full_name') ? 'invalid' : '' }}">
            @error('full_name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                   placeholder="Your tickets will be sent here" autocomplete="email" required
                   class="{{ $errors->has('email') ? 'invalid' : '' }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="field">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                       placeholder="08xx xxxx xxxx" autocomplete="tel" required
                       class="{{ $errors->has('phone') ? 'invalid' : '' }}">
                @error('phone') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label for="birthdate">Birthdate</label>
                <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}"
                       max="{{ now()->subDay()->toDateString() }}" min="1930-01-01" required
                       class="{{ $errors->has('birthdate') ? 'invalid' : '' }}">
                @error('birthdate') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <p class="section-title" style="margin-top:8px">Your tickets</p>

        <div class="field">
            <label for="ticket_type">Ticket Category</label>
            <select id="ticket_type" name="ticket_type" required class="{{ $errors->has('ticket_type') ? 'invalid' : '' }}">
                <option value="" data-price="0">Choose a category</option>
                @foreach ($tickets as $key => $t)
                    <option value="{{ $key }}" data-price="{{ $t['price'] }}" @selected($oldType === $key)>
                        {{ $t['label'] }} · {{ \App\Models\TicketBooking::rupiah($t['price']) }}
                    </option>
                @endforeach
            </select>
            <div class="hint" id="ticketDesc">&nbsp;</div>
            @error('ticket_type') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="quantity">Quantity <span style="font-weight:400;color:var(--muted)">(max {{ $max }})</span></label>
            <div class="stepper">
                <button type="button" id="minus" aria-label="Decrease">&minus;</button>
                <input type="text" inputmode="numeric" id="quantity" name="quantity" value="{{ $oldQty }}" readonly>
                <button type="button" id="plus" aria-label="Increase">+</button>
            </div>
            @error('quantity') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="summary">
            <div>
                <div class="lbl">Total price</div>
                <div class="sub" id="sumLine">Select a ticket category</div>
            </div>
            <div class="total" id="total">Rp 0</div>
        </div>

        <button type="submit" class="btn" id="submitBtn">Book My Tickets</button>
    </form>
@endsection

@push('scripts')
<script>
    var descriptions = @json(collect($tickets)->map(fn ($t) => $t['desc']));
    var maxQty = {{ $max }};
    var select = document.getElementById('ticket_type');
    var qtyInput = document.getElementById('quantity');
    var totalEl = document.getElementById('total');
    var sumLine = document.getElementById('sumLine');
    var descEl = document.getElementById('ticketDesc');

    function rupiah(n) { return 'Rp ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'); }

    function update() {
        var opt = select.options[select.selectedIndex];
        var price = parseInt(opt.dataset.price || '0', 10);
        var qty = parseInt(qtyInput.value, 10) || 1;
        totalEl.textContent = rupiah(price * qty);
        sumLine.textContent = price ? qty + ' × ' + opt.text.split(' · ')[0] : 'Select a ticket category';
        descEl.innerHTML = descriptions[select.value] || '&nbsp;';
    }

    document.getElementById('minus').addEventListener('click', function () {
        qtyInput.value = Math.max(1, (parseInt(qtyInput.value, 10) || 1) - 1); update();
    });
    document.getElementById('plus').addEventListener('click', function () {
        qtyInput.value = Math.min(maxQty, (parseInt(qtyInput.value, 10) || 1) + 1); update();
    });
    select.addEventListener('change', update);
    update();

    document.getElementById('bookForm').addEventListener('submit', function () {
        var btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.textContent = 'Sending confirmation email…';
    });
</script>
@endpush
