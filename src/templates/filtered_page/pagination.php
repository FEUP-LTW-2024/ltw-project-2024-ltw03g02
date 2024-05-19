<?php 
    function drawPagination($totalPages, $pageNumber) { 
        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            $params = $_GET;
            $params['pageNum'] = $i;
            $queryString = http_build_query($params);
            if ($i == $pageNumber) {
                echo '<a id="page-num-' . $i . '" class="curr-page" href="?' . $queryString . '">' . $i . '</a> ';
            } else {
                echo '<a id="page-num-' . $i . '" href="?' . $queryString . '">' . $i . '</a> ';
            }
        }
        echo '</div>';
    }
?>