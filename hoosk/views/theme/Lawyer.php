<br>
<br>
<br>
<br>
<br>
<div class="container">
    <?php echo $page['pageContentHTML']; ?>
    <hr>
</div>
<script>
    $(function(){
        $('div.leftsidebar a').click(function(){
            var alink = $(this).attr('href');
            var result = alink.substring(alink.lastIndexOf("#") + 1);
            var ID = "#"+result;
            $('html, body').animate({scrollTop: $(ID).offset().top -80}, 2000);
        });
    });
</script>
