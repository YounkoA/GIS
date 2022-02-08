 <input type="checkbox" id="<?=$row['id']?>"  name="onoffswitch" value="<?=$row['status']?>" class="js-switch" <?=$row['status'] == '1' ? 'checked' : '' ;?>/> 

$('input[name=onoffswitch]').click(function(){
var id=$(this).attr('id');
var status = $(this).val();
if(status == 1) {
    status = 0; 
} else {
    status = 1; 
}
//alert(id);
$.ajax({
        type:'POST',
        url:'homeadmin.php',
        data:'id= ' + id + '&status='+status
    });
});