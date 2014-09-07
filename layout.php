<?php return
[
    [
        'method' => 'tab',
        'title' => 'Tab pane',

        'items' =>
        [
            [ 'method' => 'field', 'field' => 'foo' ],

            [
                'method' => 'row',
                'items' =>
                [
                    [ 'method' => 'field', 'field' => 'bar', 'span' => 6 ],
                    [ 'method' => 'field', 'field' => 'baz', 'span' => 6 ],
                ],
            ],
        ],
    ],
];