<?php


namespace App\Services;


use Adldap\Laravel\Facades\Adldap;
use App\Models\StaffDepartment;
use Exception;

class LDAPService
{
    /**
     * 获取AD中全部的OU，并且带上层级
     * level中按照下标递增而OU层级越高
     * 也就是说下标为0就代表着这是当前条目的上级OU
     * @param $mode
     * @return bool|string
     */
    public static function importStaffDepartments($mode)
    {
        try {
            if ($mode == 'rewrite') {
                StaffDepartment::truncate();
            }
            $ous = Adldap::search()->ous()->get();
            $ous = json_decode($ous, true);
            foreach ($ous as $ou) {
                $ou_name = $ou['name'][0];
                $ou_level = $ou['distinguishedname'][0];
                $ou_level_array = explode(',', $ou_level);
                $ou_level_up = $ou_level_array[1];
                if (strpos($ou_level_up, 'OU=') !== false) {
                    $parent_ou_name = str_replace('OU=', '', $ou_level_up);
                    if ($ou_name != $parent_ou_name) {
                        $parent_department = StaffDepartment::where('name', $parent_ou_name)
                            ->where('ad_tag', 1)
                            ->first();
                        if (empty($parent_department)) {
                            $parent_department = new StaffDepartment();
                            $parent_department->name = $parent_ou_name;
                            $parent_department->ad_tag = 1;
                            $parent_department->save();
                        }
                        $department = StaffDepartment::where('name', $ou_name)
                            ->where('ad_tag', 1)
                            ->first();
                        if (empty($department)) {
                            $department = new StaffDepartment();
                            $department->name = $ou_name;
                            $department->parent_id = $parent_department->id;
                            $department->ad_tag = 1;
                        } else {
                            $department->parent_id = $parent_department->id;
                        }
                        $department->save();
                    }
                }
            }
            return true;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public static function importStaffRecords()
    {
        dd(Adldap::search()->users()->get());
    }
}
