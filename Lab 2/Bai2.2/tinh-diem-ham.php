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