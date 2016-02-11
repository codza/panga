<?php
$attributes = array('class' => 'form-horizontal');
?>
<div class="col-lg-12">

    <div class="col-lg-5">
        <div class="row">
            <div class="col-lg-12" style="border:1px solid #000;">
                <?php echo validation_errors(); ?>
                <fieldset >
                    <legend> Edit Role </legend>

                    <?php echo form_open(current_url(), $attributes); ?>
                    <input type="hidden" name="roleid" value="<?php echo $role->role_id; ?>" />
                    <div class="form-group" >
                        <label class="col-lg-4 control-label"  for="inputRoleName">Role Name :</label>
                        <div class="col-lg-8" >
                            <input type="text"  name="rolename" value="<?php echo $role->role_name; ?>" id="inputRoleName" placeholder="Role Name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="col-md-offset-2 col-md-4">
                            <button type="submit" class="btn">Update</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </fieldset>

            </div>
        </div>


    </div>
    <div class="col-lg-7" id="loaded_post_list" style="border: 1px solid #000;">

        <div class="col-lg-12" style="border:1px solid #000;">
            <?php echo form_open(current_url(),$attributes);?>
                <div class="form-group" >
                    <label class="col-lg-3 control-label" for="inputSearchPermission">Search Permission :</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control typeahead" id="inputSearchPermission" name="" value="" placeholder="Type To Search ..." />
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
       
        <div class="col-lg-12">
            <table class="table" id="role_perm_list">
                <thead>
                <tr>
                    <td> ID </td><td> permission Name</td><td> </td>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td colspan="3"> No permission attached </td>
                    </tr>

                </tbody>

            </table>
        </div>
        
    </div>
    
</div>

<div>
        <?php echo anchor('dashboard/accessmanagement/view_roles', 'Back To List ', 'title="Role list"'); ?>
</div>
<script>

    var RESSOURCES_ROLEPERM_PERMISSION_URL ="<?php echo RESSOURCES_ROLEPERM_PERMISSION_URL; ?>";
    var tk="<?php echo $this->tokenSession;?>";

    RESSOURCES_ROLEPERM_PERMISSION_URL +="/tk/"+tk+"/format/json";

    var permissions = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: RESSOURCES_ROLEPERM_PERMISSION_URL,
            wildcard: '%QUERY%',
           filter: function(data) {

           var resultList =[];
          //console.log(data[1]);
          var items = data[1].data;
          for( var i=0; i < items.length; i++) {
              resultList.push(items[i]);
          }
          return resultList;

       }
            
        }

    });
    //console.log(permissions);
    //   titles.initialize();

    $(function() {
        // Handler for .ready() called.

        var RESSOURCES_ROLEPERM_PERMS_BY_ROLE_ID_URL ="<?php echo RESSOURCES_ROLEPERM_PERMS_BY_ROLE_ID_URL; ?>";
        var tk="<?php echo $this->tokenSession;?>";
        var role_id ="<?php echo $role->role_id; ?>";


        RESSOURCES_ROLEPERM_PERMS_BY_ROLE_ID_URL +="/"+role_id+"/tk/"+tk+"/format/json";
       // console.log(RESSOURCES_ROLEPERM_PERMS_BY_ROLE_ID_URL);

        $('#role_perm_list tbody tr').load(RESSOURCES_ROLEPERM_PERMS_BY_ROLE_ID_URL,function(resp){
           // resp
         /*  console.log("**********");
            console.log(resp);
            console.log("**********");
            console.log("||||||||||");
            console.log(status);
            console.log("||||||||||");
            console.log("##########");
            console.log(data);
            console.log("##########");*/

                var var_resp = JSON.parse(resp);

                if (var_resp[0].status == "success") {

                    var items = var_resp[1].data;

                   load_perm_list(items);
                  //  console.log(var_resp);

                }

        });
    });

    $('#inputSearchPermission.typeahead').typeahead(null, {
        displayKey:"created_date",
        display: "perm_name",
        limit: 10,
        source: permissions

    }).on('typeahead:selected', function (obj, data) {

                  var RESSOURCES_ROLEPERM_ADD_PERM_TO_ROLE_URL = "<?php echo RESSOURCES_ROLEPERM_ADD_PERM_TO_ROLE_URL; ?>";
                    
                    var postData = new FormData();
                    var perm_id = data.perm_id;
                    var role_id = "<?php echo $role->role_id; ?>";
                    var tk      = "<?php echo $this->tokenSession; ?>";
                    postData.append("tk", tk);
                    postData.append("role_id", role_id);
                    postData.append("perm_id", perm_id);

                    $.ajax({
                        datatype: "json",
                        mimeType: "multipart/form-data",
                        contentType: false,
                        cache: false,
                        processData: false,
                        method: "POST",
                        url: RESSOURCES_ROLEPERM_ADD_PERM_TO_ROLE_URL,
                        data: postData
                    }).done(function (resp) {
                        var Var_resp = JSON.parse(resp);

                        if (Var_resp.status === "success") {

                        var items = Var_resp.data;

                            load_perm_list(items);

                        }

                    });

    });

    function load_perm_list( items ){
        $("#role_perm_list tbody tr").remove();
        for( var i=0; i < items.length; i++) {
            $("#role_perm_list tbody").append(
                //   "<div class=''style='border:2px solid #000;'>" +
                "<tr>"+
                "<td>"+items[i].role_perm_id+"</td>" +
                "<td>"+items[i].perm_name+"</td>"+
                "<td><a href='<?php echo base_url()."ressources/roleperms/async_removepermtorole/tk/".$this->tokenSession."/role_perm_id/";?>"+items[i].role_perm_id+"/format/json' >remove</a></td>"+
                "</tr>");

        }

    }



</script>