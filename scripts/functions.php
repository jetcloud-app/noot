<?php
function caixaMensagem ($mensagem, $style) {
    
    $javascript = '<script id="my">document.getElementById("my").addEventListener("load", diloag("'.$style.'", "'.$mensagem.'"));</script>';
                	
    $html = '<div class="dialog '.$style.'" id="dialog'.$style.'" style="transition: top 0.5s ease 0.5s; top: -115px; display: block; z-index: 99;">
	         <div class="color" id="cor'.$style.'"></div>
	         <i class="icon" id="i'.$style.'"></i>
	         <p class="conteudo" id="c'.$style.'">'.$mensagem.'</p>
             </div>';
             
    echo $html;
    echo $javascript;
}