<?php

$content = file_get_contents(base_path('storage/app/public/cms/en/contact/content.html'));
$address = file_get_contents(base_path('storage/app/public/cms/en/contact/address.html'));

return [
    'content' => $content,
    'address' => $address
];
