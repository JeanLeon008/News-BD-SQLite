<?php
require_once 'INewsDB.class.php';

class NewsDB implements INewsDB
{
    const DB_NAME = 'news.db';
    private $_db;
    
    function __construct() {
        $this->_db = new SQLite3(self::DB_NAME);
        if(!filesize('news.db')){
            $this->_db->exec("CREATE TABLE msgs(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT,
                category INTEGER,
                description TEXT,
                source TEXT,
                datetime INTEGER
                )");
            $this->_db->exec("CREATE TABLE category(
                id INTEGER,
                name TEXT
            )");
            $this->_db->exec("INSERT INTO category(id, name)
            SELECT 1 as id, 'Политика' as name
            UNION SELECT 2 as id, 'Культура' as name
            UNION SELECT 3 as id, 'Спорт' as name ");
        }
    }
    
    function __destruct () {
        unset($this->_db);
    }
    function __get($name){
        if($name == 'db'){
            return $this->_db;
        }
    }
    function saveNews($title, $category, $description, $source){
        $dt = date("Y-m-d H:i:s");
        $sql = "INSERT INTO msgs(title, category, description, source, datetime) VALUES ('$title', '$category', '$description', '$source', '$dt')";
        return $this->_db->exec($sql);
    }
    function getNews(){
        $sql = "SELECT
        msgs.id as id, title, category.name as category, description,
        source, datetime FROM msgs, category WHERE category.id =
        msgs.category ORDER BY msgs.id DESC";
        $arrSqlite = $this->_db->query($sql);
        $arr = [];
        while($row = $arrSqlite->fetchArray(SQLITE3_ASSOC)){
            $arr[] = $row;
        }
        return $arr;
    }
    function showNews($id){
        $sql = "SELECT
        msgs.id as id, title, category.name as category, description,
        source, datetime FROM msgs, category WHERE msgs.id=$id";
        return $this->_db->query($sql);
    }
}
