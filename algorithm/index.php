<?php

function miniMaxSum($arr) {
    if (!empty($arr)) {
        // Sắp xếp mảng để có thể tính toán dễ dàng
        sort($arr);
        
        // Tính tổng của mảng
        $totalSum = array_sum($arr);

        // Tính tổng tối thiểu bằng cách loại bỏ phần tử lớn nhất
        $minSum = $totalSum - $arr[count($arr) - 1];
        
        // Tính tổng tối đa bằng cách loại bỏ phần tử nhỏ nhất
        $maxSum = $totalSum - $arr[0];
  
        printf("%d %d", $minSum, $maxSum);

    } else {
        echo "Không có dữ liệu đầu vào.";
    }
}

$arr = [1, 2, 3, 4, 5];


miniMaxSum($arr);

?>
