<?php 
use yii\helpers\Url;

$category = array(
                    "1"=>"BUSINESS/ FINANCE",
                    "2"=>"COMPUTER SCIENCE/ IT",
                    "3"=>"HIGH SCHOOL",
                    "4"=>"HEALTHCARE",
                    "5"=>"COLLEGE ENTRANCE",
                    "6"=>"LAW",
                    "7"=>"PROFESSIONAL",
                    "8"=>"PUBLIC SERVICE"
                 );


$subCategory = array(
                        "1" => array(),
                        "2" => array(),
                        "3" => array(),
                        "4"=>array(
                                    "9"  => "Counselor / Therapist",
                                    "10" => "Dentistry",
                                    "11" => "Laboratory",
                                    "12" => "Medicine",
                                    "13" => "Nursing",
                                    "14" => "Pharmacy",
                                    "15" => "Radiology Technologist - Sonography",
                                    "16" => "Toxicology",
                                ),
                        "5" =>  array(),
                        "6" =>  array(),
                        "7" =>  array(),
                        "8" =>  array(),
                        "9" =>  array(),
                        "10" => array(),
                        "11" => array(),
                        "12" => array(
                                        "17"=>"Residency & Fellowship Exams",
                                     ),
                        "13" => array(),
                        "14" => array(),
                        "15" => array(),
                        "16" => array(),
                        "17" => array(),
                    );

$exam = array(
                "1"   =>  array(),
                "2"   =>  array(),
                "3"   =>  array(),
                "4"   =>  array(),
                "5"   =>  array(),
                "6"   =>  array(),
                "7"   =>  array(),
                "8"   =>  array(),
                "9"   =>  array(),
                "10"  =>  array(),
                "11"  =>  array(),
                "12"  =>  array(
                                    "1"=>array("COMAT Exams"),
                                    "2"=>array("COMLEX - Level 1"),
                                    "3"=>array("COMLEX - Level 2"),
                                    "4"=>array("COMLEX - Level 3"),
                                    "5"=>array("COMVEX"),
                                    "6"=>array("MCAT"),
                                    "7"=>array("USMLE Step 1"),
                                    "8"=>array("USMLE Step 2"),
                                    "9"=>array("USMLE Step 3"),
                                ),
                "13"  => array(),
                "14"  => array(),
                "15"  => array(),
                "16"  => array(),
                "17"  => array(
                                  "10" =>  "Anesthesiology",
                                  "11" =>  "Family Medicine",
                                  "12" =>  "Medicine & Subspecialties",
                                  "13" =>  "Obstetrics & Gynecology",
                                  "14" =>  "Pathology",
                                  "15" =>  "Pediatrics",
                                  "16" =>  "Radiology",
                                  "17" =>  "Surgery",
                              ), 
             );
?>
<nav role="navigation" class="navbar-collapse">    
    <ul class="nav navbar-nav">
        <?php
        if(count($category)>0)
        {
            foreach($category as $key=>$parentCat)
            {
        ?>
                <li>
                    <a href="javascript:void(0);"><?php echo $parentCat; ?>
                    <?php
                    if(count($subCategory[$key]))
                        echo "<span class='caret caret1'></span>";
                    ?>    
                    </a>
                    <?php
                    $level1 = $subCategory[$key]+$exam[$key];
                    if(count($level1))
                    {
                    ?>
                        <ul class="dropdown-menu">
                        <?php
                        foreach($level1 as $key1=>$value1)
                        {
                        ?>
                            <?php
                            if(is_array($value1))
                            {
                             ?>
                              <li>  <a href="#"><?php echo $value1; ?></a> </li>
                            <?php
                            }
                            else
                            { ?>
                              <li>  
                                  <a href="#"><?php echo $value1; ?>
                                    <?php
                                    if(count($subCategory[$key1]))
                                        echo "<span class='caret'></span>";
                                    ?> 
                                  </a>
                                  <?php
                                  $level2 = $subCategory[$key1] + $exam[$key1];
                                  if(count($level2)>0)
                                  {
                                  ?>
                                    <ul class="dropdown-menu">
                                        <?php
                                        foreach($level2 as $key2=>$value2)
                                        {
                                            if(is_array($value2))
                                            {
                                            ?>
                                                <li><a href="#"><?php echo $value2[0]; ?></a></li>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <li> 
                                                    <a href="#"><?php echo $value2; ?>
                                                    <?php
                                                    $level3 = $subCategory[$key2] + $exam[$key2];
                                                    if(count($level3[$key2]))
                                                        echo "<span class='caret'></span>";
                                                    ?> 
                                                    </a> 
                                                <?php
                                                
                                                if(count($level3)>0)
                                                {
                                                ?>
                                                    <ul class="dropdown-menu">
                                                    <?php
                                                    foreach($level3 as $key3=>$value3)
                                                    {
                                                        if(is_array($value3))
                                                        {
                                                        ?>
                                                            <li><a href="#"><?php echo $value3[0]; ?></a></li>
                                                        <?php    
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                            <li>
                                                                <a href="#"><?php echo $value3; ?></a>
                                                                <?php
                                                                //if(count($subCategory[$key3]))
                                                                //    echo "<span class='caret'></span>";
                                                                ?>
                                                            </li>    
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                    </ul>
                                                <?php
                                                }
                                                ?>    
                                                </li>  
                                            <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                  <?php
                                  }
                                  ?>
                              </li>    
                            <?php 
                            }
                            ?>
                        <?php    
                        }
                        ?>    
                        </ul>
                    <?php
                    }
                    ?>
                </li>
        <?php
            }
        }
        ?>
    </ul>
</nav>    
