<?php

namespace App\Starter\Users\Models;

use App\Starter\Users\UserEnums;
use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    protected $table = "roles";
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'type',
        'is_default'
    ];

    public function getData() {
        return $this;
    }

    public function getUserTypes() {
        return UserEnums::userTypes();
    }

    public function export($rows, $fileName) {
        if($rows) {
            foreach($rows as $row) {
                unset($object);
                $object['id']=$row->id;
                $object['Name']=$row->name;
                $object['Display Name']=$row->display_name;
                $object['Description']=$row->description;
                $object['Type']=$row->type;
                $labels=array_keys($object);
                $data[]=$object;
            }
            export($data, $labels, $fileName);
        }
    }
}
