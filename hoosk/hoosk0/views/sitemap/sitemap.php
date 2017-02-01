<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url();?></loc>

    </url>


    <?php  foreach($data as $url) {   ?>
        <url>
            <loc><?= base_url().$url['pageURL']  ?></loc>
            <lastmod> <?= $url['pageUpdated']  ?> </lastmod>
        </url>
    <?php  }  ?>

    <?php foreach($company as $company_url) { ?>
        <url>
            <?php if(!empty($company_url->company)){?>

            <?php  //$company_name = Regex.Replace($company_name, @"([ a-zA-Z0-9_]|^\s)", "");
               $company_name =  str_replace(" ","_",$company_url->company);
               $company_name =  str_replace("&","_",$company_name);
                ?>

            <loc><?= base_url()."esic_database/company/".$company_name ; ?></loc>
            <lastmod> <?= $company_url->added_date ?> </lastmod>
            <?php } ?>
        </url>
    <?php } ?>

</urlset>