<?php //
//abstract class AbstractFactory {
//
//    protected $db;
//
//    public function __construct() {
//
//        try {
//            $this->db = new PDO("sqlite:model/DB_ouvidoria.sqlite");
//
//            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        } catch (PDOException $exception) {
//            echo $exception->getMessage();
//        } catch (Exception $exception) {
//            echo $exception->getMessage();
//        }
//    }
//
//    /**
//     * Persiste um objeto no banco. Executa um SQL "Insert into..."
//     * @param Object $obj - Objeto a ser persistido.
//     * @return boolean - se conseguiu salvar ou não.
//     */
//    abstract public function salvar($obj);
//
//    /**
//     * Lista os objetos persistidos no banco, ou seja, executa um
//     * SQL "Select - From"
//     * @return array -  Array de objetos da classe.
//     */
//    //abstract public function listAll();
//
//    /**
//     * Busca objetos no banco de dados que atendem a um parâmetro.
//     * Executa um SQL "Select - From - Where"
//     * @param string $param - parâmetro a ser buscado.
//     * @return  array -  Array de objetos da classe, ou null se não encontrar
//     * objetos.
//     */
//    //abstract public function search($param);
//
//    /**
//     * Faz o mapeamento Objeto-Relacional, transformando um resultado de
//     * consulta (PDOStatement) em uma lista de Objetos recuperados.
//     * @param PDOStatement $result - o resultado da consulta
//     * @param String $nameObject - nome da Classe de objetos
//     * @return  $list lista de objetos da classe $nameObject
//     */
//    protected function queryRowsToListOfObjects
//    (PDOStatement $result, $nameObject) {
//        $list = array();
//        $r = $result->fetchAll(PDO::FETCH_NUM);
//        foreach ($r as $row) {
//            //unset($row[0]);
//            $ref = new ReflectionClass($nameObject);
//            $list[] = $ref->newInstanceArgs($row);
//        }
//        return $list;
//    }
//
//}
//?>