<?
// database configuration
class SBBS_SQL extends SQL {
    function SBBS_SQL() {
        // dbtype://user:pass@host/dbname
        $dsn = "mysql://@localhost/test";
        $this->connect($dsn);
    }       
}
?>
