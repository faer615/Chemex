<?php


namespace App\Libraries;


use App\Models\StaffRecord;

class InfoHelper
{
    /**
     * 雇员id换取name
     * @param $staff_id
     * @return string
     */
    static function staffIdToName($staff_id)
    {
        $staff = StaffRecord::where('id', $staff_id)
            ->where('deleted_at', null)
            ->first();
        if (empty($staff)) {
            return '雇员失踪';
        }
        return $staff->name;
    }

    /**
     * 雇员id换取部门name
     * @param $staff_id
     * @return mixed
     */
    static function staffIdToDepartmentName($staff_id)
    {
        $staff = StaffRecord::where('id', $staff_id)
            ->where('deleted_at', null)
            ->first();
        if (!empty($staff)) {
            return $staff->department->name;
        }
    }
}
