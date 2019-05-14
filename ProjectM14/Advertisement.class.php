<?php
class Advertisement{
    private $refad;
    private $ad_description;
    private $refmember;
    private $regdate;
    private $expdate;
    private $refimg;
    private $name;
    
   

    function __construct($refad=null, $ad_description=null, $refmember=null, $regdate=null, $expdate=null)
    {
        $this->refad = $refad;
        $this->ad_description = $ad_description;
        $this->refmember = $refmember;
        $this->regdate = $regdate;
        $this->expdate = $expdate;
        
    }
    /**
     * @return mixed
     */
    public function getRefad()
    {
        return $this->refad;
    }

    /**
     * @return mixed
     */
    public function getAd_description()
    {
        return $this->ad_description;
    }

    /**
     * @return mixed
     */
    public function getRefmember()
    {
        return $this->refmember;
    }

    /**
     * @return mixed
     */
    public function getRegdate()
    {
        return $this->regdate;
    }

    /**
     * @return mixed
     */
    public function getExpdate()
    {
        return $this->expdate;
    }

    /**
     * @param mixed $refad
     */
    public function setRefad($refad)
    {
        $this->refad = $refad;
    }

    /**
     * @param mixed $ad_description
     */
    public function setAd_description($ad_description)
    {
        $this->ad_description = $ad_description;
    }

    /**
     * @param mixed $refmember
     */
    public function setRefmember($refmember)
    {
        $this->refmember = $refmember;
    }

    /**
     * @param mixed $regdate
     */
    public function setRegdate($regdate)
    {
        $this->regdate = $regdate;
    }

    /**
     * @param mixed $expdate
     */
    public function setExpdate($expdate)
    {
        $this->expdate = $expdate;
    }
    
    /**
     * @return string
     */
    public function getRefimg()
    {
        return $this->refimg;
    }
    
    /**
     * @param string $refimg
     */
    public function setRefimg($refimg)
    {
        $this->refimg = $refimg;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function __toString()
    {
        return "<tr>
                    <td>$this->ad_description</td>
                    <td>$this->regdate</td>
                    <td>$this->expdate</td>
                </tr>";
    }
    
    
    public function getAllFreeAds($connection)
    {
        $counter = 0;
        $sql = "SELECT advertisements.refad, advertisements.ad_description, advertisements.refmember,
                       advertisements.regdate, advertisements.expdate FROM advertisements WHERE NOT EXISTS(SELECT * FROM images WHERE advertisements.refad = images.refad)";
        foreach ($connection->query($sql) as $oneRec)
        {
            $refad = $oneRec["refad"];
            $ad_description = $oneRec["ad_description"];
            $refmember = $oneRec["refmember"];
            $regdate= $oneRec["regdate"];
            $expdate = $oneRec["expdate"];
            $advertisement = new Advertisement($refad, $ad_description, $refmember, $regdate, $expdate);
            $arrAd[$counter++] = $advertisement;
        }
        return $arrAd;
    }
    
    public function getAllPaidAds($connection)
    {
        $sql = "SELECT advertisements.refad, advertisements.ad_description, advertisements.refmember, advertisements.regdate, advertisements.expdate,images.refimage, images.name FROM advertisements INNER JOIN images ON advertisements.refad = images.refad";
        $results = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_array($results))
        {
            echo '<tr>
                    <td>
                     <img src="data:image/jpeg;base64,'.base64_encode($row['name']).'" height="200" width="200" class="img-thumnail" />
                     </td>
                    <td><a href=DisplayAd.php?'.$row['refad'].'>'.$row['ad_description'].'"</a></td>
                    <td>'.$row['regdate'].'</td>
                    <td>'.$row['expdate'].'</td>
                </tr>';
        }
    }
    public function getSelectedAd($connection, $qs)
    {
        $sql ="SELECT * FROM advertisements WHERE refad=$qs";
        
        foreach ($connection->query($sql) as $oneRec)
        {
            $refad = $oneRec["refad"];
            $ad_description = $oneRec["ad_description"];
            $refmember = $oneRec["refmember"];
            $regdate= $oneRec["regdate"];
            $expdate = $oneRec["expdate"];
            $advertisement = new Advertisement($refad, $ad_description, $refmember, $regdate, $expdate);
            
        }
        return $advertisement;
    }
    public function getSelectedAdByRefmember($connection, $refM)
    {
        $sql ="SELECT advertisements.refad, advertisements.ad_description, advertisements.refmember,
                       advertisements.regdate, advertisements.expdate FROM advertisements WHERE NOT EXISTS(SELECT * FROM images WHERE advertisements.refad = images.refad) AND refmember=$refM";
        $table = "";
        foreach ($connection->query($sql) as $oneRec)
        {
            $refad = $oneRec["refad"];
            $_SESSION['adtype'] = "free";
            $ad_description = $oneRec["ad_description"];
            $refmember = $oneRec["refmember"];
            $regdate= $oneRec["regdate"];
            $expdate = $oneRec["expdate"];
            $advertisement = new Advertisement($refad, $ad_description, $refmember, $regdate, $expdate);
            $table .= "<tr>
                        <td>$ad_description</td>
                        <td>$regdate</td>
                        <td>$expdate</td>
                        <td><a href='updateFreeAdPage.php?refad=".$oneRec['refad']."&adtype=".$_SESSION['adtype']."'>Update</a></td>
                        <td><a href='deleteAd.php?refad=".$oneRec['refad']."&".$_SESSION['adtype']."'>Delete</a></td>
                       </tr>";
            
        }
        
        return $table;
    }
    
    public function getFreeAdsByCategory($connection, $refcat)
    {
        $counter = 0;
        $sql = "SELECT advertisements.refad, advertisements.ad_description, advertisements.refmember,
                       advertisements.regdate, advertisements.expdate FROM advertisements WHERE NOT EXISTS(SELECT * FROM images WHERE advertisements.refad = images.refad) AND advertisements.refcat = $refcat";
        foreach ($connection->query($sql) as $oneRec)
        {
            $refad = $oneRec["refad"];
            $ad_description = $oneRec["ad_description"];
            $refmember = $oneRec["refmember"];
            $regdate= $oneRec["regdate"];
            $expdate = $oneRec["expdate"];
            $advertisement = new Advertisement($refad, $ad_description, $refmember, $regdate, $expdate);
            $arrAd[$counter++] = $advertisement;
        }
        return $arrAd;
    }
        
    public function getPaidAdsByCategory($connection, $refcat)
    {
        $sql = "SELECT advertisements.refad, advertisements.ad_description, advertisements.refmember, advertisements.regdate, advertisements.expdate,images.refimage, images.name FROM advertisements INNER JOIN images ON advertisements.refad = images.refad AND advertisements.refcat=$refcat";
        $results = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_array($results))
        {
            echo '<tr>
                    <td>
                     <img src="data:image/jpeg;base64,'.base64_encode($row['name']).'" height="200" width="200" class="img-thumnail" />
                     </td>
                    <td><a href=DisplayAd.php?'.$row['refad'].'>'.$row['ad_description'].'"</a></td>
                    <td>'.$row['regdate'].'</td>
                    <td>'.$row['expdate'].'</td>
                </tr>';
        }
    }
    
    public function getRefAdFromMyAds($connection, $refM)
    {
        $sql ="SELECT * FROM advertisements WHERE refmember=$refM ORDER BY refad";
        $arrRefad = array();
        foreach ($connection->query($sql) as $oneRec)
        {
            $refad = $oneRec["refad"];
            array_push($arrRefad, $refad);
        }
        return $arrRefad;
    }
    
    public function deleteFreeAd($connection, $refad)
    {
        $sql = "DELETE FROM advertisements WHERE refad=$refad";
        $results = $connection->exec($sql);
        return results;
    }
    public function deletePaidAd($connection, $refad)
    {
        $sql = "DELETE FROM images WHERE refad=$refad";
        $sql2 = "DELETE FROM advertisements WHERE refad=$refad";
        
        $results = $connection->exec($sql);
        if ($results > 0)
        {
            $results2 = $connection->exec($sql2);
        }

    }
    public function deleteAdImage($connection, $refad)
    {
        
        $results = $connection->exec($sql);
 
    }
    public function updateFreeAd($connection, $refad, $desc, $refcat)
    {
        $sql = "UPDATE advertisements SET ad_description='$desc', refcat = $refcat WHERE refad = $refad";
        $results = $connection->exec($sql);
        
        return results;
    }
    public function updatePaidAd($connection, $refad, $desc, $refcat)
    {
        $sql = "UPDATE advertisements SET ad_description='$desc', refcat = $refcat WHERE refad = $refad";
        $results = $connection->exec($sql);
        return $results;
        
    }
    public function updateImage($connection, $refad, $file)
    {
        $sql = "UPDATE images SET name='$file' WHERE refad=$refad";
        $results = $connection->exec($sql);
        return $results;
    }
    public static function getHeader(){
        
        return "<table width=100%; height=100%>
                    <tr>
                        <th>Advertisement</th>
                        <th>Posted Date</th>
                        <th>Expire Date</th>
                    </tr>";
        
    }
    
    public function DisplayAds($arrAd)
    {
        echo self::getHeader();
        foreach ($arrAd as $oneRec)
        {
            echo $oneRec;
        }
        echo self::getFooter();
    }
    public function DisplaySelectedAd($advertisement)
    {
        echo self::getHeader();
        echo $advertisement;
        echo self::getFooter();
    }
    public static function getFooter()
    {
        return "</table>";
    }
    

    
}