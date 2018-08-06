<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;
class MenuValidator implements Rule
{
    private $_new_name, $_old_name, $_parent_id = null;
    /**
     * Create a new rule instance.
     * @return void
     */
    public function __construct($new_name, $old_name = null, $id = null)
    {
        $this->_new_name = $new_name;
        $this->_old_name = $old_name;
        $this->_parent_id = ($id)?$id:null;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->_new_name !== $this->_old_name){
            $sql = "`name`='$this->_new_name'";
            if($this->_parent_id){
                $sql .=  " AND `parent_id`='$this->_parent_id'";
            }
            return !DB::table('menus')->whereRaw($sql)->exists();
        }
        return true;
    }

  
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Provided name already exists with this parent.';
    }
}
