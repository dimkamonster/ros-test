<?php


class User extends Model
{
    protected string $table = 'users';

    public function fillFields()
    {
        $sqlMethod = DB::DESCRIBE;
        $sql = 'DESCRIBE `' . $this->table . '`;';
//        $result = DB2::execute($sqlMethod, $sql);
        if ($result = DB::execute($sqlMethod, $sql))
            array_map(function ($field){
                $this->_object[$field['Field']] = $this->_object[$field['Field']] ?? NULL;
                $this->_fields[$field['Field']] =
                    array(
                        'default' => $field['Default'],
                        'type'=> $field['Type'],
                        'ai' => $field['Extra'] === 'auto_increment');
            }, $result);
    }

    public function __construct(array $params = NULL)
    {
        parent::__construct($params);
        $this->fillFields();
    }

    /**
     * @param Model $model
     * @param string $field
     * @param string $op
     * @param string $value
     */
    public function find(string $field, string $op, string $value): Model
    {
        $table = $this->table;
        $where_statement = "`" . trim($field) . "` " . trim($op) . " '" . trim($value) . "'";
        $sqlMethod = DB::SELECT;
        $sql = "SELECT * FROM `$table` WHERE $where_statement LIMIT 0,1;";
        $result = DB::execute($sqlMethod, $sql);
        if ($result) { //if found - add all fields to _object and return model
            $this->_object = $result;
            $this->_loaded = true;
        }
        return $this;
    }

    /**
     * Fill object fields with params
     * @param array $params
     */
    protected function setFields(array $params)
    {
        foreach ($params as $key => $param) {
            $this->_object[$key] = $params[$key];
        }
    }

    protected function getValuesToSQL(): string
    {
        $arr = [];
        foreach ($this->_object as $field => $value) {
            if ($this->_fields[$field]['ai']) continue;
            if (!is_null($this->_fields[$field]['default']))
            {
                if ($field == 'updated_at') {
                    $arr[] = $this->_fields[$field]['default'] == 'CURRENT_TIMESTAMP' ?
                        $this->_fields[$field]['default'] :
                        (is_null($this->_object[$field]) ?
                                $this->_fields[$field]['default'] :
                                "'" . $this->_object[$field] ."'");
                } else
                    $arr[] = is_null($this->_object[$field]) ? $this->_fields[$field]['default'] :  "'" . $this->_object[$field] ."'";
                continue;

            }
            $arr[] = is_null($this->_object[$field]) ? "NULL" :  "'" . $this->_object[$field] ."'";
        }
        return implode(',',$arr);
    }

    protected function getFieldsToSQL(): string
    {
        $array_map = [];
        foreach (array_keys($this->_object) as $key) {
            if ($this->_fields[$key]['ai']) continue;
            $array_map[$key] = '`' . $key . '`';
        }
        return implode(',', $array_map);
    }

    //должен вернуть id ресурса и get ссылку на него должен вернуть контроллер какой-нибудь общий чтоли. х.з.
    public function create(array $params): ?int
    {
        // TODO: Implement create() method.
        if (!empty($params)) {
            if (isset($params['email']) && isset($params['username']) && isset($params['password'])) {
                $params['password'] = Auth::getPWDHash($params['password']);
                $this->setFields($params);
                $table = $this->table;
                $sqlMethod = DB::INSERT;
                $fields = $this->getFieldsToSQL();
                $values = $this->getValuesToSQL();
                $sql = "INSERT INTO `$table` ($fields) VALUES ($values);";
                $insertedID = DB::execute($sqlMethod, $sql);
                if ($insertedID ) {//if found - add all fields to _object and return model
                    $this->setFields($insertedID);//_object['id'] = $insertedID[0];
                    $this->_loaded = true;
                    return $insertedID['id'];
                }
            }
        }
        return NULL;
    }

    public function read(array $params)
    {
        // TODO: Implement read() method.
    }

    public function update(array $params)
    {
        // TODO: Implement update() method.
    }

    public function delete(array $params)
    {
        // TODO: Implement delete() method.
    }
}