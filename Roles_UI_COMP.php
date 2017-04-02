<?php /** Created by PhpStorm. User: Admin Date: 21/03/17 Time: 4:49 PM */ ?>
<head>


    <script src="scripts/src/bootstrap-switch.js"></script>
    <link rel="stylesheet" href="styles/src/bootstrap-switch.css">
    <script src="scripts/src/modal_cstm.js"></script>
    <link href="styles/src/custom_modal.css" rel="stylesheet">
</head>
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-panel">
            <div class="tabbable-line">
                <ul style="font-size: 10px;" class="nav nav-tabs ">
                    <li class="active"><a href="#Roles" data-toggle="tab"> Roles </a></li>
                    <li><a href="#Permissions" data-toggle="tab"> Permission </a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="Roles">
                        <table id="roles_table" class="table table-striped table-bordered display compact nowrap"
                               width="100%">
                            <thead>
                            <tr>
                                <th>
                                    <div class="btn-group"><label class="btn btn-default "> <input type="checkbox"
                                                                                                   id="example-select-all">
                                        </label>
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                style="height: 30px" data-toggle="dropdown"><span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><i class="glyphicon glyphicon-duplicate" style="padding: 10px"></i>
                                                <span style="padding-left: 10px">Merge</span></li>
                                            <li class="divider"></li>
                                            <li><i class="glyphicon glyphicon-trash" style="padding: 10px"></i> <span
                                                        style="padding-left: 10px">Delete</span></li>
                                            <li class="divider"></li>
                                            <li><i class="glyphicon glyphicon-export" style="padding: 10px"></i> <span
                                                        style="padding-left: 10px">Export</span></li>
                                        </ul>
                                    </div>
                                </th>
                                <th>Role Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th style="width: 144px"><span class="glyphicon glyphicon-option-horizontal"
                                                               style="font-size: 20px"></span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div id='modal-header' class="modal-header ">
                                        <span style="padding-left: 5px" class="glyphicon glyphicon-info-sign"></span>
                                        <button type="button" class="close" data-dismiss="modal" style="color: white"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div style="background-color: white; height: 4px"></div>
                                    <div class="modal-body">
                                        <div id="toolbar" class="btn-group btn-group-sm" role="group">
                                            <button type="button" id="edit_button" class="btn btn-primary"><span
                                                        class="glyphicon glyphicon-pencil"
                                                        style="padding-right: 2px"></span> Edit
                                            </button>
                                            <button type="button" id="delete_button" class="btn btn-primary "><span

                                                        class="glyphicon glyphicon-remove"
                                                        style="padding-right: 2px"></span>Delete
                                            </button>
                                            <button type="button" id="duplicate_button" class="btn btn-primary"><span
                                                        class="glyphicon glyphicon-duplicate"
                                                        style="padding-right: 2px"></span>Duplicate
                                            </button>
                                        </div>
                                        <div class="panel-group" style="padding-top: 20px">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" href="#details">Details
                                                            <span id="detailsPanel"
                                                                  class="glyphicon glyphicon-plus pull-right"></span>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="details" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <form id="viewForm">
                                                                    <div class="form-group">
                                                                        <input type="hidden" class="form-control"
                                                                               name="role_id" id="role_id"
                                                                               placeholder="Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="formGroupExampleInput">Role
                                                                            Name</label>
                                                                        <input type="text" class="form-control"
                                                                               name="role_name"
                                                                               id="role_name"
                                                                               placeholder="Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="formGroupExampleInput2">Role
                                                                            Description</label>
                                                                        <textarea name="role_desc" class="form-control"
                                                                                  id="role_desc"
                                                                                  placeholder="Description"></textarea>
                                                                    </div>
                                                                    <div id="switch" class="form-check"
                                                                         style="padding-top: 10px">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-group" style="padding-top: 2px">
                                            <div class="panel panel-primary" >
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" href="#permissions">Permissions
                                                            <span id="permissionsPanel"
                                                                  class="glyphicon glyphicon-plus pull-right"></span>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="permissions" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <form style="margin-bottom: -10px" id="permissionsForm">

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="background-color: white; height: 4px"></div>
                                    <div class="modal-footer" style="margin: 0px">
                                        <button type="submit" id="submit_button" class="btn btn-success"
                                                data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>
                                            Submit
                                        </button>
                                        <button type="submit" id="cancel_button" class="btn btn-danger pull-right"
                                                data-dismiss="modal"><span
                                                    class="glyphicon glyphicon-remove-sign"></span> Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Record Delete
                                        <i style="padding-left: 5px" class="glyphicon glyphicon-question-sign"></i>
                                    </div>
                                    <span></span>
                                    <div class="modal-body">
                                        Are you sure you want to Delete?
                                    </div>

                                    <div class="modal-footer">
                                        <button id="no_button" type="button" class="btn btn-danger"
                                                data-dismiss="modal"> <span
                                                    class="glyphicon glyphicon-remove-sign"></span>No
                                        </button>
                                        <button id="yes_button" type="button" class="btn btn-success"><span
                                                    class="glyphicon glyphicon-ok-sign"></span>Yes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Permissions">
                        <p>
                            Howdy, I'm in Tab 2.
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
