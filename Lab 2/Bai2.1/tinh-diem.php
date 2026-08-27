<?php

declare(strict_types=1);

const TS_CC = 0.05;
const TS_GK = 0.40;
const TS_CK = 0.55;


// Hàm tính tổng kết
function tinhTongKet(float $cc, float $gk, float $ck): float
{
    return round(
        $cc * TS_CC +
        $gk * TS_GK +
        $ck * TS_CK,
        2
    );
}


// 1 - THU NHẬN
$nhap = [];

foreach (['cc', 'gk', 'ck'] as $khoa) {

    $tho = $_GET[$khoa] ?? null;

    // Chuẩn hóa dấu phẩy thành dấu chấm
    $nhap[$khoa] = is_string($tho)
        ? str_replace(',', '.', $tho)
        : $tho;
}


// 2 - KIỂM TRA
$diem = [];

foreach ($nhap as $khoa => $gt) {

    $kq = filter_var(
        $gt,
        FILTER_VALIDATE_FLOAT,
        [
            "options" => [
                "min_range" => 0,
                "max_range" => 10
            ]
        ]
    );


    // dùng === false vì 0.0 vẫn hợp lệ
    if ($kq === false) {

        http_response_code(422);

        exit(
            "Điểm $khoa phải là số từ 0 đến 10."
        );
    }


    $diem[$khoa] = $kq;
}


// 3 - TÍNH & XUẤT

$tongKet = tinhTongKet(
    $diem['cc'],
    $diem['gk'],
    $diem['ck']
);


echo "<p>Điểm tổng kết: ";

echo htmlspecialchars(
    number_format($tongKet, 2)
);

echo "</p>";