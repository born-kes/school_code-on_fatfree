<!DOCTYPE html>
<html lang="<?= t('pl-PL') ?>">
<head>
    <meta charset="UTF-8">
    <title><?= t('Nie przewidziany błąd') ?></title>
</head>
<body>
<h1><?= t('Przepraszamy,') ?> </h1>
<h2><?= t('Wystąpił nieprzewidziany błąd i strona jest niedostępna.') ?></h2>
<p>

<h3><?= t($messageError->getFile()) ?>: <?= t($messageError->getLine()) ?></h3>
<h4><?= t($messageError->getMessage()) ?></h4>
</p>
</body>
</html>