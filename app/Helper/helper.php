<?php
    
    /**
     * Bam_CurrentRoute
     *
     * @return void
     */
    function Bam_CurrentRoute(){
        return request()->route()->action['as'];
    }    
    /**
     * Bam_Tenants
     *
     * @param  mixed $var
     * @return void
     */
    function Bam_Tenants($type = null,$id = null)
    {
        if($type == 'all'){
            $data = DB::table('users')->get();
        }
        
        return $data;
        # code...
    }
