<?php
namespace {
    use Hoa\File\Finder;
    use Sohapi\Export;
    use Sohapi\Formatter\Html;
    use Sohapi\Proxy\Classes;

    require __DIR__ . '/vendor/autoload.php';

    if (!defined('DS'))
        define('DS', DIRECTORY_SEPARATOR);

    $cmd = function ($command, $directory) {
        $re      = '';
        $process = proc_open($command, array(array("pipe", "r"), array("pipe", "w"), array('pipe', 'a')), $pipes, $directory);
        if (is_resource($process)) {
            $re = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            proc_close($process);

        }

        return $re;
    };

    $directory   = __DIR__ . '/framework';
    $destination = __DIR__ . '/../Public/api/';

    if (!is_dir($directory))
        echo $cmd('git clone https://github.com/sohoa/framework', __DIR__);
    else
        echo $cmd('git pull', __DIR__);

    $commit     = $cmd('git log -n 1 --pretty=format:%h', $directory);
    $commitLong = $cmd('git log -n 1 --pretty=format:%H', $directory);
    $branch     = $cmd('git rev-parse --abbrev-ref HEAD', $directory);
    $html       = new Html($destination, array(
            'branch'      => $branch,
            'commitshort' => $commit,
            'commitlong'  => $commitLong
        )
    );
    $api        = new Export();
    $finder     = new Finder();
    $fDirectory = $directory . '/Sources/Sohoa/Framework/';
    $fDirectory = str_replace('/', '\\', $fDirectory);
    $finder->in($fDirectory)
        ->files()
        ->maxDepth(10);


    foreach ($finder as $file)
        if ($file instanceof \SplFileInfo) {
            $path      = str_replace($fDirectory, 'Sohoa/Framework/', $file->getPathname());
            $path      = str_replace('\\', '/', $path);
            $classname = substr($path, 0, strpos($path, '.'));

            if ($classname !== 'Sohoa/Framework/View/Xyl')
                $api->classname($classname);
        }

//    $api->classname('Sohoa/Framework/Framework');

    $api->all()
        ->internal('fr')
        ->resolution('#^/Sohoa#', '(?<classname>[^\\.]).html')
        ->resolution('#^/Hoa#' , 'https://github.com/hoaproject/Central')
        ->proxy(new Classes())
        ->export($html);
}