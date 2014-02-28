<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sohoa - Framework PHP</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top : 60px;
        }
    </style>
</head>

<body>

<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="/" class="navbar-brand"><em>So</em>hoa Framework</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Documentation<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <li><a href="<?php echo $this->router->to('indexDoc'); ?>">All the doc</a></li>
                        <li class="divider"></li>
                        <?php
                        if (isset($list))
                            foreach ($list as $key => $value) {
                                echo '<li class="dropdown-header">' . $key . '</li>';
                                foreach ($value as $v)
                                    echo '<li><a href="' . $this->router->to('showDoc', array('doc_id' => $v['id'])) . '">' . ucfirst($v['file']) . '</a></li>';

                            }

                        ?>
                    </ul>
                </li>
                <li>
                    <a href="/api/">Api</a>
                </li>
                <li>
                    <a href="http://hoa-project.net">Hoa</a>
                </li>

            </ul>

        </div>
    </div>
</div>

<div class="container">

    <?php $this->block('container');
    $this->endBlock(); ?>

    <div class="footer"
         style="position: fixed; bottom: 0px; height: 20px; line-height: 20px; width: 100%; padding: 0; margin: 0; background-color: #FFFFFF">
        <p>&copy; Sohoa Framework</p>
    </div>

</div>

<?php
$env = $this->_framework->getEnvironnement();

if ($env['debug'] === true)
    echo '<div class="container"><pre>' . print_r($this->getRouter()->dump(), true) . '</pre></div>';

?>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
</body>
</html>
