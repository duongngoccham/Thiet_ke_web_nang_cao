<?php

declare(strict_types=1);

require __DIR__ . '/tinh-diem-ham.php';

$lop = [
    ['ten' => 'Nguyễn An', 'cc' => 9.0, 'gk' => 8.0, 'ck' => 8.5],
    ['ten' => 'Trần Bình', 'cc' => 7.0, 'gk' => 6.5, 'ck' => 5.0],
    ['ten' => 'Lê Chi', 'cc' => 10.0, 'gk' => 9.5, 'ck' => 9.0],
    ['ten' => 'Phạm Dũng', 'cc' => 0.0, 'gk' => 4.0, 'ck' => 3.5],
];


// 1. Hàm xếp loại
function xepLoai(float $diem): string
{
    return match (true) {
        $diem >= 8.5 => 'A',
        $diem >= 7.0 => 'B',
        $diem >= 5.5 => 'C',
        $diem >= 4.0 => 'D',
        default => 'F',
    };
}


// 2. Duyệt danh sách, gọi lại tinhTongKet()
$ketQua = [];

foreach ($lop as $sv) {

    $tk = tinhTongKet(
        $sv['cc'],
        $sv['gk'],
        $sv['ck']
    );

    $ketQua[] = $sv + [
        'tongKet' => $tk,
        'loai' => xepLoai($tk)
    ];
}


// 3. Thống kê
$cotTongKet = array_column($ketQua, 'tongKet');

$max = max($cotTongKet);
$min = min($cotTongKet);
$tb = array_sum($cotTongKet) / count($cotTongKet);

$soLuongLoai = array_count_values(
    array_column($ketQua, 'loai')
);

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bảng xếp loại cả lớp</title>

    <style>
        table {
            border-collapse: collapse;
            width: 800px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>

<h2>Bảng xếp loại cả lớp</h2>

<table>

    <tr>
        <th>Tên sinh viên</th>
        <th>CC</th>
        <th>GK</th>
        <th>CK</th>
        <th>Tổng kết</th>
        <th>Loại</th>
    </tr>

    <?php foreach ($ketQua as $sv): ?>

        <tr>
            <td>
                <?= htmlspecialchars($sv['ten']) ?>
            </td>

            <td>
                <?= htmlspecialchars((string)$sv['cc']) ?>
            </td>

            <td>
                <?= htmlspecialchars((string)$sv['gk']) ?>
            </td>

            <td>
                <?= htmlspecialchars((string)$sv['ck']) ?>
            </td>

            <td>
                <?= htmlspecialchars(number_format($sv['tongKet'], 2)) ?>
            </td>

            <td>
                <?= htmlspecialchars($sv['loai']) ?>
            </td>
        </tr>

    <?php endforeach; ?>

</table>


<h2>Thống kê</h2>

<p>
    Cao nhất:
    <?= number_format($max, 2) ?>
</p>

<p>
    Thấp nhất:
    <?= number_format($min, 2) ?>
</p>

<p>
    Trung bình:
    <?= number_format($tb, 2) ?>
</p>

<h3>Số lượng mỗi loại</h3>

<?php foreach ($soLuongLoai as $loai => $soLuong): ?>

    <p>
        Loại <?= htmlspecialchars($loai) ?>:
        <?= $soLuong ?> sinh viên
    </p>

<?php endforeach; ?>

</body>
</html>