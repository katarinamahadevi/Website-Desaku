<?php
class Investasi {
    // DB Stuff
    private $conn;
    private $inv_table = 'investasi';
    private $user_table = 'user';
    private $inv_user_table = 'investasi_member';
    private $log_cron = 'log_cron';


    public function __construct($db) {
      $this->conn = $db;
    }

    public function after_invest(){
        $query = "";
        $query .= "SELECT * FROM ".$this->inv_user_table;
        $query .= "LEFT JOIN ".$this->inv_table." ON ".$this->inv_user_table.".id_investasi = ".$this->inv_table.".id_investasi";
        $query .= "LEFT JOIN ".$this->user_table." ON ".$this->inv_user_table.".id_user = ".$this->user_table.".id_user";
        $query .= "WHERE investasi_member.end_date <= now()";
        $query .= "AND investasi_member.live = 'Y'";

    	$stmt = $this->conn->prepare($query);

    	$stmt->execute();
    	$arrResult = array();

    	if ($stmt->rowCount()>0){
            $no = 0;
            $id = [];
            
    		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $num = $no++;
                $setI[$num]['live'] = 'N';
                $setI[$num]['id_investasi_member'] = $row->id_investasi_member;

                $setU[$num]['id_user'] = $row->id_user;
                $setU[$num]['saldo'] = ($row->saldo + $row->modal_provit + $row->keuntungan);

                $id[] = $row->id_investasi_member;
    		}
            $data_id = json_encode($id);
            
            // INSERT LOG
            $insert = "INSERT INTO ".$this->log_cron." (`keterangan`,`data`) VALUES ('berhasil merubah data live investasi','".$data_id."')";

            $stmt_in = $this->conn->prepare($insert);
            $stmt_in->execute();
                
            $update = "UPDATE ".$this->inv_user_table." SET ";
            $sets = array();
            foreach($setI as $column => $value) {
                $sets[] = "`".$column."` = '".$value."'";
            }
            $sql .= implode(', ', $sets);
            $sql .= $whereSQL;
           

    		return $arrResult;
    	}else{
    		return false;
    	}

    }
}   