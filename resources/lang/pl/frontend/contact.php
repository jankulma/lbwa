<?php

$content = file_get_contents(base_path('storage/app/public/cms/pl/contact/content.html'));
$address = file_get_contents(base_path('storage/app/public/cms/pl/contact/address.html'));

return [
    'content' => $content,
    'address' => $address
];
