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
        }else if($type == 'plucked'){
            $data = DB::table('users')->get()->pluck('name','id');
        }
        return $data;
        # code...
    }
    
    /**
     * Bam_Rooms
     *
     * @param  mixed $type
     * @param  mixed $id
     * @return void
     */
    function Bam_Rooms($type = null,$id = null)
    {
        if($type == 'all'){
            $data = DB::table('rooms')->get();
        }else if($type == 'plucked'){
            $data = DB::table('rooms')->get()->pluck('name','id');
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
    
    /**
     * Bam_Transactions
     *
     * @param  mixed $type
     * @return void
     */
    function Bam_Transactions($type = "all",$num = 10)
    {
        if ($type == "lastbalance") {
            $data = \DB::table('mpesa_transactions')->latest()->pluck('OrgAccountBalance')->first() ?? 0;
            $data = 'Ksh.'.$data;
        }else if($type == "lastdaily") {
            $data = \DB::table('mpesa_transactions')->where('created_at', '>=', \Carbon\Carbon::now()->subDay()->toDateTimeString())->sum('TransAmount') ?? 0;
            $data = 'Ksh.'.$data;
        }else if($type == 'latest'){
            $data = \DB::table('mpesa_transactions')->latest()->take($num)->get();
        }
        return $data;
    }
    
    /**
     * Bam_Admin
     *
     * @param  mixed $type
     * @param  mixed $id
     * @return void
     */
    function Bam_Admin($type ='logged',$id= null){
        if($type == 'logged'){
            $data = Encore\Admin\Facades\Admin::user()->id;
        }else if($type =='staff'){
            $role = Encore\Admin\Auth\Database\Role::where('slug', 'staff')->first();
            $data = $role->administrators;
        }
        return $data;
    }
    
    /**
     * Bam_Complains
     *
     * @param  mixed $type
     * @param  mixed $id
     * @return void
     */
    function Bam_Complains($type = null,$id = null)
    {
        if($type == 'all'){
            $data = DB::table('complains')->get();
        }else if($type == 'open'){
            $data = DB::table('complains')->where('status',0)->get();
        }else if($type == 'solved'){
            $data = DB::table('complains')->where('status',2)->get();
        }else if($type == 'onprocess'){
            $data = DB::table('complains')->where('status',1)->get();
        }
        return $data;
        # code...
    }

    function Bam_Maintenance($type = 'all',$id = null)
    {
        if($type == 'all'){
            $data = DB::table('maintenances')->get();
        }else if($type == 'sum'){
            $data = DB::table('maintenances')->sum('maintenance_amount');
        }
        return $data;
        # code...
    }
        
    /**
     * Bam_Months
     *
     * @param  mixed $type
     * @return void
     */
    function Bam_Months($type = 'all',$month_id = null){
        if($type == 'all'){
            $data = array();
            for($i = 1 ; $i <= 12; $i++)
            {
                $data[] = date("F",mktime(0,0,0,$i,1,date("Y")));
            }
            
        }else if($type == "specific"){
            $data = '';
            for($i = 1 ; $i <= 12; $i++)
            {
                if($month_id == $i){ 
                    $data = date("F",mktime(0,0,0,$i,1,date("Y")));
                    break;
                }
            }
        }
        return $data;
    }
    
    /**
     * Bam_Years
     *
     * @param  mixed $type
     * @return void
     */
    function Bam_Years($type = 'all'){
        
        $data = array();
        

        for($i = (date("Y")-1) ; $i <= (date("Y")+9); $i++)
        {
            $data[] = $i;
        }
        return $data;
    }