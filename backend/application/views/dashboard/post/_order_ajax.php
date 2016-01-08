<?php
//dump($posts);
echo get_ol($posts);

function get_ol ($array, $child = FALSE)
{
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';

        foreach ($array as $item) {
            $str .= '<li id="list_' . $item['post_id'] .'">';
            $str .= '<div>' . $item['post_title'] .'</div>';

            // Do we have any children?
            if (isset($item['children']) && count($item['children'])) {
                $str .= get_ol($item['children'], TRUE);
            }

            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ol>' . PHP_EOL;
    }

    return $str;
}
?>

<script>
$(document).ready(function(){

    $('.sortable').nestedSortable({
        handle: 'div',
        items: 'li',
        toleranceElement: '> div',
        maxLevels: 2
    });

});
</script>