<?php

if(! function_exists('base_url'))
{
    function base_url($path = null)
    {
        return url('/public');
    }
}
