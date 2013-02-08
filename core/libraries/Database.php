<?php 
class Database extends PDO
{
    protected $db_config = array(
        'dns'      => 'mysql:host=ephesus.cs.cf.ac.uk;dbname=g7y2012db',
        'username' => 'g7y2012',
        'password' => 'Cagyov' );
    
    public function __construct()
    {
        try
        {
            parent::__construct( $this->db_config['dns'], $this->db_config['username'], $this->db_config['password'] );
        }
        catch(PDOException $exception)
        {
            echo 'An error has occured...';
        }
    }
    /**
     * Select data from database
     *
     * @param  string   $query  SQL query to be run
     * @param  array    $bindParams Parameters to be bind
     * @return Selected data from database
     */
     public function select($query, $bindParams = array())
     {
         $sth = $this->prepare($query);
         
         foreach ($bindParams as $key => $value)
         {
             $sth->bindValue("$key", $value);
         }
         $sth->execute();
         return $sth->fetchAll( PDO::FETCH_ASSOC );
    }

}
