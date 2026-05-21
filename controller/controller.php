<?php
include "../controller/danhmuc.php";

class controller {
    public function hienthidm() {
        $dm = new danhmuc();
        return $dm->getDS_Danhmuc();
    }

    public function themdm($dm_object) {
        $dm_object->themDM($dm_object);
    }

    public function xoadm($dm_object) {
        $dm_object->xoadm($dm_object);
    }
}
?>