<?='<?xml version="1.0" encoding="%%%encoding%%%"?>';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">

<head>
  <meta http-equiv="Content-Type" content="%%%content_type%%%" />
  <meta name="keywords" content="<?= empty($keywords) ? 'limonade, php microframework' : h($keywords);?>" />
  <meta name="description" content="<?= empty($description) ? 'limonade is php microframework inspired by sinatra.' : h($description); ?>" />
  <meta name="robots" content="index,follow" />
  <title><?= empty($title) ? 'limonade sample' : h($title); ?></title>
  <link rel="stylesheet" href="sample.css" />
</head>

<body>
  <?= $content; ?>
</body>
</html>

