<div class="wrapper">
    <nav id="sidebar-cust"> 
     <?php
        foreach ($courtsData as $data) {
            $string2 = $data['header'];
            $stripped = str_replace(' ', '', $string2);
      ?>
    <ul class="list-unstyled components">
        <li>
            <input type="checkbox" class="form-check-input checkbox-a-search" value="checked">
            <a href="#<?php echo $stripped; ?>" data-toggle="collapse" aria-expanded="false"> <span class="item-label">
                <?php echo $data['header']; ?></span></a>  <!--Indian Courts//International Court-->          
            <?php //} ?>
            <ul class="collapse list-unstyled" id="<?php echo $stripped; ?>">
                 <?php if(is_array($data['items'])){ 
                       foreach($data['items'] as $dt){
                                    $string3 = $dt['header'];
                                    $stripped1 = str_replace(' ', '', $string3);
                 ?>
                <li>
                <input type="checkbox" class="form-check-input checkbox-a-search" value="checked">
                    <a href="#<?php echo $stripped1; ?>" data-toggle="collapse" aria-expanded="false"><span class="item-label"><?php echo $dt['header']; ?></span></a><!--Supreme//High//Tribunal-->
                <ul class="collapse list-unstyled" id="<?php echo $stripped1; ?>">
                          <?php if(isset($dt['items']) && is_array($dt['items'])){
                         foreach($dt['items'] as $et){
                        ?>
                        <li class="last-item">
                                <input type="checkbox" class="form-check-input checkbox-a-search" id="materialUnchecked" value=<?php echo $et['id']; ?>>
                                <span class="item-label"><?php echo $et['header'];?></span><!--supreme//supreme(level 3)-->
                        </li>
                        <?php } } ?>
                    </ul>
                 </li>
                <?php } } ?>
                </ul>
        </li>
           <?php } ?>   
      </ul>
</nav>
</div>
