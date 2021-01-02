<?php
function paginate($cnt,$limit_per_page,$current_page,$link){
    $paginate = "";
    $pages = $cnt / $limit_per_page;
    $intval = intval($pages);
    if($pages != $intval){
        $pages++;
    }
    $pages = intval($pages);
    if($current_page == 1){
        if(($current_page + 5) < $pages){
            $end_for = $current_page + 5;
        }else{
            $end_for = $pages;
        }
        for($i =$current_page ; $i <= $end_for;$i++){
            if($i == $current_page){
                $paginate .= '<li class="page-item active">
                              <span class="page-link">
                                '.$i.'
                                <span class="sr-only">(current)</span>
                              </span>
                            </li>';
            }else {
                $paginate .= '<li class="page-item"><a class="page-link" href="'. $link . $i . '">' . $i . '</a></li>';
            }
        }
        $paginate .= '
        <li class="page-item">
          <a class="page-link" href="'. $link . ($current_page+1) . '" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
        ';
    }
    elseif($current_page == $pages){
        $paginate = '
        <li class="page-item">
          <a class="page-link" href="'. $link . ($current_page-1) . '" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        ';
        if(($current_page - 5) >1){
            $start_for = $current_page - 5;
        }else{
            $start_for = 1;
        }
        for($i =$start_for ; $i <= $pages;$i++){
            if($i == $current_page){
                $paginate .= '<li class="page-item active">
                              <span class="page-link">
                                '.$i.'
                                <span class="sr-only">(current)</span>
                              </span>
                            </li>';
            }else {
                $paginate .= '<li class="page-item"><a class="page-link" href="'. $link . $i . '">' . $i . '</a></li>';
            }
        }
    }else{
        $paginate = '
        <li class="page-item">
          <a class="page-link" href="'. $link . ($current_page-1) . '" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>';
        if(($current_page + 3) < $pages){
            $end_for = $current_page + 3;
        }else{
            $end_for = $pages;
        }
        if(($current_page - 3) > 1){
            $start_for = $current_page -3;
        }else{
            $start_for = 1;
        }
        for($i =$start_for ; $i <= $current_page;$i++){
            if($i == $current_page){
                $paginate .= '<li class="page-item active">
                              <span class="page-link">
                                '.$i.'
                                <span class="sr-only">(current)</span>
                              </span>
                            </li>';
            }else {
                $paginate .= '<li class="page-item"><a class="page-link" href="'. $link . $i . '">' . $i . '</a></li>';
            }
        }
        for($i =($current_page+1) ; $i <= $end_for;$i++){
            $paginate .= '<li class="page-item"><a class="page-link" href="'. $link . $i . '">' . $i . '</a></li>';
        }
        $paginate .= '<li class="page-item">
          <a class="page-link" href="'. $link . ($current_page+1) . '" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
        ';
    }
    return $paginate;
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES);
    return $data;
}
