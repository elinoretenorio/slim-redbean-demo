<?php include 'header.php'; ?>

<h1><?php safeText($page['name']); ?></h1>
<h3><?php safeText($page['description']); ?></h3>

<div id="content">
<?php safeText($page['content']); ?>
</div>

<?php include 'footer.php'; ?>