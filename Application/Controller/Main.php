<?php

namespace Application\Controller {

    use Hoa\File\Finder;
    use Hoa\File\Read;
    use Michelf\Markdown;
    use Sohoa\Framework\Kit;

    class Main extends Generic
    {
        public function indexAction()
        {
            $read                = new Read('hoa://Application/External/index.md');
            $md                  = new \Parsedown();
            $this->data->content = $md->parse($read->readAll());

            $this->greut->render();
        }


    }
}
