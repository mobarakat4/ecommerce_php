<?php
    $title="Dashbord";

    session_start();
    if(isset($_SESSION['username'])){
        require_once 'init.php';
        $lastmembers=selectlatest('*','users');
        $lastitems=selectlatest('*','items');
        
        ?>
        <!-- //content here -->

        <div class="container">
            <h1 class=' text-center display-2 text-secondary headd'> Dashbord</h1>
        </div>
        <div class="container text-center main-stats">
            <div class="row">
                <div class="col-md-3 col-sm-6"><div class="stats stat1 my-5">  Total Mempers  <a href="members.php"> <span><?php echo counitemswhere('id','users','group_id',0)?></span></a>  </div></div>
                <div class="col-md-3 col-sm-6"><div class="stats stat2 my-5">  Pending Members  <a href="members.php?pending=active"> <span><span><?php echo counitemswhere('id','users','reg_status',0)?></span></a>  </div></div>
                <div class="col-md-3 col-sm-6"><div class="stats stat3 my-5">  Total Items <a href="items.php"> <span><?php echo counitems('id','items')?></span></a>  </div></div>
                <div class="col-md-3 col-sm-6"><div class="stats stat4 my-5">  Total Comments <a href="#"> <span>300</span></a>  </div></div>
            </div>
        </div>
        <div class="container main-cards my-5">
            <div class="row">
                <div class="col-sm-6 my-5"><div class="card panel-default panels panel1">
                    <div class="card-header">
                        <i class="fa fa-users me-1"></i>Last members
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled latest-users">
                            <?php
                            foreach($lastmembers as $member){
                                echo '<li class="d-flex justify-content-between">';
                                echo '<div class="card-name">';
                                echo $member['username'];
                                echo '</div>';
                                echo '<div class="d-inline text-right">';
                                if($member['reg_status']==0){
                                    echo '<a class="btn btn-info mx-1"href="members.php?do=activate&id='.$member['id'].'">Active</a>';
                                }else{
                                    echo '<a class="btn btn-secondary mx-1"href="members.php?do=disactivate&id='.$member['id'].'">DisActive</a>';

                                }
                                echo '<a class="btn btn-success mx-1"href="members.php?do=edit&id='.$member['id'].'">Edit</a>';
                                echo '</div>';
                                echo '</li>';
                                echo '<div class="border-d"></div>';
                            }

                                
                            ?>
                        </ul>
                    </div>
                </div></div>
                <div class="col-sm-6 my-5" ><div class="card card-default panels panel2">
                    <div class="card-header">
                        <i class="fa fa-tag me-1"></i>
                        Last Item
                    </div>
                    <div class="card-body">
                    <ul class="list-unstyled latest-users">
                            <?php
                            foreach($lastitems as $item){
                                echo '<li class="d-flex justify-content-between">';
                                echo '<div class="card-name">';
                                echo $item['name'];
                                echo '</div>';
                                echo '<div class="d-inline text-right">';
                                if($item['approve']==0){
                                    echo '<a class="btn btn-info mx-1"href="items.php?do=approve&id='.$item['id'].'">Approve</a>';
                                }else{
                                    echo '<a class="btn btn-secondary mx-1"href="items.php?do=disapprove&id='.$item['id'].'">Disapprove</a>';

                                }
                                echo '<a class="btn btn-success mx-1"href="items.php?do=edit&id='.$item['id'].'">Edit</a>';
                                echo '</div>';
                                echo '</li>';
                                echo '<div class="border-d"></div>';
                            }

                                
                            ?>
                        </ul>
                    </div>
                </div></div>
            </div>
        </div>
<?php
        include_once $tmpl.'footer.php';
    }else{
        header('location:index.php');
    }


?>

