<?php
namespace App\Models\Base;

use Exception;
use Framework\Config;
use Framework\DB\DB;
use Framework\DB\Exception\DBException;
use Framework\Exception\FrameworkException;

class ModelBase
{

    const ACTION_INSERT = 'INSERT';
    const ACTION_UPDATE = 'UPDATE';
    const ACTION_DELETE = 'DELETE';
    protected $tableName;
    protected $baseQuery = "SELECT * FROM ";
    protected $db = null;

    public function __construct($tableName)
    {
        //$this->db = new DB(Config::get('database.default'));
        $this->db = DB::connection(Config::get('database.default'));
        $this->tableName = $tableName;
    }

    public function setBaseQuery($query)
    {
        $this->baseQuery = $query;
    }

    public function getOneObjectByField($field)
    {
        $objects = $this->getObjectsByField($field);
        if (count($objects) > 0) {
            return (object)reset($objects);
        } else {
            return null;
        }
    }

    /**
     * @param $fields : the array of field name and value
     * @throws Exception : throw exception if this method is not implement by child class
     * @return : array of Objects
     */
    public function getObjectsByField($fields = array())
    {
        $query = array();

        foreach ($fields as $key => $value) {
            if (is_array($value)) {
                $query[] = "`{$key}`=" . array_shift($value);
            } elseif (is_numeric($key)) {
                $query[] = $value;
            } else {
                $query[] = "`{$key}`='{$value}'";
            }
        }
        if (count($fields)) {
            $sql = $this->baseQuery . " `{$this->tableName}` WHERE " . implode(" AND ", $query);
        } else {
            $sql = $this->baseQuery . " `{$this->tableName}`";
        }
        $result = $this->db->select($sql);
        return $result;
    }
	
	public function getOnceItem($condition)
    {
        if ($condition != '') {
            $sql = $this->baseQuery . " `{$this->tableName}` WHERE " . $condition;
        } else {
            $sql = $this->baseQuery . " `{$this->tableName}`";
        }
        $objects = $this->db->select($sql);
		if (count($objects) > 0) {
            return (object)reset($objects);
        } else {
            return null;
        }
    }
	
    /**
     * @param $fields : array of field names and value
     * @return : array of objects
     * @throws Exception : throw exception if this function has not yet implemented by child class
     */
    public function getObjectsByFields($fields)
    {
        if (!is_array($fields)) {
            throw new Exception("Invalid input in getObjectsByFields from User object");
        }
        if (count($fields) == 0) return array();
        $query = array();
        foreach ($fields as $field => $value) {
            if (!is_array($value)) {
                $value = array($value);
            }
            $query[] = $field . " IN ('" . implode("','", $value) . "') ";
        }
        $sql = $this->baseQuery . " {$this->tableName} WHERE " . implode(" AND ", $query);
        $result = $this->db->select($sql);
        return $result;
    }

    /**
     * @param $set_Params : key-value array about field want to update value
     * @param $where : where clause for update query
     * @return : the number of record effected
     */
    public function update($set_Params, $where)
    {
        try {
            if (isset($this->tableName)) {

                if ($set_Params == null || (isset($set_Params) && count($set_Params) == 0)) {
                    throw new DBException("set param invalid", DBException::ERROR_CODE_LACK_PARAMETER);
                }

                if ($where == null || (isset($where) && count($where) == 0)) {
                    throw new DBException("where param invalid", DBException::ERROR_CODE_LACK_PARAMETER);
                }

                $exist_in_where = array();

                $sets = array();
                $wheres = array();
                foreach ($set_Params as $key => $value) {
                    if (array_key_exists($key, $where)) {
                        $exist_in_where[$key] = $value;
                    }
                    if (is_array($value)) {
                        $sets[] = "`{$key}`=" . array_shift($value);
                    } else {
                        $value = $this->fixtags($value);
                        $sets[] = "`{$key}`='{$value}'";
                    }
                }

                foreach ($where as $key => $value) {
                    if (is_array($value)) {
                        $wheres[] = "`{$key}`=" . array_shift($value);
                    } else {
                        $wheres[] = "`{$key}`='{$value}'";
                    }
                }

                $sql = "UPDATE `{$this->tableName}` SET " . implode(",", $sets) . " WHERE " . implode(" AND ", $wheres);
                $this->db->query($sql);
                // correct where clause, use when update cache object only
                foreach ($exist_in_where as $key => $value) {
                    $where[$key] = $value;
                }
                return $where;

            } else {
                throw new DBException("Table name invalid", DBException::ERROR_CODE_INTERNAL);
            }
        } catch (DBException $e) {
            throw new DBException($e->getTraceAsString(), DBException::ERROR_CODE_LACK_PARAMETER);
        }
    }


    /**
     * @param $param array key and value for insert
     */
    public function insert($param)
    {
        if (isset($this->tableName)) {
            if ($param == null || (isset($param) && count($param) == 0)) {
                throw new DBException("insert param invalid", DBException::ERROR_CODE_LACK_PARAMETER);
            }

            $result = $this->formatValue(array_values($param));
            $values = $result['values'];
            foreach (array_keys($param) as $field) {
                $fields[] = "`{$field}`";
            }
            $fields = implode(',', $fields);
            $sql = "INSERT INTO `" . $this->tableName . "` (" . $fields . ") VALUES (" . implode(",", $values) . ")";
            return $this->db->query($sql);
        } else {
            throw new DBException("Table name invalid", DBException::ERROR_CODE_LACK_PARAMETER);
        }
    }

    private function formatValue($value_inputs)
    {
        if (isset($value_inputs)) {
            $values = array();
            foreach ($value_inputs as $value) {
                if (is_array($value)) {
                    $values[] = array_shift($value);
                } else {
                    $value = $this->fixtags($value);
                    $values[] = "'{$value}'";
                }
            }
            return array('values' => $values);
        } else {
            return array('values' => array());
        }
    }

    /**
     * Insert multiable values
     * @param array $fields
     * @param array $fieldValues
     * @return array
     */
    public function inserts($fields = array(), $fieldValues = array())
    {
        $values = array();
        foreach ($fieldValues as $value) {
            if (is_array($value)) {
                $valueArr = array();
                foreach ($fields as $field) {
                    $field = str_replace('`', '', $field);
                    if (isset($value[$field])) {
                        $val = isset($value[$field]) ? $value[$field] : '';
                        if (is_array($val)) {
                            $valueArr[] = array_shift($val);
                        } else {
                            $val = $this->fixtags($val);
                            $valueArr[] = "'{$val}'";
                        }
                    } else {
                        $val = $this->fixtags($val);
                        $valueArr[] = "'{$val}'";
                    }
                }
                $values[] = "(" . implode(",", $valueArr) . ")";
            }
        }
        if (count($fields) && count($values)) {
            $sql = "INSERT INTO {$this->tableName} (`" . implode('`,`', $fields) . "`) VALUES " . implode(',', $values);
            return $this->db->query($sql);
        }
        return false;
    }

    public function fixtags($text)
    {
        $text = str_replace("'", "\'", $text);
        return $text;
    }

    /**
     * @param $where : where clause on delete query
     * @return : The number of record effected
     */
    public function delete($where)
    {
        if (isset($this->tableName)) {

            if ($where == null || (isset($where) && count($where) == 0)) {
                throw new DBException("delete param invalid", DBException::ERROR_CODE_LACK_PARAMETER);
            }
            $fields = array();
            foreach ($where as $key => $value) {
                if (is_array($value)) {
                    $wheres[] = "`{$key}`=" . array_shift($value);
                } else {
                    $wheres[] = "`{$key}`='{$value}'";
                }
            }
            $sql = "DELETE FROM `{$this->tableName}` WHERE " . implode(" AND ", $wheres);

            return $this->db->query($sql);
        }
        return false;
    }

    /**
     * Update multiple records
     */
    public function updates($fieldValues)
    {
        throw new DBException("getObjectsByField function from $this->tableName has not yet implemented", DBException::ERROR_CODE_LACK_PARAMETER);
    }

    /**
     * @param $default
     * @return mixed
     * @throws FrameworkException
     */
    public function processDefaultValue($default)
    {
        if ($default instanceof FrameworkException) {
            throw $default;
        } else if (is_callable($default)) {
            return $default();
        }
        return $default;
    }/**/

    public function getAll($condition = '', $page = 0, $limit = 20, $orderBy = "created_at DESC")
    {
        try {
            $page = $page == 0 ? 1 : $page;
            $offset = $limit * ($page - 1);
            // Get total items
            if ($condition != '') {
                $where = " WHERE {$condition}";
            } else {
                $where = '';
            }
            $countSql = "SELECT count(id) AS total
                FROM `{$this->tableName}`
                {$where}
                ORDER BY {$orderBy}
            ";
            $totalArr = $this->db->select($countSql);
            // Get all videos by limit and offset
            $sql = "{$this->baseQuery} `{$this->tableName}` {$where}
                ORDER BY {$orderBy}
                LIMIT {$limit} OFFSET {$offset}
            ";

            $items = $this->db->select($sql);
            $items = array('total' => intval($totalArr['0']['total']), 'items' => $items);
        } catch (DBException $e) {
            $items = array('total' => 0, 'items' => array());


        }

        return $items;
    }
}