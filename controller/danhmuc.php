<?php 

include "../model/xl_data.php";

class danhmuc{
    private $id_dm = 0; // thuộc tính id_dm 
    private $Name = ""; // Thuộc tính tên danh mục

    public function setId($id_dm): mixed{
        return $this->id_dm = $id_dm;
    }

    public function getId(): mixed{
        return $this->id_dm;
    }

    public function setName($Name): mixed{
        return $this->Name = $Name;
    }

    public function getName(): mixed{
        return $this->Name;
    }

    public function getDS_Danhmuc(): array{
        $xl = new xl_data();
        $sql = "SELECT * FROM `danhmuc`";
        $result = $xl->readitem(sql: $sql);
        return $result;
    }

    public function themDM(danhmuc $dm): void{
        $xl = new xl_data();
        //cách viết câu sql
        $sql = "INSERT INTO `danhmuc` (`id`, `name`) VALUES (NULL, '".$dm->getName()."')";
        //gọi hàm thực thi câu sql trong xl_data
        $xl->execute_item(sql: $sql);
    }

    public function xoadm(danhmuc $dm): void{
        $xl = new xl_data();
        $sql = "DELETE FROM `danhmuc` WHERE `danhmuc`.`id` = ". $dm->getId();
        $xl->execute_item(sql: $sql);
    }
}