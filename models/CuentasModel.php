<?php

class CuentasModel extends Model{
    //Podriamos asignar los datos completos de estructura de la tabla para 
    //hacer la validacion correcta
    private $schema= array("id"=>"txtid",
                           "descripcion"=>"txtcuenta",
                           "saldo_inicial"=>"txtsaldo",
                           "signo_moneda"=>"txtsimbolo",
                           "fecha"=>"fecha",
                           "status"=>"status");


    public function __construct(){
        parent::__construct();
    }

    public function getAll(){
        $sql = "SELECT * FROM cuentas";
        return $this->selectAll($sql);
    }

    public function getBy($where){
        $sql = "SELECT * FROM cuentas ";
        $sql .= "WHERE ".$this->getUpdateWhereDataPDO($where);
        $data = $this->select($sql,$where);
        return $this->relationSchemaFormData($data,$this->schema);
    }

    public function set($data){
        $sql = "INSERT INTO cuentas (".$this->getKeysArray($data).")";
        $sql .=" VALUES (".$this->getKeysArrayPDO($data).")";
        return $this->insert($sql,$this->getFormatDataPDO($data));
    }   

    public function put($datos,$where){
        $sql = "UPDATE cuentas SET ";
        $sql .= " ".$this->getUpdateWhereDataPDO($datos);
        $sql .= " WHERE ".$this->getUpdateWhereDataPDO($where);
        return $this->update($sql,$this->getFormatDataPDO($this->combineArrays($datos,$where)));
    }

    public function del($where){
        $sql = "DELETE FROM cuentas ";
        $sql .= "WHERE ".$this->getKeysArray($where);
        $sql .= "=".$this->getKeysArrayPDO($where);
        return $this->delete($sql,$where);
    }

}