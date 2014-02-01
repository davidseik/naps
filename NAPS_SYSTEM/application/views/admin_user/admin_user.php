
<?php
    //var_dump($user_data[0]);
	//foreach($user_data as $row){
?>
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Last Name</th>
                                            <th>Category</th>
                                            <th>Mail</th>
                                            <th>Last Login</th>
                                            <th>Active</th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i=1;
                                            foreach($user_data as $row){
                                        ?>
                                            <tr class="even">
                                                <td><?= $row['id_admin_user']?></td>
                                                <td><?= $row['name']?></td>
                                                <td><?= $row['last_name']?></td>
                                                <td><?= $row['category']?></td>
                                                <td><?= $row['mail']?></td>
                                                <td><?= $row['last_log']?></td>
                                                <td><?= $row['active']?></td>
                                                <td></td>
<!--                                                 <td class="center">4</td>
                                                <td class="center">X</td> -->
                                            </tr>

                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
