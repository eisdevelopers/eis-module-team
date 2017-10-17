<?php

/*
 * Project    : EIS Subscription Module
 * EAO IT Services Pvt. Ltd. | www.eaoservices.com
 * Copyright reserved @2017

 * File Description :

 * Created on : 3 Oct, 2017 | 12:38:33 PM
 * Author     : Bilal Wani
 * Email      : bilal.wani@eaoservices

 */

require_once 'eis-db.php';

/*
 * Table : eis-team
 * Column	Type	Null	Default	Comments
  id          int(11)	No
  name	varchar(60)	No
  designation	varchar(60)	No
  img_url	varchar(250)	Yes 	NULL
  style_line	varchar(80)	Yes 	NULL
  status	tinyint(4)	No
  Indexes

  Keyname	Type	Unique	Packed	Column	Cardinality	Collation	Null	Comment
  PRIMARY	BTREE	Yes	No	id	0	A	No
 * 
 */

if (!class_exists('EisTeamModel')) {

    class EisTeamModel extends EisSqlDb {

        private $m_table_name = 'eis-team';

        public function __construct($host, $user, $pwd, $dbname) {
            parent::__construct($host, $user, $pwd, $dbname);
        }
        
        
         /* Function: GetAllMembers
         * Description: View members that is in the database
         * Return:
         * On success return 0, else error code
         */
        public function GetAllMembers() {
            $query = 'SELECT * from `' . $this->m_table_name . '`';
            $result = $this->ExecuteSelectQuery($query);
            return $result;
        }

        public function ExecuteCUDQuery($query) {
            return $this->m_link->query($query);
        }
        
           /*
           * ExecuteSelectQuery operates on SELECT query
           * params: 
           *    1. $query (String) - Sql SELECT statement
    
           * returns:
           *   On success returns associative data array. Caller must check size of array for validation.
           *   On error it returns 'null'
           */
        public function ExecuteSelectQuery($query) {
            $result = $this->m_link->query($query);
            $dataArray = array();  //Creat Assocative array
            if ($result->num_rows > 0) {
                //output data of each row
                while ($row = $result->fetch_assoc()) {
                    array_push($dataArray, $row);
                }
            }
            return $dataArray;
        }
        
        protected function GetDbLink() {
            
        }
          public function GetErrorMsg() {
              return $this->m_link->error;
          }

          public function GetErrorNum() {
              return $this->m_link->errno;
          }
        /* Function: CreateMember
         * Description: Creates Member
         * Params:
         * 1 - name
         * 2 - designation 
         * 3 - img
         * Return:
         * On success return 0, else error code
         */

        public function CreateMember($name, $designation, $img_url, $style_line, $status) {
            $ret = false;
              $query = "INSERT INTO `" . $this->m_table_name ."` values(null, '$name','$designation','$img_url','$style_line', '$status') ";
            $this->ExecuteCUDQuery($query);           
            return $this->GetErrorNum();
        }
        
        /*
         * Function: UpdateMember
         * Description: This function updates Member details in the database with provided details having given id
         * Param
         * 1 - name
         * 2 - designation
         * 3 - img
         * Return:
         * On success return 0, else error code
         */

        public function UpdateMember($id,$name,$designation,$img) {
             $query = "update`" . $this->m_table_name ."`  set name='$name',designation='$designation',img_url='$img' where id='$id'";
            $this->ExecuteCUDQuery($query);
            return $this->GetErrorNum();
        }
        
        /*
         * Function: DeleteMember
         * Description: This function Deletes Member using given ID
         * Return:
         * On success return 0, else error code
         */

        public function DeleteMember($id) {
            $query = "DELETE FROM `$this->m_table_name` WHERE id=$id";
            $this->ExecuteCUDQuery($query);
            return $this->GetErrorNum();
        }

       public function SearchMember($search) {
            $query = "SELECT * FROM `$this->m_table_name` WHERE name like '%".$name."%' OR designation like '%".$designation."%'";
            $data = $this->ExecuteSelectQuery($query);
            return $this->GetErrorNum();
        }
        public function SetMemberStatus($id){
            $query ="update`" . $this->m_table_name ."` set status=1-status where id='$id'";
            $this->ExecuteCUDQuery($query);
            return $this->GetErrorNum();
        }
    }
}