<?php if ($this->beginCache("walld".$company->id, ['duration' => $data])) { ?>
    <?php if($wall || $fb_wall){
        function to_link($string){
            return preg_replace("~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|$)~", '<a target="_blank" rel="nofollow" href="$1://$2">$1://$2</a>$3',$string);
        }
        ?>
<?php if($wall){?>
    <div class="container wall">
        <hr />
        <div class="row">
            <h2>Новости от <?=$company->name;?></h2>
            <?php
            for ($i = 1; $i < count($wall); $i++)
            {?>
                <div class="col-sm-6 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <div class="wall_text">
                                <?=to_link($wall[$i]->text);?>
                            </div>
                            <div class="row photos">
                                <?php
                                $imgs=$wall[$i]->attachments;
                                //print_r($imgs);
                                $arr=[];
                                //$arrv=[];
                                for($j=0;$j<count($imgs);$j++){
                                    if($imgs[$j]->photo->src) $arr[]='<img src="'.$imgs[$j]->photo->src_big.'" alt="'.$i.$j.'"/>';
                                    //https://vk.com/club14475242?z=video-14475242_456239021
                                    //if($imgs[$j]->video->vid) $arrv[]='<video><source src="https://vk.com/club'.substr($imgs[$j]->video->owner_id, 1).'?z=video'.$imgs[$j]->video->owner_id.'_'.$imgs[$j]->video->vid.'"></video>';
                                }
                                $col=count($arr);
                                if($col>=4) $col=3; else if($col==1) $col=12; else if ($col==3) $col=4; else if ($col==2) $col=6;
                                for($j=0;$j<count($arr);$j++){?>
                                    <div class="col-md-<?=$col;?>">
                                        <?=$arr[$j];?>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <?=date("d.m.Y",$wall[$i]->date);?>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
<?php }?>
<?php if($fb_wall){?>
    <div class="container wall">
        <hr />
        <div class="row">
            <h2>Новости от <?=$company->name;?></h2>
            <?php
            for ($i = 0; $i < count($fb_wall); $i++)
            { if($fb_wall[$i]->message){?>
                <div class="col-sm-6 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <div class="wall_text">
                                <?=to_link($fb_wall[$i]->message);?>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <?php echo date("d.m.Y", strtotime($fb_wall[$i]->created_time));?>
                        </div>
                    </div>
                </div>
            <?php } }?>
        </div>
    </div>
<?php }?>
<?php }?>
<?php  $this->endCache();
} ?>
