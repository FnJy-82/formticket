<?php

/*
|--------------------------------------------------------------------------
| Concert settings
|--------------------------------------------------------------------------
| Edit this one file to change the event name, date, venue and ticket
| prices. The form, the email and the confirm page all read from here.
| After editing on the server, run: php artisan config:clear
*/

return [
    'name' => 'Neon Horizon Live',
    'tagline' => 'World Tour 2027 · Surabaya',
    'date_label' => 'Saturday, 20 March 2027',
    'time_label' => 'Doors 18:00 · Show 19:30 WIB',
    'venue' => 'Skyline Arena, Surabaya',

    // Max tickets one booking can hold.
    'max_per_booking' => 4,

    // Days the person has to click the confirm button in the email.
    'hold_days' => 7,

    // key => label, price (IDR), short description
    'tickets' => [
        'festival' => [
            'label' => 'Festival (Standing)',
            'price' => 350000,
            'desc' => 'General standing area',
        ],
        'cat1' => [
            'label' => 'Category 1 (Seated)',
            'price' => 550000,
            'desc' => 'Reserved seat, lower tier',
        ],
        'vip' => [
            'label' => 'VIP',
            'price' => 850000,
            'desc' => 'Front zone + merch gift',
        ],
        'vvip' => [
            'label' => 'VVIP Meet & Greet',
            'price' => 1500000,
            'desc' => 'Premium zone + meet & greet',
        ],
    ],
];
