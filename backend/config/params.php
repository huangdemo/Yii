<?php
return [
    'adminEmail' => 'admin@example.com',
    'upload_path'=> '',
    'test_upload' => [
        'extensions' => ['jpg', 'png', 'jpeg', 'jpe', 'pdf'],
        'mime_types' => ['image/*', 'application/pdf'],
        'max_size' => 10 * 1024 * 1024,
        'min_size' => 1,
//        'message' => '上传失败',
    ]
];
