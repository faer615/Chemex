<?php


namespace App\Services;


use Adldap\Laravel\Facades\Adldap;
use App\Models\StaffDepartment;
use App\Models\StaffRecord;
use Exception;

class LDAPService
{
    /**
     * 获取AD中全部的OU，并且带上层级
     * @param $mode
     * @return bool|string
     */
    public static function importStaffDepartments($mode)
    {
        try {
            // 如果模式是复写，先执行清空表
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
                // 如果DN中，下标为1存在OU=，就是说当前的部门有父级部门
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

    /**
     * 获取AD中全部的User，并且自动写入部门
     */
    public static function importStaffRecords($mode)
    {
        try {

            // 如果模式是复写，先执行清空表
            if ($mode == 'rewrite') {
                StaffRecord::truncate();
            }

            $users = Adldap::search()->users()->get();
            $users = json_decode($users, true);
            foreach ($users as $user) {
                $user_name = $user['cn'][0];
                $user_dns = $user['distinguishedname'][0];
                $user_dn_array = explode(',', $user_dns);
                $user_dn_up = $user_dn_array[1];
                // 默认写入的部门ID为0，也就是根部门
                $department_id = 0;
                // 如果用户有所属部门
                if (strpos($user_dn_up, 'OU=') !== false) {
                    $user_dn_department = explode('=', $user_dn_up)[1];
                    $department = StaffDepartment::where('name', $user_dn_department)->first();
                    if (!empty($department)) {
                        $department_id = $department->id;
                    }
                }
                $staff = StaffRecord::where('name', $user_name)->first();
                if (empty($staff)) {
                    $staff = new StaffRecord();
                }
                $staff->name = $user_name;
                $staff->department_id = $department_id;
                $staff->ad_tag = 1;
                $staff->save();
            }
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}
