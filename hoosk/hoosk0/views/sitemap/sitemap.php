<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url();?></loc>

    </url>


    <?php foreach($data as $url) { ?>
        <url>
            <loc><?= base_url().$url['pageURL'] ?></loc>
            <lastmod> <?= $url['pageUpdated'] ?> </lastmod>
        </url>
    <?php } ?>

</urlset>