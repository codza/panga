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
     //       filter: function(data) {

            /*  var resultList = data.aaData.map(function (item) {
              return item.name;

          });*/
          //console.log(resultList);
          //return data[1].data;

  //     }
            
        }

    });
    console.log(permissions);
    //   titles.initialize();

    $('#inputSearchPermission.typeahead').typeahead(null, {
        name: 'permissions',
       // display: 'perm_name',
        displayKey: 'perm_name',
        source: permissions
    }).on('typeahead:selected', function (obj, datum) {
    console.log(obj);
    console.log(datum);

    });



</script>