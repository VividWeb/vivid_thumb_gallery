<?php
defined('C5_EXECUTE') or die(_("Access Denied.")); 
$c = Page::getCurrentPage();
if(!count($items)>0){
    echo "<div class='well'>";
    echo t("You have not choosen a fileset, or there's no files in the set you have choosen.");
    echo "</div>";
}
else {
    $colWidth = 100/$cols;
    $mobileColWidth = 100/$colsMobile;    
?>
<style>
    #vivid-thumb-gallery-<?=$bID?> { overflow: auto; }
        #vivid-thumb-gallery-<?=$bID?> .thumb-item { box-sizing: border-box; float: left; width: <?=$mobileColWidth?>%; padding: 10px; }
        #vivid-thumb-gallery-<?=$bID?> .thumb-item img { max-width: 100%; height: auto !important; }
        @media only screen and (min-width:768px){
            #vivid-thumb-gallery-<?=$bID?> .thumb-item { box-sizing: border-box; float: left; width: <?=$colWidth?>%; }   
        }
</style>
<?php if (!$c->isEditMode()) { ?>
<script type="text/javascript">
$(function(){
    $("#vivid-thumb-gallery-<?=$bID?> img").elevateZoom();
});
</script>
<?php } ?>
<div class="vivid-thumb-gallery" id="vivid-thumb-gallery-<?=$bID?>">
    <?php    
    $ih = Loader::helper("image");
    $page = Page::getCurrentPage();
    foreach($items as $item){            
        $fileObj = File::getByID($item['fID']);  
        if(is_object($fileObj)){
            $thumb = $ih->getThumbnail($fileObj,$thumbWidth,$thumbHeight,true);
            $fullImg = $ih->getThumbnail($fileObj,$imageWidth,$imageHeight,false);
            ?>
            <div class="thumb-item">
                <img src="<?=$thumb->src?>" data-zoom-image="<?=$fullImg->src?>">
            </div>
    <?php 
        }//if is_obj
    }//for each
}//if items*/
?>
</div>
