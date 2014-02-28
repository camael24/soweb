<?php

    $this->inherits('Layout/Base.tpl.php');
    $this->block('container');

    if(isset($content))
    	echo $content;
    

    $this->endBlock();
