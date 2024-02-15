<!DOCTYPE html PUBLIC>
<html>
<head>
<meta charset="EUC-KR">
<title>녹화</title>
<style>
    body {
        height: 100vh;
        background-color: #f1f1f1;
        margin: 0;
        padding: 20px;
    }

    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        max-width: 600px;
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #e8f0fe;
    }

    a {
        text-decoration: none;
        color: inherit;
    }
    
    .pagination {
        margin-top: 20px;
        text-align: center;
    }
    
    .pagination a {
        display: inline-block;
        padding: 8px 16px;
        text-decoration: none;
        color: #007bff;
        border: 1px solid #007bff;
        border-radius: 4px;
    }
    
    .pagination a.active {
        background-color: #007bff;
        color: #fff;
    }
    
    .pagination-wrapper {
        text-align: center;
        margin-top: 20px;
    }
    
    .pagination-button {
        margin: 0 5px;
    }
    
    .pagination-arrow {
        font-weight: bold;
    }
</style>
</head>
<body>
    <div class="container">
        <table border="1">
            <th>id</th>
            <th>촬영 시간</th>
            <?php
            $conn = mysqli_connect('localhost', 'test', '1234', 'test');
            // 페이징 설정
            $rowsPerPage = 10; // 페이지당 행의 개수
            $currentPage = 1; // 현재 페이지 번호
            if (isset($_GET['page'])) {
                $currentPage = $_GET['page'];
            }
            $startRow = ($currentPage - 1) * $rowsPerPage; // 시작 행
            
            // 전체 행 개수 구하기
            $totalRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM record order by path desc"));
            $totalPages = ceil($totalRows / $rowsPerPage); // 전체 페이지 개수
            
            // 페이지에 해당하는 행 가져오기
            $sql = "SELECT * FROM record order by path desc LIMIT $startRow, $rowsPerPage";
            $result = mysqli_query($conn, $sql);
            
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                $i++;
                echo '<tr><td>'.$i.'</td>';
                echo '<td><a href=./play.php?rid='.$row['rid'].'>'.substr($row['path'], 9, 19).'</a></td></tr>';
            }
            ?>
        </table>
        
        <!-- 페이징 링크 출력 -->
        <div class="pagination-wrapper">
            <div class="pagination">
                <?php
                $visiblePages = 5; // 표시할 페이지 링크 개수
                $visiblePages = 5; // 표시할 페이지 링크 개수
$halfVisible = floor($visiblePages / 2); // 표시할 페이지 링크 개수의 절반

$startPage = $currentPage - $halfVisible;
$endPage = $currentPage + $halfVisible;

if ($startPage < 1) {
    $startPage = 1;
    $endPage = min($visiblePages, $totalPages);
} elseif ($endPage > $totalPages) {
    $endPage = $totalPages;
    $startPage = max(1, $endPage - $visiblePages + 1);
}

// 페이지 링크 출력
echo '<div class="pagination-wrapper">';
echo '<div class="pagination">';
// 이전 페이지 화살표
if ($currentPage > 1) {
    echo '<a href="?page=' . ($currentPage - 1) . '" class="pagination-arrow">&lt;</a>';
}

for ($page = $startPage; $page <= $endPage; $page++) {
    echo '<a href="?page=' . $page . '"';
    if ($page == $currentPage) {
        echo ' class="active"';
    }
    echo '>' . $page . '</a>';
}

// 다음 페이지 화살표
if ($currentPage < $totalPages) {
    echo '<a href="?page=' . ($currentPage + 1) . '" class="pagination-arrow">&gt;</a>';
}

echo '</div>';
echo '</div>';
?>
</div>
</div>
</body>
</html>

