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
            result
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
    console.log(RESSOURCES_ROLEPERM_PERMISSION_URL);
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

    $('#inputSearchPermission.typeahead').typeahead(null, {
        displayKey:"created_date",
        display: "perm_name",
        limit: 10,
        source: permissions,
    /*    templates: {
        empty: [
      '<div class="empty-message">',
        'unable to find any Best Picture winners that match the current query',
      '</div>'
        ].join('\n'),
        suggestion: function(data) {
                return '<p><strong>' + data.perm_name + '</strong> – ' + data.created_date + '</p>';
            }
        },*/
    }).on('typeahead:selected', function (obj, data) {
        console.log("*********");
    //console.log(obj);
    console.log(data);
    console.log(data.perm_id);
                  var RESSOURCES_ROLEPERM_ADD_PERM_TO_ROLE_URL = "<?php echo RESSOURCES_ROLEPERM_ADD_PERM_TO_ROLE_URL; ?>";
                    
                    var postData = new FormData();
                    var perm_id = data.perm_id;
                    var role_id = "<?php echo $role->role_id; ?>";
                    var tk      = "<?php echo $this->tokenSession; ?>";
                    postData.append("tk", tk);
                    postData.append("role_id", role_id);
                    postData.append("perm_id", perm_id);
                    console.log("********************************");
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
                        //console.log(resp);
                        console.log("/////////////////////////////");
                        console.log(Var_resp);
                        console.log("/////////////////////////////");
                        

                        if (Var_resp.status === "success") {
                            
                            
               /*         var items = Var_resp.data;
                //.html(): Clean HTML inside and append
                        $("#loaded_posts_list tbody tr").remove();
                        for( var i=0; i < items.length; i++) {
                            $("#loaded_posts_list tbody").append(
                             //   "<div class=''style='border:2px solid #000;'>" +
                                "<tr>"+
                                        "<td>"+items[i].sp_post_id+"</td>" +
                                        "<td>"+items[i].sp_post_name+"</td>"+
                                        "<td><a href='<?php echo base_url()."ressources/posts/async_unlaod/tk/".$this->tokenSession."loaded_id/";?>"+items[i].loaded_id+"/format/json' >remove</a></td>"+
                                "</tr>");

                        }
                            
                            ///location.reload();*/
                        }

                    });
    
    

    });



</script>