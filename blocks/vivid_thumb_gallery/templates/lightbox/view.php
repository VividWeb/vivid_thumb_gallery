<?php
defined('C5_EXECUTE') or die(_("Access Denied.")); 
$c = Page::getCurrentPage();
if(!count($items)>0){
    echo "<div class='well'>You have not choosen a fileset, or there's no files in the set you have choosen.</div>";
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
    .blackout { position: fixed; z-index: 9998; background: rgba(0,0,0,0.4); width: 100%; height: 100%; top: 0; left: 0; }
    #imagelightbox { position: fixed; z-index: 9999; -ms-touch-action: none; touch-action: none; }
    .imagelightbox-arrow { width: 50px;height: 50px;border-radius: 50%;background-color: rgba( 0, 0, 0, .8 );vertical-align: middle;display: none;position: fixed; z-index: 10001;top: 50%;margin-top: -3.75em; /* 60 */ }
        .imagelightbox-arrow:hover,
        .imagelightbox-arrow:focus { background-color: #222;background-color: rgba( 0, 0, 0, .75 );}
        .imagelightbox-arrow:active { background-color: #111; }
            .imagelightbox-arrow-left { left: 2.5em; }
            .imagelightbox-arrow-right { right: 2.5em; /* 40 */}
            .imagelightbox-arrow:before { width: 0; height: 0;border: .7em solid transparent; content: '';display: inline-block;  margin-bottom: -0.125em; /* 2 */ }
                .imagelightbox-arrow-left:before { border-left: none;border-right-color: #fff; margin-left: -0.313em; /* 5 */}
                .imagelightbox-arrow-right:before { border-right: none; border-left-color: #fff; margin-right: -0.313em;   }
                
    .imagelightbox-arrow { -webkit-animation: fade-in .25s linear; animation: fade-in .25s linear; }
        @-webkit-keyframes fade-in
        {
            from    { opacity: 0; }
            to      { opacity: 1; }
        }
        @keyframes fade-in
        {
            from    { opacity: 0; }
            to      { opacity: 1; }
        }
     @media only screen and (max-width: 41.250em) {
        .imagelightbox-arrow { width: 2.5em; height: 2.5em;  margin-top: -2.75em; }
        .imagelightbox-arrow-left  {left: 1.25em;  }
        .imagelightbox-arrow-right { right: 1.25em; }
     }
     @media only screen and (max-width: 20em) {
        .imagelightbox-arrow-left { left: 0;}
        .imagelightbox-arrow-right { right: 0; }
     }
</style>
<?php if (!$c->isEditMode()) { ?>
<script type="text/javascript">
$(function(){
    
    arrowsOn = function( instance, selector )
    {
        var $arrows = $( '<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>' );

        $arrows.appendTo( 'body' ).show();

        $arrows.on( 'click touchend', function( e )
        {
            e.preventDefault();

            var $this   = $( this ),
                $target = $( selector + '[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"]' ),
                index   = $target.index( selector );

            if( $this.hasClass( 'imagelightbox-arrow-left' ) )
            {
                index = index - 1;
                if( !$( selector ).eq( index ).length )
                    index = $( selector ).length;
            }
            else
            {
                index = index + 1;
                if( !$( selector ).eq( index ).length )
                    index = 0;
            }

            instance.switchImageLightbox( index );
            return false;
        });
    },
    arrowsOff = function()
    {
        $( '.imagelightbox-arrow' ).remove();
    };
    var selector<?=$bID?> = "#vivid-thumb-gallery-<?=$bID?> .imagelightbox";
    var instance<?=$bID?> = $(selector<?=$bID?>).imageLightbox({
        onStart: function(){
            $("body").append("<div class='blackout'>");
            arrowsOn(instance<?=$bID?>, selector<?=$bID?>);
        },
        onEnd: function(){
            $(".blackout").remove();
            arrowsOff(); 
        },
        quitOnImgClick: true //enable quit on image click
    });
});
</script>
<?php } ?>
<div class="vivid-thumb-gallery" id="vivid-thumb-gallery-<?=$bID?>">
    <?php    
    $ih = Loader::helper("image");
    $page = Page::getCurrentPage();
    foreach($items as $item){            
            $fileObj = File::getByID($item['fID']);  
            $thumb = $ih->getThumbnail($fileObj,$thumbWidth,$thumbHeight,true);
            $fullImg = $ih->getThumbnail($fileObj,$imageWidth,$imageHeight,false);
            ?>
                <div class="thumb-item">
                    <a href="<?=$fullImg->src?>" class="imagelightbox" data-imagelightbox="gallery<?=$bID?>"><img src="<?=$thumb->src?>"></a>
                </div>
    <?php 
    }//for each
}//if items*/
?>
</div>
