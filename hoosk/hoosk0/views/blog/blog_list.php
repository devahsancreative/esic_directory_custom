<div id="main-content" class="container blog">
   <div class="row">
        
             
       <div class="col-md-8">
              
            <?php      
			 		 if($blog_data){
			         foreach($blog_data as $blog){
					    $link          = str_replace(" ","_",$blog->title);
						$link          = str_replace("'","",$link);
						$id            = $blog->id;
						$totla_comment = $this->common_model->get_comments_data('esic_comment',$id);
					    $totla_comment = count ($totla_comment);
						 
			?> 
            
            <h3 class="blog-title"> <a href="<?php echo  base_url().'blog/'.$id."/".$link ?>" class="blog-title-link blog-link"><?= $blog->title;?> </a></h3>
            
            <p class="blog-date"> <span class="date-text"> <?= $blog->date;?></span> </p>
            
            <p class="blog-comments">
					<a href="<?= base_url().'blog/'.$id."/".$link?>#commentsss"
                     class="blog-link"> <?= $totla_comment; ?> Comments </a> 
            </p>
          
           <div class="blog-separator">&nbsp;</div>
           
           <div class="blog-content">
				<div class="paragraph">
                
              <?= $blog->description;?>

            </div>
     </div>
                 <div class="blog-separator">&nbsp;</div>
                 <p class="blog-date"> <span class="date-text">Published By: <?= $blog->author;?>  </span> </p>
                     <div class="blog-comments">
				         <a href="<?= base_url().'blog/'.$id."/".$link?>#commentsss"
                     class="blog-link"> <?= $totla_comment; ?> Comments </a> 

	                  </div>
                <div class="blog-post-separator"></div>
         <?php }} ?> 
         
         
         <nav aria-label="Page navigation">
          <?php echo $this->pagination->create_links(); ?>
          </nav> 
         
         
               
 </div>
            <div class="col-md-4 blog_side_bar">
                <h3 class="blog-title Latest-Blogs"> <a href="#" class="blog-title-link blog-link"> Latest Blogs  </a> </h3>
                <ul class="blog-list">
                     <?php  
					  if($blog_list){ 
					     foreach($blog_list as $blog_lists){
						    $links = str_replace(" ","_",$blog_lists->title);
						    $links = str_replace("'","",$links);
						    $id   = $blog_lists->id;
			           ?>
                    <li><a href="<?php echo  base_url().'blog/'.$id."/".$links ?>" class="blog-title-link blog-link" >
                          <?=  $blog_lists->title; ?>  </a>
                    </li>
                    <?php }} ?>
                     
           
                </ul> 
            
            </div>
        
   </div>

</div>


