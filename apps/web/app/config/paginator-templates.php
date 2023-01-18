<?php
/**
 * ページネーションのレイアウトを変更したい場合はここを編集
 */


return [
    'nextActive' => '<li class="paging-next"><a href="{{url}}"><span>→</span></a></li>',
    'prevActive' => '<li class="paging-prev"><a href="{{url}}"><span>←</span></a></li>',
    'ellipsis' => '<li class="dot"><a href="#">...</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link">{{text}}</a></li>'
];