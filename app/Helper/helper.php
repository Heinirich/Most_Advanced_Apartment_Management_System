<?php
    function Bam_CurrentRoute(){
        return request()->route()->action['as'];
    }
