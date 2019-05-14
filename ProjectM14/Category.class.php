<?php 
class Category
{
    private $refcat;
    private $cat_description;
    
    function __construct($refcat = null, $cat_description=null)
    {
        $this->refcat = $refcat;
        $this->cat_description= $cat_description;
    }
    /**
     * @return mixed
     */
    public function getRefcat()
    {
        return $this->refcat;
    }

    /**
     * @return mixed
     */
    public function getCat_description()
    {
        return $this->cat_description;
    }

    /**
     * @param mixed $refcat
     */
    public function setRefcat($refcat)
    {
        $this->refcat = $refcat;
    }

    /**
     * @param mixed $cat_description
     */
    public function setCat_description($cat_description)
    {
        $this->cat_description = $cat_description;
    }
    
    public function __toString()
    {
        return "<option value=$this->refcat>$this->cat_description</option>";
                
    }
    
    public function getComboboxElements($connection)
    {
        $sql = "SELECT * FROM category";
        $count = 0;
     
        foreach ($connection->query($sql) as $oneRec)
        {
            $refcat = $oneRec['refcat'];
            $cat_description = $oneRec['category_description'];
            $cat = new Category($refcat, $cat_description);
            $arrCat[$count++] = $cat;
        }
        return $arrCat; 
    }

    public static function getHeader()
    {
        echo "<select name='catid'>";
    }
    public static function getFooter()
    {
        echo "</select>";
    }
    public function displayCombobox($arrCat)
    {
        
        foreach ($arrCat as $oneRec)
        {
            echo $oneRec;
        }
        
    }
}


?>
