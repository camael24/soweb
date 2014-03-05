<?php

namespace Application\Controller {

    use Hoa\File\Finder;
    use Sohoa\Framework\Kit;

    class Generic extends Kit
    {


        protected $_list = array();

        public function construct()
        {
            $list             = array();
            $listPerCategorie = array();
            $directory        = 'hoa://Application/External/';
            $finder           = new Finder();

            $finder
                ->maxDepth(5)
                ->in($directory)
                ->files()
                ->name('#\.md$#');

            foreach ($finder as $file) {
                /**
                 * @var \SplFileInfo $file
                 */
                if ($file->getFilename() !== 'index.md') {
                    $categorie = str_replace($directory, '', $file->getPath());
                    $id        = substr($file->getFilename(), 0, strpos($file->getFilename(), '.'));
                    $filename  = $file->getFilename();

                    if ($filename[0] !== '_') {
                        $description                  = substr($file->getFilename(), strpos($file->getFilename(), '.') + 1);
                        $description                  = substr($description, 0, strrpos($description, '.'));
                        $list[$categorie . '/' . $id] = array(
                            'id'          => $categorie,
                            'data'        => $id,
                            'categorie'   => ucwords(str_replace('-', ' ', $categorie)),
                            'idCategorie' => $categorie,
                            'idFile'      => $id,
                            'file'        => ucfirst(str_replace('-', ' ', $id)),
                            'label'       => ucfirst(str_replace('-', ' ', $description)),
                            'raw'         => $file->getPathname()
                        );
                    }
                }
            }

            foreach ($list as $e)
                $listPerCategorie[$e['categorie']][] = $e;

            $this->data->list = $listPerCategorie;
            $this->_list      = $list;
        }

    }
}
