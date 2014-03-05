<?php

namespace Application\Controller {

    use Hoa\File\Read;
    use Hoa\Router\Exception\NotFound;
    use Sohoa\Framework\Kit;


    class Doc extends Generic
    {

        public function indexAction()
        {
            $this->greut->render();
        }

        public function showAction($doc_id)
        {
            $doc_id = strtolower($doc_id);


            if (array_key_exists($doc_id, $this->_list)) {

                $file                = $this->_list[$doc_id];
                $read                = new Read($file['raw']);
                $parser              = new \Parsedown();
                $this->data->content = $parser->parse($read->readAll());

            } else {
                throw new NotFound('Documentation %s has not found here', 0, array($doc_id));
            }


            $this->greut->render();
        }
    }
}
