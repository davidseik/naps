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
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($user_data as $row){
                    ?>
                        <tr class="even">
                            <td><?= $row['id_user']?></td>
                            <td><?= $row['name']?></td>
                            <td><?= $row['last_name']?></td>
                            <td><?php 
                            switch($row['category']){
                              case 2: echo 'Presenter';
                              break;
                              case 3: echo 'Voter';
                              break;
                            }
                            ?></td>
                            <td><?= $row['mail']?></td>
                            <td><?= $row['last_log']?></td>
                            <td><?= $row['active']?'Active':'Inactive'?></td>
                            <td><button type="button" class="btn btn-sm btn-primary btn_tb clickable e_btn" id="edit_btn<?= $row['id_user']?>"><i class="fa fa-edit fa-fw"></i>Edit</button><button type="button" class="btn btn-sm btn-primary btn_tb d_btn clickable" id="delete_btn<?= $row['id_user']?>"><i class="fa fa-times-circle fa-fw"></i>Delete</button></td>
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
<div class="row">
    <div class="col-sm-12">
        <button type="button" class="btn btn-primary" id="add_new_user"><i class="fa fa-users fa-fw"></i>Add new user</button>
    </div>
</div>

<div class="panel panel-default" id="add_edit_form" style="display:none; margin-top:20px">
    <div class="panel-heading" id="edit_heading">

    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="row">
            <form class="form-horizontal" id="data_form" role="form">
            <div class="form-group">
                <label  class="col-sm-3 control-label">ID User</label>
                <div class="col-sm-9">
                    <label  class="control-label" id="id_label"></label>
                </div>
              </div>

              <div class="form-group">
                <label for="name_in" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="name_in" name="name" title="Only characters, numbers and _ allowed and Cannot be blank" placeholder="Name" maxlength="50" pattern="[a-zA-Z0-9\s]+" required>
                </div>
              </div>
              <div class="form-group">
                <label for="last_name_in" class="col-sm-3 control-label">Last Name</label>
                <div class="col-sm-9">
                  <input type="Text" class="form-control" id="last_name_in" name="last_name" title="Only characters, numbers and _ allowed and Cannot be blank" placeholder="Last Name" maxlength="50" pattern="[a-zA-Z0-9\s]+"  required>
                </div>
              </div>
              <div class="form-group">
                <label for="mail_in" class="col-sm-3 control-label">Mail</label>
                <div class="col-sm-9">
                  <input type="Text" class="form-control" id="mail_in" name="mail" placeholder="mail@example.com" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                </div>
              </div>
              <div class="form-group">
                <label for="password_in" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" name="password" id="pwd_in" placeholder="*********">
                </div>
              </div>
              <div class="form-group">
                <label for="password_in" class="col-sm-3 control-label">Repeat Password</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="pwd_in_rpt" placeholder="*********">
                </div>
              </div>
               <div class="form-group">
                <label for="category_in" class="col-sm-3 control-label">Category</label>
                <div class="col-sm-9">
                  <select class="form-control" id="category_in" name="category">
                      <option value="2">Presenter</option>
                      <option value="3">Voter</option>
                      <!-- <option value="2">Presenter</option> -->
                    </select>
                </div>
              </div>
               <div class="form-group">
                <label for="active_in" class="col-sm-3 control-label">Active</label>
                <div class="col-sm-9">
                  <select class="form-control" id="active_in" name="active">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                </div>
              </div>                                                                     
           <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" id="save_form"><i class="fa fa-save fa-fw"></i>Save</button>
                  <button type="button" class="btn btn-primary" id="cancel_form"><i class="fa fa-times-circle fa-fw"></i>Cancel</button>
                </div>
              </div>
            </form>
        </div>
        <!-- ihaslajk -->
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->
