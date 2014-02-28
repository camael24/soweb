<?php

    $this->inherits('Layout/Base.tpl.php');
    $this->block('container');

    if(isset($list))
    	foreach ($list as $key => $value) {
    		echo '<h5>'.$key.'</h5><ul class="list-group" style="font-size: 1.5em;">';

    			foreach ($value as $v)
	    			echo '<li class="list-group-item"><a href="'.$this->router->to('showDoc' , array('doc_id' => $v['id'])).'">'.ucfirst($v['file']).'</a> '.$v['label'].'</li>';
    		echo '</ul>';	
    	}
    

    $this->endBlock();
