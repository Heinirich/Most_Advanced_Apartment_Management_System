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
    
    /**
     * Bam_GenerateKey
     *
     * @param  mixed $minlength
     * @param  mixed $maxlength
     * @param  mixed $uselower
     * @param  mixed $useupper
     * @param  mixed $usenumbers
     * @param  mixed $usespecial
     * @return void
     */
    function Bam_GenerateKey($minlength = 20, $maxlength = 20, $uselower = true, $useupper = true, $usenumbers = true, $usespecial = false) {
        $charset = '';
        if ($uselower) {
            $charset .= "abcdefghijklmnopqrstuvwxyz";
        }
        if ($useupper) {
            $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }
        if ($usenumbers) {
            $charset .= "123456789";
        }
        if ($usespecial) {
            $charset .= "~@#$%^*()_+-={}|][";
        }
        if ($minlength > $maxlength) {
            $length = mt_rand($maxlength, $minlength);
        } else {
            $length = mt_rand($minlength, $maxlength);
        }
        $key = '';
        for ($i = 0; $i < $length; $i++) {
            $key .= $charset[(mt_rand(0, strlen($charset) - 1))];
        }
        return $key;
    }

    function Bam_Transactions($type = "all")
    {
        if ($type = "last") {
            $data = \DB::table('mpesa_transactions')->latest()->pluck('OrgAccountBalance')->first() ?? 0;
            $data = 'Ksh.'.$data;
        }
        return $data;
    }