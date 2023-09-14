<?php

namespace Database\Traits;

use Illuminate\Support\Facades\DB;

trait EnumMigrate
{
    private function getSqlEnum($change, $table, $col, array $values, ?string $default = "")
    {
        if (!onMysqlDatabase()) {
            return false;
        }
        $table = addslashes($table);
        $col = addslashes($col);
        $enumOptions = "'" . implode("','", $values) . "'";
        if (count($values) == 0 || (isset($values[0]) && is_array($values[0]))) {
            throw new \Exception("Empty array or multidimensional are not accepted.");
        }
        if ($change) {
            $sql = "ALTER TABLE $table CHANGE $col $col ENUM($enumOptions)";
        } else {
            $sql = "ALTER TABLE $table MODIFY  $col  ENUM($enumOptions)";
        }

        if (!is_null($default) && $default == "") {
            $sql .= " NOT NULL";
        } elseif (is_null($default)) {
            $sql .= " DEFAULT NULL";
        } elseif (!empty($default)) {
            $default = addslashes($default);
            $sql .= " DEFAULT '$default'";
        }
        return DB::statement($sql);

    }

    public function modifyEnumCol($table, $col, array $values, ?string $default = "")
    {
        return $this->getSqlEnum(false, $table, $col, $values, $default);
    }

    public function changeEnumCol($table, $col, array $values, ?string $default = "")
    {

        return $this->getSqlEnum(true, $table, $col, $values, $default);
    }
}
//DB::statement("ALTER TABLE ".$this->set_schema_table." MODIFY COLUMN status ENUM('PROGRESS', 'STOPPED', 'COMPLETED','PASSED') NOT NULL DEFAULT 'PROGRESS'");
