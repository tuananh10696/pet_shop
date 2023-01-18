<?php

/**
 * ページネーションのレイアウトを変更したい場合はここを編集
 */
return [
    'nextActive' => '<li class="mr-1"><a href="{{url}}" class="btn btn-secondary text-light">{{text}}</a></li>',
    'nextDisabled' => '<li class="mr-1 next disabled"><a href="" onclick="return false;">{{text}}</a></li>',
    'prevActive' => '<li class="mr-1"><a href="{{url}}" class="btn btn-secondary text-light">{{text}}</a></li>',
    'prevDisabled' => '<li class="mr-1 prev disabled"><a href="" onclick="return false;">{{text}}</a></li>',
    'counterRange' => '{{start}} - {{end}} of {{count}}',
    'counterPages' => '{{page}} of {{pages}}',
    'first' => '<li class="mr-1"><a href="{{url}}" class="btn btn-secondary text-light">{{text}}</a></li>',
    'last' => '<li class="mr-1"><a href="{{url}}" class="btn btn-secondary text-light">{{text}}</a></li>',
    'number' => '<li class="mr-1"><a href="{{url}}" class="btn btn-secondary text-light">{{text}}</a></li>',
    'current' => '<li class="mr-1"><a href="" class="btn btn-warning text-dark">{{text}}</a></li>',
    'ellipsis' => '<li class="ellipsis mr-1">&hellip;</li>',
    'sort' => '<li class="mr-1"><a href="{{url}}">{{text}}</a></li>',
    'sortAsc' => '<li class="mr-1"><a class="asc" href="{{url}}">{{text}}</a></li>',
    'sortDesc' => '<li class="mr-1"><a class="desc" href="{{url}}">{{text}}</a></li>',
    'sortAscLocked' => '<li class="mr-1"><a class="asc locked" href="{{url}}">{{text}}</a></li>',
    'sortDescLocked' => '<li class="mr-1"><a class="desc locked" href="{{url}}">{{text}}</a></li>',
];
