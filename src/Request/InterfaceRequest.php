<?php

namespace Surest\SimpleLog\Request;

interface InterfaceRequest
{
    public function headers();
    public function get();
    public function post();
    public function all();
    public function params();
}