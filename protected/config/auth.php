<?php

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    User::ROLE_BANNED => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => User::getRoles(User::ROLE_BANNED),
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    User::ROLE_USER=> array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => User::getRoles(User::ROLE_USER),
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    User::ROLE_ADMIN => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => User::getRoles(User::ROLE_ADMIN),
        'children' => array(
            'operator', // позволим админу всё, что позволено оператору
        ),
        'bizRule' => null,
        'data' => null
    ),
);