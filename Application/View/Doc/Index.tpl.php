<?php

$this->inherits('Layout/Base.tpl.php');
$this->block('container');
/**
 * @var string $select
 */

if (!isset($select))
    $select = false;

$d = function ($key) use ($select) {
    if (is_string($select)) {
        return ($select === $key);
    }

    return true;
};

if (isset($list))
    foreach ($list as $key => $value) {

        if ($d($key) === true) {
            echo '<h5>' . $key . '</h5><ul class="list-group">';

            foreach ($value as $v)
                echo '<li class="list-group-item"><a href="' . $this->router->to('showDoc', array('doc_id' => $v['id'] , 'data' => $v['data'])) . '">' . ucfirst($v['file']) . '</a> ' . $v['label'] . '</li>';
            echo '</ul>';
        }
    }


$this->endBlock();
