<div class="panel panel-default">
    <div class="panel-heading">
        Topics
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($topic_data as $topic){
                ?>
                    <tr class="even">
                        <td><?= $topic['id_topic']?></td>
                        <td><?= $topic['title']?></td>
                        <td><?= $topic['topic_category']?></td>
                        <td><?= $topic['active']?'Active':'Inactive'; ?></td>
                        <td><button type="button" class="btn btn-md btn-primary btn_tb clickable e_btn" id="edit_btn<?= $topic['id_topic']?>"><i class="fa fa-edit fa-fw"></i>Edit</button><button type="button" class="btn btn-md btn-primary btn_tb d_btn clickable" id="delete_btn<?= $topic['id_topic']?>"><i class="fa fa-times-circle fa-fw"></i>Delete</button></td>
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
        <button type="button" class="btn btn-primary" id="add_new_topic"><i class="fa fa-users fa-fw"></i>Add new topic</button>
    </div>
</div>

<div class="panel panel-default" id="add_edit_form" style=" margin-top:20px">
    <div class="panel-heading" id="edit_heading">

    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="row">
            <form class="form-horizontal" id="data_form" role="form" style="padding:10px;">
<!--             <div class="form-group">
                <label  class="col-sm-3 control-label">ID Topic</label>
                <div class="col-sm-9">
                    <label  class="control-label" id="id_label"></label>
                </div>
              </div> -->

              <div class="form-group">
                <div class="col-md-2"><label for="name_in" class="col-sm-3 control-label">ID</label></div>
                <div class="col-md-5"><label  class="control-label" id="id_label">?</label></div>
              </div>
              <div class="form-group">
                <div class="col-md-2"><label for="name_in" class="col-sm-3 control-label">Title</label></div>
                <div class="col-md-5 "> <input type="text" class="form-control" id="title_in" name="title" title="Only characters, numbers and _ allowed and Cannot be blank" placeholder="Title" maxlength="50" pattern="[a-zA-Z0-9\s]+" required /></div>
              </div>
              <div class="form-group">
                <div class="col-md-2"><label for="name_in" class="col-sm-3 control-label">Category</label></div>
                <div class="col-md-5"> <input type="text" class="form-control" id="category_in" name="category" title="Only characters, numbers and _ allowed and Cannot be blank" placeholder="Category" maxlength="50" pattern="[a-zA-Z0-9\s]+" required /></div>
              </div>
              <div class="form-group">
                <div class="col-md-2"><label for="name_in" class="col-sm-3 control-label">Active</label></div>
                <div class="col-md-5">
                    <select class="form-control" id="active_in" name="active">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                </div>
              </div>
<!--               <div class="form-group">
                <label for="last_name_in" class="col-sm-3 control-label">Category</label>
                <div class="col-sm-9">
                  <input type="Text" class="form-control" id="last_name_in" name="last_name" title="Only characters, numbers and _ allowed and Cannot be blank" placeholder="Last Name" maxlength="50" pattern="[a-zA-Z0-9\s]+"  required>
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
            </div> -->
            </form>
        </div>
        <!-- ihaslajk -->
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>