

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

        /*
         * @method Constructor establishes db connection using thegiven parameters: 
         * 
         * @param string $host,string $user,string $pwd and string $database
         * 
         * @author
         */
        public function __construct($host, $user, $pwd, $dbname) {
            parent::__construct($host, $user, $pwd, $dbname);
        }

        /* 
         * @method GetAllMembers
         * Description: View members that is in the database
         * 
         * @returns On success return 0, else error code
         * @author
         */

        public function GetAllMembers() {
            $query = 'SELECT * from `' . $this->m_table_name . '`';
            $result = $this->ExecuteSelectQuery($query);
            return $result;
        }

        /*
         * @function  ExecuteCUDQuery:
         * Description ExecuteCUDQuery: Operates on CREATE,UPDATE,DELETE query
         * @params: $query (String) - Sql SELECT statement
         * 
         * @returns On success runs elsenull'
         * @author 
         */

        public function ExecuteCUDQuery($query) {
            return $this->m_link->query($query);
        }

        /*
         * @function ExecuteSelectQuery:
         * Description ExecuteSelectQuery: Operates on SELECT query
         * @params:  $query (String) - Sql SELECT statement
         *    
         * @returns:On success returns associative data array. Caller must check size of array for validation.
         *             On error it returns 'null'
         * @author
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

        /*
         *  @Function GetErrorMsg
         * Description: Returns the  error message for the MySQLi function call that can succeed or fail
         */

        public function GetErrorMsg() {
            return $this->m_link->error;
        }

        /*
         *  @Function GetErrorNum
         * Description: Returns the  error code for the MySQLi function call that can succeed or fail.
         */

        public function GetErrorNum() {
            return $this->m_link->errno;
        }

        /* 
         * @function CreateMember
         * Description: Creates Member
         * @params: varchar name, varchar designation & varchar img
         *
         * @return On success return 0, else error number
         * @author
         */

        public function CreateMember($name, $designation, $img_url, $style_line, $status) {
            $ret = false;
            $query = "INSERT INTO `" . $this->m_table_name . "` values(null, '$name','$designation','$img_url','$style_line', '$status') ";
            $this->ExecuteCUDQuery($query);

            if (EIS_DEBUG) {
                EisLog::Record(__FUNCTION__ . " | SQL : " . $query);
            }

            return $this->GetErrorNum();
        }

        /*
         * @function UpdateMember
         * Description: This function updates Member details in the database with provided details having given id
         * @params: varchar name, varchar designation & varchar img
         * 
         * @return: On success return 0, else error number
         * 
         * @author
         */

        public function UpdateMember($id, $name, $designation, $img) {
            $query = "update`" . $this->m_table_name . "`  set name='$name',designation='$designation',img_url='$img' where id='$id'";
            $this->ExecuteCUDQuery($query);
            if (EIS_DEBUG) {
                EisLog::Record(__FUNCTION__ . " | SQL : " . $query);
            }
            return $this->GetErrorNum();
        }

        /*
         * @function DeleteMember
         * Description: This function updates Member details in the database with provided details having given id
         * 
         * @return:On success return 0, else error number
         * @author
         * 
         */

        public function DeleteMember($id) {
            $query = "DELETE FROM `$this->m_table_name` WHERE id=$id";
            $this->ExecuteCUDQuery($query);
            return $this->GetErrorNum();
        }

        public function SearchMember($search) {
            $query = "SELECT * FROM `$this->m_table_name` WHERE name like '%" . $name . "%' OR designation like '%" . $designation . "%'";
            $data = $this->ExecuteSelectQuery($query);
            return $this->GetErrorNum();
        }

        /*
         *  @function: SetMemberStatus
         * Description: This function sets the status of a member using given ID
         * @params int id, int value
         * @returns:On success return 0, else error number
         * @author
         * 
         */

        public function SetMemberStatus($id, $value) {

            $query = "update`" . $this->m_table_name . "` set status=$value where id=$id";
            $this->ExecuteCUDQuery($query);
            if (EIS_DEBUG) {
                EisLog::Record(__FUNCTION__ . " - SQL :   " . $query);
            }
            return $this->GetErrorNum();
        }

        /* 
         *  @function: GetMemberData
         *  Description: This function fetches the  fields of a member using given ID
         *  @param int id
         * 
         *  @returns:  On success returns associative array, else null
         *  @author
         */

        public function GetMemberData($id) {
            $query = "SELECT * FROM `$this->m_table_name` where id = $id";
            $result = $this->ExecuteSelectQuery($query);

            if ($result) {
                return $result;
            }

            return null;
        }

    }

}