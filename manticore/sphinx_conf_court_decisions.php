<?php

class courtDecisions{
    
    var $db = [
            'host'=>'174.138.188.234',
            'user'=>'sphinxreadonly',
            'pass'=>'lw23irn9EheMDNREmzo5',
            'db'=>'courscom_dev2',
        ];
    var $conn;
    var $chunks = 3;
    
    public function __construct(){
        $dsn = 'mysql:host='.$this->db['host'].';dbname='.$this->db['db'].';charset=utf8';
        $this->conn = new \PDO($dsn, $this->db['user'], $this->db['pass']);
    }
    
    
    public function getChunks(){
        $sql = 'SELECT MIN(judgment_code) AS start,MAX(judgment_code) AS end FROM judgment_mast';
        $rs = $this->conn->query($sql);
        $row = $rs->fetch(\PDO::FETCH_ASSOC);
        
        $perChunk = ceil($row['end'] / $this->chunks);
        
        $chunks = [];
        
        for($i=$row['start']-1; $i<=$row['end']; $i+=$perChunk):
            $chunks[] = ['start'=>$i+1, 'end'=>$i + $perChunk];
        endfor;
        
        return $chunks;
    }
    
}

$courtDecisions = new \courtDecisions();

$chunks = $courtDecisions->getChunks();

?>
source src_main
{
	type			= mysql
	sql_host		= <?php echo $courtDecisions->db['host']; ?>
        
	sql_user		= <?php echo $courtDecisions->db['user']; ?>
	
        sql_pass		= <?php echo $courtDecisions->db['pass']; ?>
        
	sql_db			= <?php echo $courtDecisions->db['db']; ?>
        
	sql_port		= 3306	# optional, default is 3306
	
	sql_query_pre = SET NAMES utf8
	# try to avoid lock
	sql_query_pre = SET SESSION TRANSACTION ISOLATION LEVEL READ UNCOMMITTED
        
        sql_range_step = 10000
        sql_ranged_throttle = 0
}

source src_court_decisions_common:src_main{
    sql_query   = \
		SELECT j.judgment_code, j.court_code, j.court_name, j.appeal_numb, UNIX_TIMESTAMP(j.judgment_date) AS judgment_date , j.jyear, j.judgment_title, j.appellant_name, j.appellant_adv, j.appellant_adv_count, j.respondant_name, j.respondant_adv, j.respondant_adv_count, j.appeal_status, j.disposition_id, j.disposition_text, j.bench_type_id, j.bench_type_text, j.judgment_jurisdiction_id, j.judgmnent_jurisdiction_text, j.citation, j.citation_count, j.judges_name, j.judges_count, j.hearing_date, j.hearing_place, j.judgment_abstract, j.judgment_text, j.doc_id, j.judgment_type, j.judgment_source_name, j.jcatg_id, j.jcatg_description, j.jsub_catg_id, j.jsub_catg_description, j.overrule_judgment, j.overruled_by_judgment, j.judgment_ext_remark_flag, j.jcount, j.uid, UNIX_TIMESTAMP(j.date) AS `date`, UNIX_TIMESTAMP(j.time) AS `time`, j.approved, UNIX_TIMESTAMP(j.approved_date) AS approved_date, j.country_code, j.country_name, j.bench_code, j.ref_count, j.cited_count, j.act_count, j.country_shrt_name \
                , DATE_FORMAT(j.judgment_date,"%Y%m") AS judgment_date_year_month, DATE_FORMAT(j.judgment_date,"%Y%m%d") AS judgment_date_year_month_day \
		FROM judgment_mast j \
		WHERE j.judgment_code BETWEEN $start AND $end

	sql_attr_uint		= court_code
	sql_attr_uint		= appellant_adv_count
	sql_attr_uint		= respondant_adv_count
	sql_attr_uint		= disposition_id
	sql_attr_uint		= bench_type_id
	sql_attr_uint		= judgment_jurisdiction_id
	sql_attr_uint		= citation_count
	sql_attr_uint		= judges_count
	sql_attr_uint		= jcatg_id
	sql_attr_uint		= jsub_catg_id
	sql_attr_uint		= approved
	sql_attr_uint		= country_code
	sql_attr_uint		= bench_code
	sql_attr_uint		= ref_count
	sql_attr_uint		= cited_count
	sql_attr_uint		= act_count
        
	sql_attr_uint		= judgment_date_year_month
	sql_attr_uint		= judgment_date_year_month_day
	
	sql_field_string	= court_name
	sql_field_string	= appeal_numb
	sql_field_string	= judgment_title
	sql_field_string	= disposition_text
	
	#sql_attr_string	= court_name
	
	sql_attr_timestamp	= judgment_date
	sql_attr_timestamp	= date
	sql_attr_timestamp	= approved_date
}

index idx_court_decisions_common{
    
    path = <?php echo $basePath; ?>/court_decisions
}


<?php foreach($chunks as $key=>$val): 
?>
source src_court_decisions_<?php echo $key;?>:src_court_decisions_common
{
    sql_query_range = SELECT <?php echo $val['start'];?>,<?php echo $val['end'];?>
    
}


index idx_court_decisions_<?php echo $key;?>:idx_court_decisions_common
{
    source = src_court_decisions_<?php echo $key;?>

    path = <?php echo $basePath; ?>court_decisions_<?php echo $key;?>
    
}

<?php
endforeach;
?>

index idx_court_decisions {
  type = distributed
  <?php foreach($chunks as $key=>$val): ?>
  local = idx_court_decisions_<?php echo $key; ?>
  
  <?php  endforeach; ?>
}