<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('product', function ($user) {
    return true;
});
