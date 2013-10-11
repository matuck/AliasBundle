<?php
namespace matuck\AliasBundle\Exception;

class DuplicateAliasException extends \Exception
{
    public function __construct($message) {
        parent::__construct($message, 0, null);
    }
}

?>
