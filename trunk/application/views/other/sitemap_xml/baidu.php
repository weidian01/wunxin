<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'."\n";?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	<?php foreach ($data as $v): ?>
	<url>
		<loc><?=productURL($v['pid'])?></loc>
		<lastmod><?=date('Y-m-d', TIMESTAMP);?></lastmod>
		<changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
	<?php endforeach;?>
</urlset>