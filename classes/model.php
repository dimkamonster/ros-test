<?php


abstract class Model
{
    public array $_fields;

    public array $_object;

    public bool $_loaded = FALSE;

    protected string $table;

    protected function fillObject(array $params)
    {
        foreach ($params as $key => $value) {
            $this->_fields[$key] = $value;
        }
        return $this;

    }
    public function __construct(array $params = NULL)
    {
        if (!is_null($params)) {
            foreach ($params as $key => $value) {
                $this->_object[$key] = $value;
            }
        }
    }

    /**
     * Method to fill _fields in model with all fields from DB pr other
     * @return mixed
     */
    abstract protected function fillFields();

//    public function find(string $field, string $op, string $value): Model
//    {
//        if (isset($this->_fields['id']))
//        {
//            $result = DB2::find($this, $this->_fields['id']);
//            if (!empty($result))
//                $this->fillObject($result);
//        }
//        return $this;
//    }
    abstract public function find(string $field, string $op, string $value): Model;

    abstract public function create(array $params);

    abstract public function read(array $params);

    abstract public function update(array $params);

    abstract public function delete(array $params);

//    /**
//     * @return string
//     */
//    public function getTable(): string
//    {
//        return $this->table;
//    }

    /**
     * @return bool
     */
    public function loaded(): string
    {
        return $this->_loaded;
    }


}