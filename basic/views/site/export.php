<pages>
	<?php foreach ($data as $item) { ?>
		<page>
			<title><?= $item['title'] ?></title>
			<url><?= $item['url'] ?></url>
			<description><?= $item['description'] ?></description>
			<date><?= $item['date'] ?></date>
			<image><?= $item['image'] ?></image>
		</page>
	<?php } ?>
</pages>
