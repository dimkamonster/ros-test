<?php


class DB extends Database
{
    /**
     * Get query
     * @param string $sqlMethod SELECT|INSERT|UPDATE|DELETE|DESCRIBE
     * @param string $query
     * @return array|null
     */
    public static function execute(string $sqlMethod, string $query): ?array
    {
        if (!is_null(self::getInstance())) {
            self::$lastQuery = $query;
            if ($res = self::$_instance->query($query)) {
                $result = [];
                if ($sqlMethod == self::SELECT) {
                    if ($res->num_rows > 1) {
                        while ($row = $res->fetch_assoc()) {
                            $result[] = $row;
                        }
                    } else $result = $res->fetch_assoc();
                    $res->close();
                }
                if ($sqlMethod == self::DESCRIBE) {
                    if ($res->num_rows > 1) {
                        while ($row = $res->fetch_assoc()) {
                            $result[] = $row;
                        }
                    } else $result = $res->fetch_assoc();
                    $res->close();
                }
                if ($sqlMethod == self::INSERT) {
                    $result['id'] = self::$_instance->insert_id;
                }
                if ($sqlMethod == self::UPDATE) {
                    $result[] = $res;
                }
                return $result;
            }
        }
        return NULL;
    }

}