<?php
    
    function store($table, $datas, $conn){
        $column_names = implode("," , array_keys($datas));
        $bind_values = implode(", :", array_keys($datas));
        $sql = "INSERT INTO $table($column_names) VALUES(:$bind_values)";
    
        $stmt = $conn->prepare($sql);
        foreach($datas as $key => &$value){
            $stmt->bindParam(":".$key, $value);
        }
        $stmt->execute();
    
    }

    function select($table,$cols,$conn){
        $sql = 'SELECT '.$cols.' FROM '.$table;
        $stmt = $conn->prepare($sql);
        $stmt ->execute();
        $results = $stmt->fetchAll();

        return $results;
    }

    function selectJoins($table, $cols, $join, $where, $order, $conn){
        $sql = "SELECT $cols FROM $table";
        if($join != null){
            $sql .= " $join";
        }
        if($where != null){
            $sql .= " WHERE $where";
        }
        if($order != null){
            $sql .= " ORDER BY $order";
        }
        // echo $sql;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        
        return $results;
    
    }

    function show($table,$cols,$join,$id,$conn){
        $sql = "SELECT $cols FROM $table";
        if($join != null){
            $sql .= " $join";
        }
        if($id != null){
            $sql .= " WHERE posts.id = $id";
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function edit($table,$id,$conn){
        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt =$conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function update($table, $datas, $id, $conn){
            $col_set = [];
            foreach($datas as $key=>$value){
                $col_set[] = "$key = :$key";
            }
            $col_bindData = implode(",", $col_set);
            $sql = "UPDATE $table SET $col_bindData WHERE id = :id";
            $stmt = $conn->prepare($sql);
            foreach($datas as $key => &$value){
                $stmt->bindParam(":".$key, $value);
            }
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        }


    function delete($table,$id,$conn){
        $sql = "DELETE FROM $table WHERE id =:id";
        $stmt = $conn->prepare($sql);
        $stmt ->bindParam(':id',$id);
        $stmt->execute();
    }

?>


