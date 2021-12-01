<?php
namespace App;

class Blacklist
{
    private $list = ['fake', 'porno', 'test'];

    public function run()
    {
        return $this->list;
    }
}

